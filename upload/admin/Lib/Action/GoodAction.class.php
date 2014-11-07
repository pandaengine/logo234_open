<?php
class GoodAction extends CommonAction
{
   Public function index(){
  $cate=D('cate');
  $list=$cate->field("id,name,pid,path,sort,concat(path,'-',id) as bpath")->order('bpath')->select();

  foreach($list as $key=>$value){
	  $list[$key]['count']=count(explode('-',$value['bpath']));//explode(）以“-”切割字符串
   }
  $this->assign('alist',$list);

  $good=M('good');
  $list=$good->order('sort')->select();
  $this->assign("good",$list);

  $this->display();

   }//index()
   #################################################################################
   function add(){
   $cate=D('good');  //要实例化cate因为要访问的数据表是cate， 自动验证也要写在catemodel下
   if($cate->create()){
   if($cate->add()){
   $this->success('添加成功');
   }else{
      $this->success('添加失败');
}

   }else{
   $this->error($cate->getError());
   }
   
   }//add()
   #################################################################################
   function update(){
   $user=M('good');
   if($user->create()){
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
   function del(){
   $logo234=M('good');
   $id=(int)$_GET['id'];
   if($logo234->delete($id)){
    $this->success('数据库、文件删除成功');
   }else{
	  
	    $this->error('删除失败');
   }

   }
   #################################################################################

}//class();
?>