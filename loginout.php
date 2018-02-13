<?php
require './include/conn.php';
//session_destroy();
unset($_SESSION['userid']);
ShowMsg('成功：您已成功退出自助发布系统','index.php');
exit();
?>