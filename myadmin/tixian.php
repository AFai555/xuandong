<?php 
require 'session.php';


$sql_seach="";
if ($_GET['uid']!='') {
	$sql_seach.=" AND uid={$_GET['uid']}";
}
if ($_GET['zhanghao']!='') {
	$sql_seach.=" AND zhanghao='{$_GET['zhanghao']}'";
}
if ($_GET['huming']!='') {
	$sql_seach.=" AND huming='{$_GET['huming']}'";
}
if ($_GET['username']!='') {
	$sql_seach.=" AND uid in (SELECT id FROM member WHERE my_username='{$_GET['username']}')";
}
if ($_GET['shijian01']!='' && $_GET['shijian02']!='') {
	$shijian01=$_GET['shijian01'].' 00:00:00';
	$shijian02=$_GET['shijian02'].' 23:59:59';
	$sql_seach.=" AND addtime BETWEEN '{$shijian01}' and '{$shijian02}'";
}

$sql_seach=$sql_seach." ORDER BY id DESC";
$sql_seach=" WHERE 1=1".$sql_seach;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>提现申请</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
<script type="text/javascript" src="../js/calendar.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>财务 &gt; 提现申请</div>
<div class="adminbox">
<form action="" method="get" name="form2" id="form2">
<div class="search_box">提现时间：
  <input name="shijian01" type="text" id="shijian01" size="6" class="_calendar" />
-
<input name="shijian02" type="text" id="shijian02" size="6" class="_calendar" />
<label></label>
用户名：
<input name="username" type="text" class="seacrch_input" id="username" size="10" />
 收款帐号：
 <input name="zhanghao" type="text" class="seacrch_input" id="zhanghao" size="10" />
 收款人：
 <input name="huming" type="text" class="seacrch_input" id="huming" size="10" />
<input type="submit" class="seach_btn" value="查询" />
</div>
</form>
  <form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="20%" height="32" align="center">提现时间</td>
      <td align="center">收款帐号</td>
      <td width="10%" align="center">金额</td>
      <td width="15%" align="center">用户名</td>
      <td width="10%" align="center">状态</td>
      <td width="10%" align="center">操作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$sql="SELECT * FROM tixian".$sql_seach;
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
    <tr>
      <td width="20%" height="33" align="center"><?php echo $row['addtime']?></td>
      <td align="center"><?php echo $row['leixing']?>|<?php echo $row['zhanghao']?>|<?php echo $row['huming']?></td>
      <td width="10%" align="center"><p style="color:#FF0000"><?php echo $row['money']?>元</p></td>
      <td width="15%" align="center"><?php echo getDbName('member','my_username',$row['uid'])?></td>
      <td width="10%" align="center"><?php echo $row['zt']?'已打款':'<p style="color:#FF0000">申请中</p>'?></td>
      <td width="10%" align="center"><?php if ($row['zt']==0) :?><a href="tixian_cz.php?id=<?php echo $row['id']?>">[打款]</a><?php endif ;?></td>
    </tr>
<?php }?> 
  </table>
</form>
<div class="lipage"><?php echo _pageshow(2)?></div>

</div>
</body>
</html>