<?php 
require 'session.php';

function caiwu_lx($str){
	if ($str==1){
		return '在线充值';
	}elseif ($str==2){
		return '发稿支出';
	}elseif ($str==3){
		return '拒稿返还';
	}elseif ($str==4){
		return '客服代充值';
	}elseif ($str==5){
		return '代理收益';
	}elseif ($str==6){
		return '代理提现';
	}else{
		return '未定义';
	}
}

function money_bh($money,$lx){
	if ($lx==2 || $lx==6){
		return '-'.$money.'元';
	}else{
		return '<p style="color:#FF0000;">+'.$money.'元</p>';
	}
}

$sql_seach="";
if ($_GET['lx']!='') {
	$sql_seach.=" AND lx={$_GET['lx']}";
}
if ($_GET['uid']!='') {
	$sql_seach.=" AND uid={$_GET['uid']}";
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
<title>财务管理</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
<script type="text/javascript" src="../js/calendar.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>财务 &gt; 财务管理</div>
<div class="adminbox">
<form action="" method="get" name="form2" id="form2">
<div class="search_box">交易时间：
  <input name="shijian01" type="text" id="shijian01" size="6" class="_calendar" />
-
<input name="shijian02" type="text" id="shijian02" size="6" class="_calendar" />
交易类型：
  <label>
  <select name="lx" id="lx">
    <option value="">全部</option>
    	<option value="1">在线充值</option>
    	<option value="2">发稿支出</option>
    	<option value="3">拒稿返还</option>
    	<option value="4">客服代充值</option>
    	<option value="5">代理收益</option>
    	<option value="6">代理提现</option>
  </select>
  </label>
  用户名：
  <input name="username" type="text" class="seacrch_input" id="username" size="10" />
<input type="submit" class="seach_btn" value="查询" />
</div>
</form>  <form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="20%" height="32" align="center">交易时间</td>
      <td width="15%" align="center">交易类型</td>
      <td width="15%" align="center">金额</td>
      <td width="15%" align="center">用户名</td>
      <td align="center">备注</td>
      </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$sql="SELECT * FROM caiwu".$sql_seach;
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
    <tr>
      <td width="20%" height="33" align="center"><?php echo $row['addtime']?></td>
      <td width="15%" align="center"><?php echo caiwu_lx($row['lx'])?></td>
      <td width="15%" align="center"><?php echo money_bh($row['money'],$row['lx'])?></td>
      <td width="15%" align="center"><?php echo getDbName('member','my_username',$row['uid'])?></td>
      <td align="center"><?php echo $row['beizhu']?></td>
      </tr>
<?php }?> 
  </table>
</form>
<div class="lipage"><?php echo _pageshow(2)?></div>

</div>
</body>
</html>