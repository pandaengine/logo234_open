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


	protected  $_link=array(

		"cate"=>array(
		    'mapping_type'=>HAS_ONE,
			'class_name'=>'cate',
			'mapping_name'=>'cate',
			'foreign_key'=>'cid',
		    'as_fields'=>'name,id:cate_id',


			//condition
			//foreign_key
			//mapping_fields  需要关联的字段
			//as_fields
		
		
		
		),
		
	
	
	
	);//array  $_link




}//model()

?>