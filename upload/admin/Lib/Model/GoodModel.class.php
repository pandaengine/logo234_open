<?php
class GoodModel extends Model{
protected $_auto=array(
	array("sort","autosort",3,"callback"),
    array("name","catename",3,"callback"),
); //$_auto系统类

function autosort(){
$list=$this->order('id desc')->find();//找出属于pid下id值最大的分类，以便所有分类进行排序
$sort=$list['sort'];
if(!empty($sort)){
return $sort+2;
}else{return 1; }

} //autosort();

function catename(){
$go=M('cate');
$cid=$_POST['cid'];
$good=$go->where("id=$cid")->find();
return $good['name'];
}

}//model()

?>