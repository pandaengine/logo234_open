<?php
class SubmitAction extends Action
{
    public function index()
    {
       /*------------------系统传值----------------*/
	   $config=M('config');   //获取网站信息，描述、关键字、标题等
	   $conf=$config->find();
	   $this->assign('conf',$conf);
       /*------------------系统传值----------------*/
	   $this->display();
	   }
Public function verify(){

import("ORG.Util.Image");

Image::buildImageVerify();

}

   function submit(){
  $cid=$_POST['cid'];
  if(!$cid==1 && !$cid==2){
  $this->error("您需要选择是申请收录还是提交友情链接");
	 }
   $logo234=D('submit');  //要实例化cate因为要访问的数据表是cate， 自动验证也要写在catemodel下
   if($logo234->create()){

  if($_SESSION['verify'] != md5($_POST['verify'])) {

   $this->error('验证码错误！');

 }

   if($logo234->add()){
   $this->success('提交成功，我们会尽快处理，感谢您的支持！');
   }else{
      $this->success('添加失败');
}

   }else{
   $this->error($logo234->getError());
   }
 
   }//add()


}
?>