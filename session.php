<?php
//登陆判断
require './include/conn.php';

if (!$_SESSION['userid']) {
	_location2(NULL,'login.php');
}

//单选按钮默认选择
function _danxuan($str1,$str2) {
	if ($str1==$str2) {
		echo 'checked="checked"';
	}else{
		echo '';
	}
}
?>