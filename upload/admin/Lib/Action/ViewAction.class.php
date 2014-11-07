<?php
class ViewAction extends Action
{
	public function _initialize(){
		$config=M('config');   //获取网站信息，描述、关键字、标题等
		$conf=$config->find();
		$this->assign('conf',$conf);
		
	}
	
    public function index($GET=''){
    	if($GET){
    		$_GET=$GET;
    	}
        if($_GET['catelist']){
        	$this->_view_catelist();
        	exit();
        }
        if($_GET['cateid']){      	       
        	return $this->_view_category();
        }else if($_GET['more_cateid']){
        	return $this->view_more();
        }else
            $this->_view_index();
        
	 }
    /**
     * 预览
     */
	  private function _view_index(){
	  	$file=M('index');
	  	$list=$file->order('sort')->select();
	  	$this->assign('listname',$list);
	  	$good=M('good');
	  	$list1=$good->order('sort')->select();

	  	foreach ($list1 as $k=>$v){
	  		$temp=D('cate')->where('id='.$v['cid'])->find();
	  		$list1[$k]['name_html']=$temp['name_html'];
	  	}  	
	  	$this->assign("list_cate",$list1);
	  	
	  	$tpl='Tpl:index';
	  	if(!$_GET['build_html'] ){
	  		$this->display($tpl);
	  	  }else{
	  		$this->buildHtml("index", "./",$tpl);
	  		echo "<br/><h2 style='background:#ffff99;'><hr/>";
  	        echo  "首页Html文件生成成功！<br/><br/></h2>";
	  	 }

	  	}
	  	
 
	  private function _view_category(){  
	  	$file=M('site');	 //取出当前分类下的内容
	  	$id=0;
	  	$id=(int)$_GET['cateid'];  //传入当前分类的id
	  	$list=$file->order('sort')->where("cid=$id")->select();
	  	$this->assign('listname',$list);
	  	
	  	$cate1=M('cate');   //找出与当前分类 并返回其的信息
	  	$nowcate=$cate1->where("id=$id")->find();   //找出当前所在的一个分类   使用双引号！！！！！！！！！！！！！！！！
	  	$now=$nowcate['name_html'];
	  	$nowname=$nowcate['name'].'--';
	  	$count=count(explode('-',$nowcate['path']));
	  	$this->assign('nowcate',$now);
	  	$this->assign('nowname',$nowname);
	  	$this->assign('count',$count);
	  	
	  	$site=new Model('site');
	  	$ca=new Model('cate');
	  	$parent=$ca->where("pid=$id")->order('sort')->select();
	  	foreach($parent as $key => $value){
	  		$id2=$value['id'];
	  		$parent[$key]['voo']=$site->where("cid=$id2")->order('sort')->select();  //注意voo无$符号
	  	}
	  	
	  	$this->assign('next',$parent);  //必须为parent 同名
	  	
	  	$pid=$nowcate['pid'];
	  	$cate2=M('cate'); //找出该分类的同一上级的、同级分类
	  	$list_cate=$cate2->where("pid=$pid")->order("sort")->select();   //找出当前所在分类的上一级下的所有分类，比如学习、娱乐、生活下所有分类。使用双引号
	  	$this->assign("list_cate",$list_cate);
	  	
	  	$cate3=M('cate'); //取出当前分类的上级 信息
	  	$big=$cate3->where("id=$pid")->find();
	  	$this->assign("bigcate",$big);
	  	$tpl='Tpl:cate';
	  	
	  	if(!$_GET['build_html']){
	  		$this->display($tpl);
	  	}else{
	  		$this->buildHtml($now, "./html/",$tpl);
	  		if($_GET['mk_html'])
	  		   return $nowcate['name'].":".$nowcate['name_html']."生成成功！";
	  		else
	  		   echo  $nowcate['name'].":".$nowcate['name_html']."生成成功！";
	  	}
	  	
	  }
	  private function _view_catelist(){
	  	$cate=M('cate');   //找出与当前分类 并返回其的信息
	  	$list=$cate->field("id,name,name_html,pid,path,sort,concat(path,'-',id) as bpath")->order('bpath')->select();
	  	foreach($list as $key=>$value){
	  		$list[$key]['count']=count(explode('-',$value['bpath']));//explode(）以“-”切割字符串
	  	}
	  	$this->assign('catelist',$list);
	  	
	  	$good=M('good');
	  	$list1=$good->order('sort')->select();
	  	$this->assign("good",$list1);
	  	$tpl='Tpl:catelist';
	  	if(!$_GET['build_html']){
	  		$this->display($tpl);
	  	}else{
	  		$this->buildHtml('allcate', "./html/",$tpl);
	  		echo "<br/><h2 style='background:#ffff99;'><hr/>";
	  		echo  "所有分类：allcate!<br/>Html文件生成成功！</h2>";
	  	}
	  }
	  
	  public function view_about(){
	  	$tpl='Tpl:about';
	  	if(!$_GET['build_html']){
	  		$this->display($tpl);
	  		echo 'ohoo';
	  	}else{
	  		$this->buildHtml('about', "./",$tpl);
	  		echo "<br/><h2 style='background:#ffff99;'><hr/>";
	  		echo  "about!<br/>Html文件生成成功！</h2>";
	  	}
	  	
	  }
	  public function view_more(){	  	
	  	
	  	$config=M('configmore');   //获取网站信息，描述、关键字、标题等
	  	$conf=$config->find();
	  	$this->assign('conf',$conf);
	  	/*------------系统信息-------------*/
	  	
	  	$id=$_GET['more_cateid'];  //传入当前分类的id
	  	if($id=='index'){
	  		$now='index';
	  		$this->assign('nowcate',$now);
	  		$this->assign('nowname','more首页');
	  		$nowcate=array('name'=>'more首页');
	  		
	  	}else{
	  	 $cate1=M('cate');   //找出与当前分类 并返回其的信息
	  	 $nowcate=$cate1->where("id=$id")->find();   //找出当前所在的一个分类   使用双引号！！！！！！！！！！！！！！！！
	  	 $now=$nowcate['name_html'];
	  	 $nowname=$nowcate['name'];
	  	 $this->assign('nowcate',$now);
	  	 $this->assign('nowname',$nowname);
	  	}
	  	$tpl='Tpl:more';
	  	if(!$_GET['build_html']){
	  		$this->display($tpl);
	  	}else{
	  		$this->buildHtml($now, "./more/",$tpl);
	  		if($_GET['mk_html'])
	  		   return $nowcate['name'].":".$nowcate['name_html']."生成成功！";
	  		else
	  		   echo  $nowcate['name'].":".$nowcate['name_html']."生成成功！";
	  		 
	  	}
	  }
	  
	  
	  
 
}
?>