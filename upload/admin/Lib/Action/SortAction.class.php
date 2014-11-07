<?php
class SortAction extends  CommonAction
{
   Public function index(){
	$file=M('index');
	$list=$file->order('sort')->select();   //读取thinkp_file数据库
	$this->assign('listname',$list);
    $this->display();

}//index()

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