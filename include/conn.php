<?php
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set("Asia/Shanghai");
header("Content-type: text/html; charset=utf-8");
session_start();

//防注入
require 'security.php';

require 'config.index.php';
$config_time=$config_time_day*86400;

//引入函数库
require 'function.php';
require 'mysql_func.php';

//数据库连接参数
require 'common.inc.php';

//初始化数据库
_connect();   //连接MYSQL数据库
_select_db();   //选择指定的数据库
_set_names();   //设置字符集
?>