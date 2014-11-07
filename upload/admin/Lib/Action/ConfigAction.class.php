<?php
class ConfigAction extends  CommonAction
{
   Public function index(){
  $logo23=M('config');
  $config=$logo23->find();
  $this->assign('config',$config);

  $more=M('configmore');
  $configmore=$more->find();
  $this->assign('configmore',$configmore);
  $this->display();
   } 

 function update(){
   $goto234=M('config');
   if($goto234->create()){
   	   $insertid=$goto234->save();
	   if(!($insertid===false)){
	   	    $this->success('更新成功');
	   }else{
	    $this->error('更新失败');
	   }
   }else{
	    $this->error($goto234->getError());
   }
   } 


 function updatemore(){
   $goto234=M('configmore');
   if($goto234->create()){
   	   $insertid=$goto234->save();
	   if(!($insertid===false)){
	   	    $this->success('更新成功');
	   }else{
	    $this->error('更新失败');
	   }
   }else{
	    $this->error($goto234->getError());
   }
   } 





} 
?>