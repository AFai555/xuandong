<?php
header("Content-type: text/html; charset=utf-8");
require 'include/conn.php';
//防注入
require 'include/security.php';
if (!$_SESSION['referee']){
	$_SESSION['referee']=0;
}

$data['my_username']=$_POST['username'];
$data['my_password']=$_POST['password'];
$VerifyCode = $_POST['VerifyCode'];
$data['my_password']=md5($data['my_password']);
$data['regtime']=_nowtime();
$data['referee']=$_SESSION['referee'];

//AJAX判断
$_char_pattern = '/[<>\'\"\ ]/';
if ($VerifyCode != $_SESSION[an]) {
	echo '{"status":"1","info":"验证码不正确"}';
	
	exit();
}

if (_get_one_tj('member',"my_username='{$data['my_username']}'")){
	echo '{"status":"1","info":"该帐号已被注册"}';
	exit();
}
_insert('member',$data);

if ($row=_get_one_tj('member',"my_username='{$data['my_username']}' AND my_password='{$data['my_password']}'")){
	$_SESSION['userid']=$row['id'];
	$_SESSION['user_name']=$row['my_username'];
	if (time()-strtotime($row['regtime'])>$config_time){
		$_SESSION['referee']=0;
	}else{
		$_SESSION['referee']=$row['referee'];
	}
		echo '{"status":"2","info":"验证通过"}';
		exit();
}
?>