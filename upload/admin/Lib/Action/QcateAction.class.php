<?php
class QcateAction extends CommonAction
{
   Public function index(){
  $cate=D('cate');
  $list=$cate->field("id,name,pid,path,sort,concat(path,'-',id) as bpath")->order('bpath')->select();

  foreach($list as $key=>$value){
	  $list[$key]['count']=count(explode('-',$value['bpath']));//explode(）以“-”切割字符串
   }
  $this->assign('alist',$list);
  $this->display();

   }//index()
   function add(){
   $cate=D('cate');  //要实例化cate因为要访问的数据表是cate， 自动验证也要写在catemodel下
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


}//class();
?>