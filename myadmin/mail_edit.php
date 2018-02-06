<?php
require 'session.php';

if ($_GET['act']=='xiugai') {
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['name']=$_POST['name']	;
	$data['tip']=$_POST['tip'];
	$data['user']=$_POST['user'];
	$data['uname']=$_POST['uname'];
	$data['pwd']=$_POST['pwd'];
	if ($data['name']=='') ShowMsg('错误：不能为空','-1');
	if ($data['tip']=='') ShowMsg('错误：不能为空','-1');
	if ($data['user']=='') ShowMsg('错误：不能为空','-1');
	if ($data['uname']=='') ShowMsg('错误：不能为空','-1');
	if ($data['pwd']=='') ShowMsg('错误：不能为空','-1');
	_update('mail',$data,$id);
	ShowMsg('成功：邮箱信息修改成功',$PreviousUrl);

}

$row=_get_one('mail',1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>修改微博</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>邮件提醒设置 &gt; 邮箱信息</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=xiugai">
    <input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
    <input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      <dt><em>SMTP服务器：</em>
        <input name="name" type="text" id="name" size="40" value="<?php echo $row['name']?>" />
      </dt>
      <dt><em>SMTP服务器端口：</em>
        <input name="tip" type="text" id="tip" size="10" value="<?php echo $row['tip']?>" />
        <span class="textinput">默认是25</span></dt>
      <dt><em>SMTP服务器的用户邮箱：</em>
        <input name="user" type="text" id="user" size="40" value="<?php echo $row['user']?>" />
      </dt>
      <dt><em>SMTP服务器的用户帐号：</em>
        <input name="uname" type="text" id="uname" size="40" value="<?php echo $row['uname']?>" />
      </dt>
      <dt><em>SMTP服务器的用户密码：</em>
        <input name="pwd" type="text" id="pwd" size="40" value="<?php echo $row['pwd']?>" />
      </dt>
     <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>