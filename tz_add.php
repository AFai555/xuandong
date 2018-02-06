<?php
require 'session.php';
if ($_POST['pn_post']=='提交'){
	$data['title']='会员提问-及时回复';
	$data['body']=$_POST['tz'];
	$data['state']=1;
	$data['pid']=$_SESSION['userid'];
	$data['addtime']=_nowtime();
	if ($data['body']=='') ShowMsg('错误：内容不能为空','-1');
	_insert('tongzhi',$data);
	ShowMsg('成功：提交成功','seetz8.php');
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
	<div class="weizhibox">当前位置：留言管理 &gt;&gt; 留言</div>
    <?php require 'user_top.php'?>
     <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td>
<p class="mc"><a href="tz_add.php">给管理员留言</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="seetz8.php">查看留言回复</a></p>
</td></tr></table>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" bgcolor="#F1F3F9">
      <tr>
        <td width="168" height="84" align="center">留言内容</td>
        <td><p class="mc">
          <textarea name="tz" cols="60" rows="6" id="tz"></textarea>
        </p></td>
      </tr>
    </table>
  <div class="subinput"><input type="submit" name="pn_post" value="提交" /></div>
</div>
</form>
</body>
</html>
