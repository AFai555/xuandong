<?php

require 'session.php';

if ($_GET['act']=='xiugai') {
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	$password3=$_POST['password3'];
	
	if ($password==''|| $password2=='') {
		ShowMsg('错误：原密码及新密码都不能为空','-1');
		exit();
	}
	if ($password2 != $password3) {
		ShowMsg('错误：新密码两次输入不一致','-1');
		exit();
	}
	
	$password=md5($password);
	$password2=md5($password2);
	$sql="SELECT * FROM admin WHERE id={$_SESSION['admin']} AND password='{$password}'";
	if (!!$rs=_mysql_show($sql)) {
		_query("UPDATE admin SET password='{$password2}' WHERE id={$_SESSION['admin']}");
		ShowMsg('成功：密码修改成功','password.php');
		exit();
	}else{
		ShowMsg('错误：原密码错误','-1');
		exit();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>修改密码</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>首页 &gt; 管理员设置 &gt; 修改密码</div>
<div class="mainbox">
<form  name="add" method="post" action="?act=xiugai">
  <dl>
    <dt><em>原密码：</em>
      <input name="password" type="password" id="password" size="30" />
      <span class="textinput">请输入原密码</span> </dt>
    <dt><em>新密码：</em>
      <input name="password2" type="password" id="password2" size="30" />
      <span class="textinput">请输入新密码</span></dt>
    <dt><em>确认密码：</em>
      <input name="password3" type="password" id="password3" size="30" />
      <span class="textinput">必须和上面的新密码保持一致</span></dt>
    <dt>
      <input type="submit" value="修改" class="lbnt" />
      <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
    </dt>
  </dl>
</form>  
</div>
</body>
</html>
