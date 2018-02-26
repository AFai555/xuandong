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

function shouyi($zt,$id){
	if ($zt==3){
		if ($row=_get_one_tj('caiwu',"uid={$_SESSION['userid']} AND pid={$id}")){
			return $row['money'].'元';
		}else{
			return '0元';
		}
	}else{
		return '0元';
	}
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
$sql_seach=" WHERE referee={$_SESSION['userid']} AND zt>0".$sql_seach;
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
  <!-- <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 查看软文发布进度结果</div> -->
<?php require 'user_top.php'?>
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
    <th width="10%">会员</th>
    <th>文章标题</th>
    <th width="15%">发布网站频道</th>
    <th width="14%">发布状态</th>
    <th width="10%">收益</th>
    <th width="15%">发布时间</th>
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
    <td><?php echo getDbName('member','my_username',$row['uid'])?></td>
    <td><?php echo $row['title']?></td>
    <td><?php echo cart_case($row['pid'])?></td>
    <td><?php echo cart_zt($row['zt'])?></td>
    <td><p class="price"><?php echo shouyi($row['zt'],$row['id'])?></p></td>
    <td><?php echo $row['addtime']?></td>
    </tr>
 <?php }?>  
  <tr>
    <td colspan="7" style="height:40px; line-height:40px;"><?php echo _pageshow(2)?></td>
    </tr>
</table>

</div>
</body>
</html>
