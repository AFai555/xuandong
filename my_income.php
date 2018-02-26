<?php
require 'session.php';
function shouyi_money($uid){
	$sql="SELECT SUM(money) AS sum FROM caiwu WHERE uid={$uid} AND lx=5";
	$money=_mysql_show($sql);
	$sql2="SELECT SUM(money) AS sum FROM caiwu WHERE uid={$uid} AND lx=6";
	$money2=_mysql_show($sql2);
	return $money['sum']-$money2['sum'];
}
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
  <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 查看软文发布进度结果</div>
<?php require 'user_top.php'?>
<div class="meiti_search shouyi">收益余额:<strong><?php echo shouyi_money($_SESSION['userid'])?></strong>元  <a href="my_tixian.php">提现</a> （提现时间为每月1-5号）</div>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="weblist">
  <tr>
    <th width="20%">提现时间</th>
    <th>收款帐号</th>
    <th width="15%">金额</th>
    <th width="15%">状态</th>
    <th width="15%">付款截图</th>
  </tr>
<?php
$sql="SELECT * FROM tixian WHERE uid={$_SESSION['userid']} ORDER BY id DESC";
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
  <tr>
    <td><?php echo $row['addtime']?></td>
    <td><?php echo $row['leixing']?>|<?php echo $row['zhanghao']?>|<?php echo $row['huming']?></td>
    <td><p class="price"><?php echo $row['money']?>元</p></td>
    <td><?php echo $row['zt']?'已打款':'<p style="color:#FF0000">申请中</p>'?></td>
    <td><?php if ($row['zt']) echo '<a href="'.$row['jietu'].'" target="_blank">[查看]</a>'?></td>
  </tr>
 <?php }?>  
  <tr>
    <td colspan="5" style="height:40px; line-height:40px;"><?php echo _pageshow(2)?></td>
    </tr>
</table>

</div>
</body>
</html>
