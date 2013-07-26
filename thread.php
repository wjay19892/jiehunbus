<?php
define('APP_DEBUG',TRUE); // 开启调试模式
// 定义ThinkPHP框架路径
define('THINK_MODE','Lite');
define('THINK_PATH', './ThinkPHP');
//定义项目名称和路径
define('APP_NAME', 'Thread');
define('APP_PATH', './Thread');
define('ROOT_PATH', str_replace("\\", '/', dirname(__FILE__)));
define('RUNTIME_PATH','./Runtime/Thread/');
define('STRIP_RUNTIME_SPACE', false);
// 加载框架入口文件
require(THINK_PATH."/ThinkPHP.php");
//实例化一个网站应用实例
App::run();
?>