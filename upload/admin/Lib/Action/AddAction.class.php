<?php
class AddAction extends  CommonAction
{
   Public function index(){
   	
   //	$_SESSION=array();
   	$cate=D('cate');
   	$list=$cate->field("id,name,name_html,pid,path,sort,concat(path,'-',id) as bpath")->order('bpath')->select();
   	foreach($list as $key=>$value){
   		$list[$key]['count']=count(explode('-',$value['bpath']));//explode(）以“-”切割字符串
   	}
   	$this->assign('alist',$list);
   	
  $id=$_GET['id'];
  $cate=M('cate');
  $now=$cate->where("id=".$id)->find();
  $this->assign('now',$now);
  $file=M('site');
  $list=$file->where("cid=$id")->order('id desc')->select();   //读取thinkp_file数据库
  $this->assign('listname',$list);
  $this->display();

} 

   function upload(){
 
	   if(empty($_FILES)){
		   $this->error('必须选择上传文件');
	   }else{ 
		   $a=$this->up();
		   if(isset($a)){
			   //写入数据库
			   if($this->c($a)){
			   $this->success('上传成功');
			   }else{
			   $this->error('上传失败');
			   }
		   
		   
		   }else{
		   $this->error('上传文件异常');
		   }
		   }


   } 
   private function c($data){
	   $file=M('site');      //链接thinkp_file数据库
	   $cid=$_POST['cid'];
	   $list=$file->where("cid=$cid")->order('id desc')->find();  //where中必须用双引号
	   $sort=$list['sort'];
	   if(!empty($sort)){
	    $data['sort']=$sort+2;
	   }else{
	   $data['sort']=1;
	   }
	   $data['filename']=$data[0]['savename'];   //up()中文件的名称 filename为数据库中文件名称
       $data['title']=$_POST['title'];  //表单传过来的name：cid、url、title对应数据库字段名即可插入 
       $data['url']=$_POST['url'];
       $data['cid']=$cid;
	   
       //$data['cid']=$_POST['cid'];
       //$data['sort']=$_POST['id'];

	   if($file->data($data)->add()){
	   return true;
	   }else{  return false;}
   }//c();

   private function up(){
	   $goto234=M('cate');
	   $cname=$_POST['cid'];
	   $chtml=$goto234->where("id=$cname")->find();
	   $dirname=$chtml['name_html'];

       //dump($dirname);
       //dump($cname);

	   //echo "模拟上传";
       //基本上传 批量上传 图片缩略 自定义参数 上传检测 支持覆盖  上传类型，大学路劲
       //安全性检测  hash检测 文件名自定义规范
	   //import('@.Org.UploadFile');//导入类库
	   import("ORG.Net.UploadFile");
	   $upload=new UploadFile();
	   //$upload->maxSize=''; //限制上传文件大小
	   $upload->savePath='./Public/uploads/'.$dirname.'/';//上传保存路径  以主文件入口为
	   //$upload->saveRule=uniqid;//文件保存规则
	   $upload->autoCheck=false;//是否自动检测附件
	   $upload->uploadReplace=true;//同名文件是否覆盖
	   $upload->allowExts=array('jpg','jpeg','gif');//准许上传文件后缀
	   $upload->allowTypes=array('image/jpg','image/jpeg','image/gif');//准许上传文件后缀
	   $upload->thumb=false;//是否开启缩略图
	  // $upload->thumbMaxWidth='300,500';//缩略图最大宽度
	  //$upload->thumbMaxHeight='200,400';
	  // $upload->thumbPrefix='s_,m_';//缩略图文件前缀
	  //$upload->thumbMaxWidth='300';//缩略图最大宽度
	  // $upload->thumbMaxHeight='200';
	  // $upload->thumbPrefix='s_';//缩略图文件前缀
	  //$upload->thumbSuffix='s_,m_';//缩略图文件后缀
	  //$upload->thumbPath='./Public/upload/s/';//缩略图保存路径，留空则为保存文件路径
	  //$upload->thumbFile   //略图的名字
	  //$upload->thumbRemoveOrigin=0; //生成缩略图时是否删除原文件
	  //$upload->autoSub  是否使用子目录进行保存上传文件
	   if($upload->upload()){
		   $info=$upload->getUploadFileInfo();
		   return $info;
	   }else{
	   $this->error($upload->getErrorMsg());
	   }

   }//up();

   function add(){
	//Load('extend');
    $file=D('site');  
    $file->create();
	   $file->add();
   }
} 
?>