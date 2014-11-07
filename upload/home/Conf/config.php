<?php
$arr1=array(

	'HTML_CACHE_ON'=>true,
	'HTML_CACHE_TIME'=>10,//时间单位是秒
	'HTML_READ_TYPE'=>0,
	'HTML_FILE_SUFFIX'=>'.html'





);


$arr2=include './config.inc.php';

return array_merge($arr1,$arr2);

?>