<?php
class MakehtmlAction extends CommonAction
{
   public function index(){
   	//生成首页
   	$type=$_GET['type'];
   	if($type=='index'){
   		//生成首页
   		$GET['build_html']=1;
   		$obj=new ViewAction();
   		$res=$obj->index($GET);
   		exit();
   	}
   	if($type=='catelist'){
   		//内容分类列表
   		$GET['build_html']=1;
   		$GET['catelist']=1;
   		$obj=new ViewAction();
   		$res=$obj->index($GET);
   		exit();
   	}
   	if($type=='all'){
   		//生成整站
   		$this->all();
   		exit();
   	}
    	$this->display();
   }
   private function all(){
   	 // $list=D('cate')->where('pid!=0')->select();
   	   $list=D('cate')->select();
   	  $obj=new ViewAction();
   	  $i=1;
   	  $GET['build_html']=1;
   	  $GET['mk_html']=1;
   	  echo '<table style="color:green;font-size:12px;">';
   	  foreach ($list as $v){
   	  	$GET['cateid']=$v['id'];   	
   	  	if($i==1) $html.='<tr>';
   	  	$html.='<td>'.$obj->index($GET).'</td>';
   	  	if($i==6) $html.='</tr>';
   	  	$this->flush($html);
   	  	$html='';//置空
   	  	if($i==6){
   	  		$i=1;
   	  	}else  $i++;
   	  }
   	  echo '</table>';
   	  
   }
   public function buildmore(){
   	//$list=D('cate')->where('pid!=0')->select();
   	$list=D('cate')->select();
   	$obj=new ViewAction();
   	$i=1;
   	$GET['build_html']=1;
   	$GET['mk_html']=1;
   	echo '<table style="color:green;font-size:12px;">';
   	foreach ($list as $v){
   		$GET['more_cateid']=$v['id'];
   		if($i==1) $html.='<tr>';
   		$html.='<td>'.$obj->index($GET).'</td>';
   		if($i==6) $html.='</tr>';
   		$this->flush($html);
   		$html='';//置空
   		if($i==6){
   			$i=1;
   		}else  $i++;
   	}
   	echo '</table>';
   	
   }
   	
	/**
	 * 即时输出提示信息
	 * @return
	 */
	public static function flush($msg)
	{
		echo $msg;
		ob_flush();
		flush();
	}
   
   

}
?>