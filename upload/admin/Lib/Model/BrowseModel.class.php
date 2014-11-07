<?php
class BrowseModel extends RelationModel{              //Relation
	
	protected  $_link=array(

		"cate"=>array(
		    'mapping_type'=>HAS_MANY,
			'class_name'=>'cate',
			'mapping_name'=>'cate',
			'foreign_key'=>'id',
			//'mapping_fileds'=array('id','uid','title'),
			//'mapping_fields'=>'id,uid,title',
			//'as_fields'=>'title,id:good_id', //组合为上一个表的字段





			//condition
			//foreign_key
			//mapping_fields  需要关联的字段
			//as_fields
			//mapping_limit
			//mapping_order
			//parent_key
		
		
		
		),
		
	
	
	
	);//array  $_link
}//class();

?>