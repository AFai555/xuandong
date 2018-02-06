<?php 

require 'session.php';

if ($_GET['act']=='xiugai' && isset($_POST['id'])) {
	$id=$_POST['id'];
	$tg_admin=$_POST['admin'];
	$tg_password=$_POST['password'];
	$tg_password2=$_POST['password2'];
	
	if ($tg_admin=="" || $tg_password=="") {
		ShowMsg('错误：用户及密码不能为空','-1');
		exit();
	}
	if ($tg_password!=$tg_password2) {
		ShowMsg('错误：二次密码不一致','-1');
		exit();
	}
	$tg_password=md5($tg_password);
	_query("UPDATE admin SET adminname='{$tg_admin}',password='{$tg_password}' WHERE id='{$id}'");
	ShowMsg('成功：管理员修改成功','administrator.php');
	exit();
}

$row=_mysql_show("SELECT * FROM admin WHERE id={$_GET['id']} LIMIT 1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>修改管理员</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>设置 &gt; 管理员管理 &gt; 修改管理员</div>
<div class="mainbox">
<form  name="add" method="post" action="?act=xiugai">
  <dl>
    <dt><em>用户名：</em>
      <input name="admin" type="text" id="admin" value="<?php echo $row['adminname']?>" size="40" />
      <span class="textinput">请输入管理员用户名</span> 
      <input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
    </dt>
    <dt><em>密码：</em>
      <input name="password" type="password" id="password" size="30" />
      <span class="textinput">请输入密码</span></dt>
    <dt><em>确认密码：</em>
      <input name="password2" type="password" id="password2" size="30" />
      <span class="textinput">必须和上面的新密码保持一致</span></dt>
    <dt>
      <input type="submit" value="确认" class="lbnt" />
      <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
    </dt>
  </dl>
</form>  
</div>
</body>
</html>