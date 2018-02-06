<?php
require './include/conn.php';

//单选按钮默认选择
function _danxuan($str1,$str2) {
	if ($str1==$str2) {
		echo 'checked="checked"';
	}else{
		echo '';
	}
}
?>