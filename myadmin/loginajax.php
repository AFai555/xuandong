<?php
header("Content-type: text/html; charset=utf-8");
require '../include/conn.php';
session_start();
$adminname=$_POST['adminname'];
$password=$_POST['password'];
$VerifyCode=$_POST['VerifyCode'];
$userip=GetIP();

//AJAX判断
$_char_pattern = '/[<>\'\"\ ]/';
if ($VerifyCode != $_SESSION[an]) {
	echo '{"status":"1","info":"验证码不正确"}';
	exit();
}

if ((preg_match($_char_pattern,$adminname)) || (preg_match($_char_pattern,$password))) {
	echo '{"status":"1","info":"用户名或密码不正确"}';
	exit();
}

$password=md5($password);
$sql="SELECT * FROM admin WHERE adminname='{$adminname}' AND password='{$password}' LIMIT 1";
if (!!$rs=_mysql_show($sql)) {
	$_SESSION['admin']=$rs['id'];
	$_SESSION['lv']=$rs['lv'];
	$_SESSION['username']=$rs['adminname'];
	$_SESSION['dlcs']=$rs['dlcs'];
	$_SESSION['dlip']=$rs['dlip'];
	$_SESSION['dldata']=$rs['dldata'];
	_query("UPDATE admin SET dlcs=dlcs+1,dlip='{$userip}',dldata=NOW() WHERE id='{$rs['id']}'");
	echo '{"status":"2","info":"验证通过"}';
	exit();
}else {
	echo '{"status":"1","info":"用户名或密码不正确"}';
	exit();
}
?>