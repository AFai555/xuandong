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
		return '<p class="price">-'.$money.'元</p>';
	}else{
		return '+'.$money.'元';
	}
}


$sql_seach="";
if ($_GET['lx']!='') {
	$sql_seach.=" AND lx={$_GET['lx']}";
}
if ($_GET['shijian01']!='' && $_GET['shijian02']!='') {
	$sql_seach.=" AND addtime BETWEEN '{$_GET['shijian01']}' and '{$_GET['shijian02']}'";
}

$sql_seach=$sql_seach." ORDER BY id DESC";
$sql_seach=" WHERE uid={$_SESSION['userid']}".$sql_seach;
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
<div class="meiti_search">
<form action="" method="get">
    交易时间
      <input name="shijian01" type="text" class="_calendar" id="shijian01" size="10" />
    到
    <input name="shijian02" type="text" class="_calendar" id="shijian02" size="10" />
    交易类型
    <select name="lx">
    <option value="">选择</option>
    	<option value="1">在线充值</option>
    	<option value="2">发稿支出</option>
    	<option value="3">拒稿返还</option>
    	<option value="4">客服代充值</option>
    	<option value="5">代理收益</option>
    	<option value="6">代理提现</option>
    </select>
    <input type="submit" value="搜索" class="sub" />
 </form>
  </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="weblist">
  <tr>
    <th width="20%">交易时间</th>
    <th width="20%">交易类型</th>
    <th width="20%">金额</th>
    <th>备注</th>
    </tr>
<?php
$sql="SELECT * FROM caiwu".$sql_seach;
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
  <tr>
    <td><?php echo $row['addtime']?></td>
    <td><?php echo caiwu_lx($row['lx'])?></td>
    <td><?php echo money_bh($row['money'],$row['lx'])?></td>
    <td><?php echo $row['beizhu']?></td>
    </tr>
 <?php }?>  
  <tr>
    <td colspan="4" style="height:40px; line-height:40px;"><?php echo _pageshow(2)?></td>
    </tr>
</table>

</div>
</body>
</html>
