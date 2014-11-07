<?php
class ToolsAction extends CommonAction
{
	 function index(){
    $go=M('tools');
	$list=$go->select();
	$this->assign('tools',$list);
	$this->display();
	 }//index();
   function add(){
	 $this->display();
   }
   function save(){
   $logo234=M('tools'); 
   if($logo234->create()){
   if($logo234->add()){
     $this->success('添加成功');
   }else{
      $this->success('添加失败');
}

   }else{
   $this->error($logo234->getError());
   }
   }//add()

}//class();
?>