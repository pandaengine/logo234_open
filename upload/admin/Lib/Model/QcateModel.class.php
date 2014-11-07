<?php
class QcateModel extends Model{//无对于的qcate数据表  无须此model
	/*
protected $_auto=array(
	array("path","tclm",3,"callback"),

); //$_auto系统类

function tclm(){   //tclm 填充栏目

$pid=isset($_POST['pid'])?(int)$_POST['pid']:0;
if($pid==0){return 0;}
$list=$this->where("id=$pid")->find();//列出id=$pid的一行数据
$data=$list['path']."-".$list['id'];
return $data;
}//tclm()








}//model()

?>