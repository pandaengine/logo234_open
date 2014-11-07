<?php
define('IN_LOGO234', TRUE);
require_once("./core/run.php");
// 定义ThinkPHP框架路径
define('THINK_PATH', './core/ThinkPHP');
//定义项目名称和路径
define('APP_NAME', 'home');
define('APP_PATH', './home');
define ( 'RUNTIME_PATH', './~runtime/~home/' );
// 加载框架公共入口文件
require(THINK_PATH."/ThinkPHP.php");
//实例化一个网站应用实例
App::run();
?>