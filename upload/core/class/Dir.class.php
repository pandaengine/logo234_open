<?php
class Dir
{
	private $_values = array();
	/**
	 +----------------------------------------------------------
	 * 架构函数
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param string $path  目录路径
	 +----------------------------------------------------------
	 */
	function __construct()
	{ 
		
	}

	/**
	 +----------------------------------------------------------
	 * 取得目录下面的文件信息
	 +----------------------------------------------------------
	 * @access public
	 +----------------------------------------------------------
	 * @param mixed $pathname 路径
	 +----------------------------------------------------------
	 */
	function listFile($pathname,$pattern='*')
	{
		if(substr($pathname, -1) != "/")    $pathname .= "/"; //在末尾加上/
		static $_listDirs = array();
		$guid=md5($pathname.$pattern);
		if(!isset($_listDirs[$guid])){
			$dir = array();
			$list	=	glob($pathname.$pattern); //glob() 函数返回匹配指定模式的文件名或目录。返回/~home/*所有文件
			foreach ($list as $i=>$file){
					$dir[$i]['filename']    = basename($file);
					$dir[$i]['pathname']    = realpath($file);
					$dir[$i]['owner']        = fileowner($file);
					$dir[$i]['perms']        = fileperms($file);
					$dir[$i]['inode']        = fileinode($file);
					$dir[$i]['group']        = filegroup($file);
					$dir[$i]['path']        = dirname($file);
					$dir[$i]['atime']        = fileatime($file);
					$dir[$i]['ctime']        = filectime($file);
					$dir[$i]['size']        = filesize($file);
					$dir[$i]['type']        = filetype($file);
					$dir[$i]['ext']      =  is_file($file)?strtolower(substr(strrchr(basename($file), '.'),1)):'';
					$dir[$i]['mtime']        = filemtime($file);
					$dir[$i]['isDir']        = is_dir($file);
					$dir[$i]['isFile']        = is_file($file);
					$dir[$i]['isLink']        = is_link($file);
					//$dir[$i]['isExecutable']= function_exists('is_executable')?is_executable($file):'';
					$dir[$i]['isReadable']    = is_readable($file);
					$dir[$i]['isWritable']    = is_writable($file);
			}
			$cmp_func = create_function('$a,$b','
			$k  =  "isDir";
			if($a[$k]  ==  $b[$k])  return  0;
			return  $a[$k]>$b[$k]?-1:1;
			');
			// 对结果排序 保证目录在前面
			usort($dir,$cmp_func);
			$this->_values = $dir;
			$_listDirs[$guid] = $dir;
			
		}else{
			$this->_values = $_listDirs[$guid];
		}
		
		return $this->_values;
	}
	/**
	 * 获取某个目录下的文件列表
	 * 不返回目录
	 *  $rule文件名的规则名称
	 */
	public function fileList($directory,$rule,$ext){
		if(!method_exists('Dir', $rule)) exit('规则方法不存在');
		$dir=scandir($directory);
		foreach ($dir as $k=>$v){
			if(!is_file($directory.'/'.$v) || $v=='.' || $v=='..' || (!$this->$rule($v,$ext))) //是目录，..，.不符合文件名规则
				unset($dir[$k]);
		}
		return $dir;
	}
	
	/**
	 * 插件的css/js文件名规则验证
	 * extend_common.css
	 * extend_1.js
	 * 
	 */
	public function pluginCssJs_Rule($filename,$ext){
		$extend=explode("." , $filename);
		$va=count($extend)-1;
		$ext2=strtolower($extend[$va]);//后缀名
		if($ext2!=$ext) return false;
		$have=explode("_", $filename); //以extend_开头
		if($have[0]!='extend') return false;	
        return true;		
	}
	
	
	/**
	 * 返回文件名字符串中的后缀
	 * $file_name="Cache.class.php"; 
	 */
    private function ext_Rule($filename,$ext){
    		$extend =explode("." , $filename); 
    		$va=count($extend)-1;
    		$e=strtolower($extend[$va]);
    		if($e!=$ext) return false;
    		return true;
    }
    /**
     * 返回文件名字符串中的后缀
     * $file_name="Cache.class.php";
     */
    private function themes_Rule($filename,$ext){
    	$extend=explode("." , $filename);
		$va=count($extend)-1;
		$ext2=strtolower($extend[$va]);//后缀名
		if($ext2!=$ext) return false;
		$have=explode("_", $filename); //以extend_开头
		if($have[0]!='load') return false;	
        return true;	
    }
	/**
	 +----------------------------------------------------------
	 * 删除目录（包括下面的文件）
	 +----------------------------------------------------------
	 * @access static
	 +----------------------------------------------------------
	 * @return void
	 +----------------------------------------------------------
	 */
	function delDir($directory,$subdir=true)
	{
		if (is_dir($directory) == false)
		{
			exit("The Directory Is Not Exist!");
		}
		$handle = opendir($directory);
		while (($file = readdir($handle)) !== false)
		{
			if ($file != "." && $file != "..")
			{
			is_dir("$directory/$file")?
				Dir::delDir("$directory/$file"):
				unlink("$directory/$file");
			}
		}
		if (readdir($handle) == false)
		{
			closedir($handle);
			rmdir($directory);//删除空的目录。
		}
	}

	/**
	 +----------------------------------------------------------
	 * 删除目录下面的所有文件，但不删除目录
	 +----------------------------------------------------------
	 * @access static
	 +----------------------------------------------------------
	 * @return void
	 +----------------------------------------------------------
	 */
	function del($directory)
	{   //目录内的目录不会被删除
		if (is_dir($directory) == false)
		{
			exit("The Directory Is Not Exist!");
		}
		$handle = opendir($directory);
		while (($file = readdir($handle)) !== false)
		{
			if ($file != "." && $file != ".." && is_file("$directory/$file"))
			{
				unlink("$directory/$file");
			}
		}
		closedir($handle);
	}

	/**
	 +----------------------------------------------------------
	 * 复制目录
	 +----------------------------------------------------------
	 * @access static
	 +----------------------------------------------------------
	 * @return void
	 +----------------------------------------------------------
	 */
	function copyDir($source, $destination)
	{
		if (is_dir($source) == false)
		{
			exit("The Source Directory Is Not Exist!");
		}
		if (is_dir($destination) == false)
		{
			mkdir($destination, 0700);
		}
		$handle=opendir($source);
		while (false !== ($file = readdir($handle)))
		{
			if ($file != "." && $file != "..")
			{
				is_dir("$source/$file")?
				Dir::copyDir("$source/$file", "$destination/$file"):
				copy("$source/$file", "$destination/$file");
			}
		}
		closedir($handle);
	}

} 
?>