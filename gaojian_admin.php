<?php
require 'session.php';

function cart_zt($str){
	if ($str==1){
		return '<p style="color:#0000FF;">待收稿</p>';
	}elseif ($str==2){
		return '<p style="color:#FF0000;">已收稿</p>';
	}elseif ($str==3){
		return '已发布';
	}elseif ($str==4){
		return '<strong>已拒稿</strong>';
	}else{
		return '未发布';
	}
}
function cart_case($pid){
	$row=_get_one('meiti_case',$pid);
	return '<a href="'.$row['link'].'" target="_blank">'.$row['title'].'</a> <a href="'.$row['case_url'].'" target="_blank">[案例]</a>';
}

$sql_seach="";
if ($_GET['zt']!='') {
	$sql_seach.=" AND zt={$_GET['zt']}";
}
if ($_GET['title']!='') {
	$sql_seach.=" AND title like '%{$_GET['title']}%'";
}
if ($_GET['m_title']!='') {
	$sql_seach.=" AND pid in (SELECT id FROM meiti_case WHERE title like '%{$_GET['m_title']}%')";
}
if ($_GET['shijian01']!='' && $_GET['shijian02']!='') {
	$sql_seach.=" AND addtime BETWEEN '{$_GET['shijian01']}' and '{$_GET['shijian02']}'";
}

$sql_seach=$sql_seach." ORDER BY id DESC";
$sql_seach=" WHERE uid={$_SESSION['userid']} AND zt>0".$sql_seach;
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
    <?php require 'user_top_tp.php'?>
  <?php require 'user_top_gg.php'?>
<?php require 'user_top.php'?>
    <!-- <div class="add_buzhuo">
    	<a href="gaojian_list.php">第一步：选择需要发布的网站媒体</a>
    	<a href="gaojian_add.php">第二步：添加并提交软文稿件内容</a>
    	<a href="gaojian_admin.php" class="online">第三步：查看软文发布进度结果</a>
    </div> -->
    <div class="meiti_search">
<form action="" method="get">
    文章标题
    <input name="title" type="text" id="title" />
    发布时间
    <input name="shijian01" type="text" class="_calendar" id="shijian01" size="10" />
    到
    <input name="shijian02" type="text" class="_calendar" id="shijian02" size="10" />
    发布媒体
    <input name="m_title" type="text" id="m_title" />
    发布状态
    <select name="zt" id="zt">
    <option value="">选择</option>
    	<option value="1">待收稿</option>
    	<option value="2">已收稿</option>
    	<option value="3">已发布</option>
    	<option value="4">已拒稿</option>
    </select>
    <input type="submit" value="搜索" class="sub" />
 </form>
  </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="weblist">
  <tr>
    <th width="10%">订单编号</th>
    <th>文章标题</th>
    <th width="15%">发布网站频道</th>
    <th width="10%">费用（元）</th>
    <th width="10%">发布状态</th>
    <th width="14%">发布时间</th>
    <th width="15%">操作</th>
    </tr>
<?php
$sql="SELECT * FROM cart".$sql_seach;
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
  <tr>
    <td><?php echo $row['bianhao']?></td>
    <td><?php echo $row['title']?></td>
    <td><?php echo cart_case($row['pid'])?></td>
    <td><p class="price"><?php echo $row['price']?>元</p></td>
    <td><?php echo cart_zt($row['zt'])?></td>
    <td><?php echo $row['addtime']?></td>
    <td>
	<?php 
        //if ($row['zt']==3) echo '<a href="'.$row['get_url'].'" target="_blank">网址</a>  <a href="sees.php?id='.$row['id'].'" target="_blank">预览</a>  ';
        if ($row['zt']==3) echo '<a href="sees.php?id='.$row['id'].'" target="_blank">已发布，查看</a> ';
    ?>
    
	<?php if ($row['zt']==2) echo '<a href="sees.php?id='.$row['id'].'" target="_blank">预览</a> ';?>
    
	<?php if ($row['zt']==4) echo '<a href="hl_see.php?id='.$row['id'].'">拒搞原因</a>  <a href="sees.php?id='.$row['id'].'" target="_blank">预览</a>  ';?>
	
	<?php if ($row['zt']==1) echo '<a href="gaojian_edit.php?id='.$row['id'].'">修改</a>  <a href="sees.php?id='.$row['id'].'" target="_blank">预览</a>  ';?>
    </td>
    </tr>
 <?php }?>  
  <tr>
    <td colspan="7" style="height:40px; line-height:40px;"><?php echo _pageshow(2)?></td>
    </tr>
</table>

</div>
</body>
</html>
