<?php
require 'session.php';
if ($_POST['pn_post']=='确定修改'){
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	$password3=$_POST['password3'];
	
	if ($password=='' || $password2=='') {
		ShowMsg('错误：原密码及新密码都不能为空','-1');
	}
	if ($password2 != $password3) {
		ShowMsg('错误：新密码两次输入不一致','-1');
	}
	
	$password=md5($password);
	$password2=md5($password2);
	$sql="SELECT * FROM member WHERE id={$_SESSION['userid']} AND my_password='{$password}'";
	if (!!$rs=_mysql_show($sql)) {
		_query("UPDATE member SET my_password='{$password2}' WHERE id={$_SESSION['userid']}");
		ShowMsg('成功：密码修改成功','main.php');
	}else{
		ShowMsg('错误：原密码错误','-1');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻软文自助发布平台</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="" method="post">
<div class="main">
	<div class="weizhibox">当前位置：用户资料管理 &gt;&gt; 修改密码</div>
    <?php require 'user_top.php'?>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" bgcolor="#F1F3F9">
      <tr>
        <td width="168" height="30" align="center">QQ号/帐号</td>
        <td><p class="textin10"><?php echo $_SESSION['user_name']?></p></td>
      </tr>
      <tr>
        <td height="30" align="center">原密码</td>
        <td><p class="textin10"><input name="password" type="password" id="password" size="20" />
        </p></td>
      </tr>
      <tr>
        <td height="30" align="center">新密码 </td>
        <td><p class="textin10">
          <input name="password2" type="password" id="password2" size="20" />
        </p></td>
      </tr>
      <tr>
        <td height="30" align="center">确认密码</td>
        <td><p class="textin10">
          <input name="password3" type="password" id="password3" size="20" />
        </p></td>
      </tr>
    </table>
  <div class="subinput"><input type="submit" name="pn_post" value="确定修改" /></div>
</div>
</form>
</body>
</html>
