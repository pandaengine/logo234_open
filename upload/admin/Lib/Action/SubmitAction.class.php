<?php
class SubmitAction extends  CommonAction
{
   Public function index(){
	$file=M('submit');
	$list=$file->select();   //读取thinkp_file数据库
	$this->assign('listname',$list);
    $this->display();

}//index()

}//class();
?>