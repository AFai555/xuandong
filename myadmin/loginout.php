<?php
require '../include/conn.php';
//session_start();
//session_destroy();
unset($_SESSION['admin']);
ShowMsg('成功：您已成功退出系统','login.php');
exit();
?>