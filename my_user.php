<?php
require 'session.php';

function daixie_get_num($pid){
	$sql = "SELECT id FROM daixie_get WHERE pid={$pid}";
	return mysql_num_rows(_query($sql));
}

$sql_seach="";
if ($_GET['username']!='') {
	$sql_seach.=" AND my_username like '%{$_GET['username']}%'";
}
if ($_GET['shijian01']!='' && $_GET['shijian02']!='') {
	$sql_seach.=" AND regtime BETWEEN '{$_GET['shijian01']}' and '{$_GET['shijian02']}'";
}

$sql_seach=$sql_seach." ORDER BY id DESC";
$sql_seach=" WHERE referee={$_SESSION['userid']}".$sql_seach;

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
  <!-- <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 选择发布媒体</div> -->
<?php require 'user_top.php'?>
<div class="meiti_search">
<form action="" method="get">
    会员帐号
      <input name="username" type="text" id="username" />
    注册时间
    <input name="shijian01" type="text" class="_calendar" id="shijian01" size="10" />
    到
    <input name="shijian02" type="text" class="_calendar" id="shijian02" size="10" />
    <input type="submit" value="搜索" class="sub" />
</form>
  </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="weblist">
  <tr>
    <th width="18%">会员名</th>
    <th>余额</th>
    <th width="15%">姓名</th>
    <th width="15%">QQ</th>
    <th width="15%">手机</th>
    <th width="20%">注册时间</th>
    </tr>
<?php
$sql="SELECT * FROM member".$sql_seach;
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
  <tr>
    <td><?php echo $row['my_username']?></td>
    <td><p class="price"><?php echo $row['money']?></p></td>
    <td><?php echo $row['nickname']?></td>
    <td>***</td>
    <td>***</td>
    <td><?php echo $row['regtime']?></td>
    </tr>
 <?php }?>  
  <tr>
    <td colspan="6" style="height:40px; line-height:40px;"><?php echo _pageshow(2)?></td>
    </tr>
</table>

</div>
</body>
</html>
