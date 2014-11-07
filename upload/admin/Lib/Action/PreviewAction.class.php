<?php
class PreviewAction extends Action
{
    public function index()
    {
	   $config=M('config');   //获取网站信息，描述、关键字、标题等
	   $conf=$config->find();
	   $this->assign('conf',$conf);
     /*-----------------------网站必备信息---------------------*/
       
	   $file=M('site');	 //取出当前分类下的内容
	   $id=0;
	   $id=(int)$_GET['id'];  //传入当前分类的id
	   $list=$file->order('sort')->where("cid=$id")->select();
	   $this->assign('listname',$list);

	   $cate1=M('cate');   //找出与当前分类 并返回其的信息
	   $nowcate=$cate1->where("id=$id")->find();   //找出当前所在的一个分类   使用双引号！！！！！！！！！！！！！！！！
	   $now=$nowcate['name_html'];
	   $nowname=$nowcate['name'];
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

	   $this->display();
        $this->buildHtml("$now", "./Html/","index");  
		echo "<br/><h2 style='background:#ffff99;'><hr/>";
	    echo  $nowcate['name'].":".$nowcate['name_html']."<br/>Html文件生成成功！</h2>";
	   }

}
?>