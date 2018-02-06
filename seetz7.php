<?php
require 'session.php';

$sql_seach=$sql_seach." ORDER BY id DESC";
$sql_seach=" WHERE state=0".$sql_seach;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻软文自助发布平台</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
</head>

<body>
<div class="main">
  <div class="weizhibox">当前位置：通知管理 &gt;&gt; 查看重要通知</div>
<?php require 'user_top.php'?>
 <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td>
<p class="mc"><a href="tz_add.php">给管理员留言</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="seetz8.php">查看留言回复</a></p>
</td></tr></table>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="weblist">
  <tr>
    <th width="20%">通知时间</th>
    <th width="30%">标题</th>
    <th width="50%">内容</th>
    </tr>
<?php
$sql="SELECT * FROM tongzhi".$sql_seach;
_page($sql,7);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
  <tr>
    <td><?php echo $row['addtime']?></td>
    <td align="left"><?php echo $row['title']?></td>
    <td align="left"><?php echo $row['body']?></td>
    </tr>
 <?php }?>  
  <tr>
    <td colspan="3" style="height:40px; line-height:40px;"><?php echo _pageshow(2)?></td>
    </tr>
</table>

</div>
</body>
</html>
