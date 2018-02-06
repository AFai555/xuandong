<?php
require '../include/conn.php';

if (!$_SESSION['admin']) {
	_location(NULL,'login.php');
}

$getsorttype=array('单页','新闻','产品','案例','图片');//内容分类
$getadtype=array('未定义','幻灯片','文字','图片','自定义广告');//广告链接分类


//单选按钮默认选择
function _danxuan($str1,$str2) {
	if ($str1==$str2) {
		echo 'checked="checked"';
	}else{
		echo '';
	}
}

//下拉菜单默认选择
function _xiala($str1,$str2) {
	if ($str1==$str2) {
		echo 'selected="selected"';
	}else{
		echo '';
	}
}

//判断是否是推荐
function _tuijian($str1) {
	if ($str1==1) {
		echo '<em>[推荐]</em>';
	}
}

//判断栏目是否被锁定
function _islock($str1) {
	if ($str1==1) {
		echo '<b>[是]</b>';
	}else{
		echo '[否]';
	}
}

//判断锁定的栏目无法选择
function _isdisabled($str1) {
	if ($str1) {
		echo 'disabled="disabled"';
	}
}

//判断是否有缩略图
function _isnopic($str1) {
	if ($str1) {
		echo '<a href="'.$str1.'" target="_blank" title="查看缩略图"><img src="images/showimg.gif" align="absmiddle" /></a>';
	}
}

?>