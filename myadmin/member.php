<?php 

require 'session.php';

if ($_GET['act']=='del' && isset($_GET['id'])) {
	_query("DELETE FROM member WHERE id={$_GET['id']} LIMIT 1");
  // 删除财务记录
  _delete_tj("caiwu","uid={$_GET['id']}");
  // 删除代写稿件
  _delete_tj("daixie","uid={$_GET['id']}");
  // 删除发布记录
  _delete_tj("cart","uid={$_GET['id']}");
	ShowMsg('成功：会员删除成功',$_SERVER['HTTP_REFERER']);
	exit();
}

function daixie_num($uid){
	$sql = "SELECT id FROM daixie WHERE uid={$uid}";
	return mysql_num_rows(_query($sql));
}

function gaojian_num($uid){
	$sql = "SELECT id FROM cart WHERE zt>0 AND uid={$uid}";
	return mysql_num_rows(_query($sql));
}

function weibo_num($uid){
	$sql = "SELECT id FROM wbcart WHERE zt>0 AND uid={$uid}";
	return mysql_num_rows(_query($sql));
}
function luntan_num($uid){
	$sql = "SELECT id FROM ltcart WHERE zt>0 AND uid={$uid}";
	return mysql_num_rows(_query($sql));
}

function weixin_num($uid){
	$sql = "SELECT id FROM wxcart WHERE zt>0 AND uid={$uid}";
	return mysql_num_rows(_query($sql));
}

$sql_seach="";
if ($_GET['username']!='') {
	$sql_seach.=" AND my_username='{$_GET['username']}'";
}
if ($_GET['nickname']!='') {
	$sql_seach.=" AND nickname='{$_GET['nickname']}'";
}
if ($_GET['qq']!='') {
	$sql_seach.=" AND qq='{$_GET['qq']}'";
}
if ($_GET['tel']!='') {
	$sql_seach.=" AND tel='{$_GET['tel']}'";
}
if ($_GET['mail']!='') {
	$sql_seach.=" AND mail='{$_GET['mail']}'";
}
if ($_GET['shijian01']!='' && $_GET['shijian02']!='') {
	$shijian01=$_GET['shijian01'].' 00:00:00';
	$shijian02=$_GET['shijian02'].' 23:59:59';
	$sql_seach.=" AND regtime BETWEEN '{$shijian01}' and '{$shijian02}'";
}

$sql_seach=$sql_seach." ORDER BY id DESC";
$sql_seach=" WHERE 1=1".$sql_seach;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>会员管理</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
<script type="text/javascript" src="../js/calendar.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>会员 &gt; 会员管理</div>
<div class="adminbox">
<form action="" method="get" name="form2" id="form2">
<div class="search_box">注册时间：
  <input name="shijian01" type="text" id="shijian01" size="6" class="_calendar" />
-
<input name="shijian02" type="text" id="shijian02" size="6" class="_calendar" />
<label></label>
帐号：
<input name="username" type="text" class="seacrch_input" id="username" size="10" />
 姓名：
 <input name="nickname" type="text" class="seacrch_input" id="nickname" size="10" />
手机：
<input name="tel" type="text" class="seacrch_input" id="tel" size="10" />
 QQ：
 <input name="qq" type="text" class="seacrch_input" id="qq" size="10" />
 邮箱：
 <input name="mail" type="text" class="seacrch_input" id="mail" size="10" />
<input type="submit" class="seach_btn" value="查询" />
</div>
</form>
  <form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="4%" height="32" align="center">ID</td>
      <td width="12%" align="center">帐号</td>
      <td width="12%" align="center">姓名</td>
      <td width="12%" align="center">手机</td>
      <td width="6%" align="center">会员等级</td>
      <td width="6%" align="center">新闻数</td>
      <!-- <td width="6%" align="center">微博数</td>
      <td width="6%" align="center">论坛数</td>
      <td width="6%" align="center">微信数</td> -->
      <td width="6%" align="center">代写数</td>
      <td width="8%" align="center">余额</td>
      <td width="12%" align="center">注册时间</td>
      <td align="center">操 作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$sql="SELECT * FROM member".$sql_seach;
_page($sql,12);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
    <tr>
      <td width="4%" height="35" align="center" class="pxid"><?php echo $row['id']?></td>
      <td width="12%" align="center"><?php echo $row['my_username']?></td>
      <td width="12%" align="center"><?php echo $row['nickname']?></td>
      <td width="12%" align="center"><?php echo $row['tel']?></td>
      <td width="6%" align="center"><?php echo $row['grade']?></td>
      <td width="6%" align="center"><a href="gaojian.php?uid=<?php echo $row['id']?>" style="text-decoration:underline; color:#0066FF;"><?php echo gaojian_num($row['id'])?></a></td>
      <!-- <td width="6%" align="center"><a href="gaojianwb.php?uid=<php echo $row['id']?>" style="text-decoration:underline; color:#0066FF;"><php echo weibo_num($row['id'])?></a></td>
      <td width="6%" align="center"><a href="gaojianlt.php?uid=<php echo $row['id']?>" style="text-decoration:underline; color:#0066FF;"><php echo luntan_num($row['id'])?></a></td>
      <td width="6%" align="center"><a href="gaojianwx.php?uid=<php echo $row['id']?>" style="text-decoration:underline; color:#0066FF;"><php echo weixin_num($row['id'])?></a></td> -->
      <td width="6%" align="center"><a href="daixie.php?uid=<?php echo $row['id']?>" style="text-decoration:underline; color:#0066FF;"><?php echo daixie_num($row['id'])?></a></td>
      <td width="8%" align="center"><strong style="color:#FF0000;"><?php echo $row['money']?>元</strong></td>
      <td width="12%" align="center"><?php echo $row['regtime']?></td>
      <td align="center"><a href="member_alipay.php?id=<?php echo $row['id']?>">[充值]</a> <a href="caiwu.php?uid=<?php echo $row['id']?>">[财务]</a> <a href="member_edit.php?id=<?php echo $row['id']?>">[修改]</a> <a href="?act=del&id=<?php echo $row['id']?>" onclick="delcfm()">[删除]</a></td>
    </tr>
<?php }?> 
  </table>
</form>
<div class="lipage"><?php echo _pageshow(2)?></div>
</div>
</body>
</html>