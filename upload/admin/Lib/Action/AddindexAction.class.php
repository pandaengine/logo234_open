<?php
class AddindexAction extends  CommonAction
{
   Public function index(){
	$file=M('index');
	$list=$file->order('id desc')->select();   //读取thinkp_file数据库
	$this->assign('listname',$list);
    $this->display();

}//index()

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


   }//upload();
   private function c($data){
	   //$file=D('index');      
	   	$file=new IndexModel();      //链接think_index数据库   
		$list=$file->order('id desc')->find();
	   $sort=$list['sort'];
	   if(!empty($sort)){
	    $data['sort']=$sort+2;
	   }else{
	   $data['sort']=1;
	   }
	   $data['filename']=$data[0]['savename'];   //up()中文件的名称 filename为数据库中文件名称
       $data['title']=$_POST['title'];
       $data['url']=$_POST['url'];

	   if($file->data($data)->add()){
	   return true;
	   }else{  return false;}
   }//c();

   private function up(){
	   import("ORG.Net.UploadFile");
	   $upload=new UploadFile();
	   $upload->savePath='./Public/uploads/index/';//上传保存路径  以主文件入口为
	   $upload->autoCheck=false;//是否自动检测附件
	   $upload->uploadReplace=true;//同名文件是否覆盖
	   $upload->allowExts=array('jpg','jpeg','gif');//准许上传文件后缀
	   $upload->allowTypes=array('image/jpg','image/jpeg','image/gif');//准许上传文件后缀
	   $upload->thumb=false;//是否开启缩略图
	   if($upload->upload()){
		   $info=$upload->getUploadFileInfo();
		   return $info;
	   }else{
	   $this->error($upload->getErrorMsg());
	   }

   }//up();

   function add(){
   	$file=new IndexModel();  
   $file->create();
	   $file->add();
   }

   #################################################################################
   function del(){
   $logo234=M('index');
   $id=(int)$_GET['id'];
   $list=$logo234->where("id=$id")->find();//find   一维数组
   $filename=$list['filename'];
   echo $filename;
   $file=__ROOT__."/Public/upload/".$filename;
   echo "<img src='$file'/><br/> 注意upload下的文件没有被删除";
   /*
   $file2="../../../public/upload/".$filename;
   dump($file2);
   dump(unlink($file2));*/

   if($logo234->delete($id)){
    $this->success('数据库、文件删除成功');
   }else{
	  
	    $this->error('删除失败');
   }

   }
   #################################################################################


   function edit(){
    $user=M('index');
	$id=(int)$_GET['id'];
	$list=$user->where("id=$id")->find();//find   一维数组
    $this->assign('list',$list);
	$this->assign('title','编辑内容');

	$this->display();

}
   #################################################################################
   function update(){
   $user=M('index');
   if($user->create()){
	   //$user->password=md5($user->password);
	   if($insertid=$user->save()){
	   	    $this->success('更新成功,插入ID为：'.$insertid);
	   }else{
	    $this->error('更新失败');
	   }
	   
   }else{
	    $this->error($user->getError());
   }

   }
   #################################################################################
   
   






















}//class();
?>