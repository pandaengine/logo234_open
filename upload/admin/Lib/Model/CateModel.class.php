<?php
class CateModel extends Model{
protected $_auto=array(
	array("path","tclm",3,"callback"),
	array("sort","autosort",3,"callback"),

); //$_auto系统类

function autosort(){
$pid=isset($_POST['pid'])?(int)$_POST['pid']:0;  //pid为选中分类的id
if($pid==0){return 0;}
$list=$this->where("pid=$pid")->order('id desc')->find();//找出属于pid下id值最大的分类，以便所有分类进行排序
$sort=$list['id'];
dump($sort);
if(!empty($sort)){
return $sort+1;
}else{return 1; }

} //autosort();






function tclm(){   //tclm 填充栏目

$pid=isset($_POST['pid'])?(int)$_POST['pid']:0;
if($pid==0){return 0;}
$list=$this->where("id=$pid")->find();//列出id=$pid的一行数据
//echo $pid;
//dump($list);
$data=$list['path']."-".$list['id'];
return $data;


}//tclm()
protected $_validate=array(
  array('name','require','中文分类名必填'),
  array('name_html','require','英文分类名必填，否则无法生成html文件'),
   );


}//model()

?>