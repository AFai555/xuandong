<?php 
require 'session.php';

$row=_get_one('daixie',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>查看需求</title>
<script src="js/function.js" type="text/javascript"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>需求 &gt; 代写需求  &gt; 查看需求</div>
<div class="adminbox">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE">
    <tr>
      <td width="15%" height="35"><P class="see_con">需求标题</P></td>
      <td><p class="see_con"><strong><?php echo $row['title']?></strong></p></td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">需求内容</p></td>
      <td><p class="see_con"><?php echo $row['content']?></p></td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">代写篇数</p></td>
      <td><p class="see_con"><?php echo $row['num']?>篇</p></td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">创建时间</p></td>
      <td><p class="see_con"><?php echo $row['addtime']?></p></td>
    </tr>
  </table>
</div>
</body>
</html>
