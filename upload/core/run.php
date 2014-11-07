<?php
/**
 * QingCms初始化
 */
if(!defined('IN_LOGO234')) {
	exit('Access Denied');
}
define("WWW_DEBUG", 0);
if (defined("WWW_DEBUG") && WWW_DEBUG)
{
	//@ini_set("error_reporting", E_ALL);
	error_reporting(E_ALL ^ E_NOTICE);
	@ini_set("display_errors", TRUE);
}else{
	@ini_set("display_errors", false);
}
require_once("./core/function/function.php");


?>