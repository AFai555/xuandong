<?php
require 'session.php';
$row=_get_one('member',$_SESSION['userid']);
if ($_POST['pn_post']=='确定修改'){
	$data['nickname']=$_POST['nickname'];
	$data['tel']=$_POST['tel'];
	$data['qq']=$_POST['qq'];
	$data['mail']=$_POST['mail'];
		
	if (!is_numeric($data['tel']) || strlen($data['tel'])!=11) {
		ShowMsg('错误：请输入正确的手机号码','-1');
	}
	if (!is_numeric($data['qq']) || strlen($data['qq'])>11 || strlen($data['qq'])<5) {
		ShowMsg('错误：请输入正确的QQ','-1');
	}
	if (!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$data['mail'])) {
		ShowMsg('错误：请输入正确的邮箱','-1');
	}
	
	_update('member',$data,$_SESSION['userid']);
	ShowMsg('成功：用户资料修改成功','gaojian_list.php');
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
	<!-- <div class="weizhibox">当前位置：用户资料管理 &gt;&gt; 完善资料</div> -->
 <?php require 'user_top.php'?>
  <div class="tishibox" style="color:#FF0000;">亲们，为确保您的帐号安全，请完善以下真实资料，谢谢！ </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" bgcolor="#F1F3F9">
      <tr>
        <td width="168" height="30" align="center">QQ号/帐号</td>
        <td><p class="textin10"><?php echo $row['my_username']?></p></td>
      </tr>
      <tr>
        <td height="30" align="center">真实姓名 </td>
        <td><p class="textin10"><input name="nickname" type="text" id="nickname" value="<?php echo $row['nickname']?>" size="20" maxlength="6" />
        </p></td>
      </tr>
       <tr>
        <td height="30" align="center">手机号码 </td>
        <td><p class="textin10">
          <input name="tel" type="text" id="tel" value="<?php echo $row['tel']?>" size="20" maxlength="20" />
        </p></td>
      </tr>
      <tr>
        <td height="30" align="center">联系QQ</td>
        <td><p class="textin10">
          <input name="qq" type="text" id="qq" value="<?php echo $row['qq']?>" size="20" maxlength="11" />
        </p></td>
      </tr>
      <tr>
        <td height="30" align="center">接收邮箱</td>
        <td><p class="textin10">
          <input name="mail" type="text" id="mail" value="<?php echo $row['mail']?>" size="40" maxlength="40" />
           &nbsp;&nbsp;&nbsp; 如需要及时了解发布状态，请在此处填写接收邮箱</p></td>
      </tr>
    </table>
  <div class="subinput"><input type="submit" name="pn_post" value="确定修改" /> <a href="gaojian_admin.php" style="padding-left:20px; text-decoration:underline; color:#0066CC;">跳过这一步</a></div>
</div>
</form>
</body>
</html>
