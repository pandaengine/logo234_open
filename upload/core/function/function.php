<?php 
/**
 * 导入函数库文件
 */
function import_function($name){
	require_once './core/function/'.$name.'.php';
}
/**
 * 导入类库文件
 */
function import_class($name){
	require_once './core/class/'.$name.'.class.php';
}

function  import_lib($name){
	require_once './core/lib/'.$name.'.class.php';
}


?>