<?php
class AddModel extends RelationModel{   //Relation
protected $_auto=array(array("cname","tclm",3,"callback")); //$_auto系统类

function tclm(){   //tclm 填充栏目

$cate=M('cate');
$cid=isset($_POST['cid'])?(int)$_POST['cid']:0;
if($cid==0){
 $this->error('请选择一个分类');
	}
$list=$cate->where("id=$cid")->find();//列出id=$pid的一行数据




$data=$list['name'];
return $data;
}//tclm()
//######################################################################
?>