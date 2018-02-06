<?php
//登陆判断
if (!$_SESSION['userid']) {
	_location2(NULL,'login.php');
	exit;
}
?>