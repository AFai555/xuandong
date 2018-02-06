<?php
require 'session.php';

$row=_get_ones('jugaohf',$_GET['id']);
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
        <td width="168" height="84" align="center">拒搞原因：</td>
        <td><p class="mc">
          <textarea name="tz" cols="60" rows="6" readonly="readonly" id="tz"><?php echo $row['body']?></textarea>
        </p></td>
      </tr>
    </table>
  <div class="subinput"></div>
</div>
</form>
</body>
</html>
