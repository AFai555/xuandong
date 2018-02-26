<?php
require 'session.php';

function daixie_get_num($pid){
	$sql = "SELECT id FROM daixie_get WHERE pid={$pid}";
	return mysql_num_rows(_query($sql));
}

$sql_seach="";
if ($_GET['title']!='') {
	$sql_seach.=" AND title like '%{$_GET['title']}%'";
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
  <!-- <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 选择发布媒体</div> -->
    <?php require 'user_top_tp.php'?>
<?php require 'user_top.php'?>
    <div class="add_buzhuo"> <a href="daixie_add.php">第一步：添加并发布写作需求</a> <a href="daixie_admin.php" class="online">第二步：查看写作需求列表</a> </div>
  <div class="meiti_search">
<form action="" method="get">
    需求标题
      <input name="title" type="text" id="title" />
    创建时间
    <input name="shijian01" type="text" class="_calendar" id="shijian01" size="10" />
    到
    <input name="shijian02" type="text" class="_calendar" id="shijian02" size="10" />
    <input type="submit" value="搜索" class="sub" />
</form>
  </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="weblist">
  <tr>
    <th width="10%">需求编号</th>
    <th>需求标题</th>
    <th width="15%">代写篇数</th>
    <th width="10%">代写费用</th>
    <th width="12%">已交稿篇数</th>
    <th width="14%">创建时间</th>
    <th width="10%">操作</th>
    </tr>
<?php
$sql="SELECT * FROM daixie".$sql_seach;
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
  <tr>
    <td><?php echo $row['bianhao']?></td>
    <td><?php echo $row['title']?></td>
    <td><?php echo $row['num']?>篇</td>
    <td><p class="price"><?php echo $row['price']?>元</p></td>
    <td><strong style="color:#FF0000"><?php if ($row['zt']==0) :?><?php echo daixie_get_num($row['id'])?>篇<?php else :?>拒写<?php endif ;?></strong></td>
    <td><?php echo $row['addtime']?></td>
    <td><?php if ($row['zt']==0) :?><a href="daixie_get_see.php?id=<?php echo $row['id']?>">查看</a><?php endif ;?></td>
    </tr>
 <?php }?>  
  <tr>
    <td colspan="7" style="height:40px; line-height:40px;"><?php echo _pageshow(2)?></td>
    </tr>
</table>

</div>
</body>
</html>
