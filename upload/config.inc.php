<?php 
$inc=array (		
		'IDB_PREFIX' => '_PRE_', // iDbMysqli替换的表前缀	
		'TOKEN_ON' => false, // 是否开启令牌验证
		'URL_MODEL' =>0, //采用传统的URL参数模式
		'APP_DEBUG' => false
		
);

$db= require_once( './config.db.php' );
return array_merge($inc,$db);
?>