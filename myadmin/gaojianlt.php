<?php 

require 'session.php';

if ($_GET['act']=='del' && isset($_GET['id'])) {
	_query("DELETE FROM ltcart WHERE id={$_GET['id']} LIMIT 1");
	ShowMsg('成功：稿件成功删除','luntan.php');
	exit();
}

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
	$row=_get_one('luntan_case',$pid);
	return '<a href="'.$row['link'].'" target="_blank">'.$row['title'].'</a> <a href="'.$row['case_url'].'" target="_blank">['.$row['isbao'].']</a>';
}
function cart_bao($pid){
	$row=_get_one('luntan_case',$pid);
	return ' '.$row['isbao'].' ';
}

function cart_member($uid){
	$row=_get_one('member',$uid);
	return '<a href="gaojianlt.php?uid='.$row['id'].'">'.$row['my_username'].'</a>';
}  
$sql_search="";
$listnum=$_GET['listnum'];
if (!is_numeric($listnum)){
	$listnum=20;
}
if ($_GET['zt']!=''){
	$sql_search.=" AND zt={$_GET['zt']}";
}
if ($_GET['title']!=''){
	$sql_search.=" AND title like '%{$_GET['title']}%'";
}
if ($_GET['shijian01']!='' && $_GET['shijian02']!=''){
	$shijian01=$_GET['shijian01'].' 00:00:00';
	$shijian02=$_GET['shijian02'].' 23:59:59';
	$sql_search.=" AND addtime BETWEEN '{$shijian01}' AND '{$shijian02}'";
}
if ($_GET['mid']!=''){
	$sql_search.=" AND pid in (SELECT id FROM luntan_case WHERE mid={$_GET['mid']})";
}
if ($_GET['uid']!=''){
	$sql_search.=" AND uid={$_GET['uid']}";
}
if ($_GET['m_title']!=''){
	$sql_search.=" AND pid in (SELECT id FROM luntan_case WHERE title like '%{$_GET['m_title']}%')";
}
if ($_GET['cb_price']!=''){
	$sql_search.=" AND pid in (SELECT id FROM luntan_case WHERE cb_price='{$_GET['cb_price']}')";
}
if ($_GET['qq']!=''){
	$sql_search.=" AND pid in (SELECT id FROM luntan_case WHERE qq='{$_GET['qq']}')";
}
if ($_GET['tel']!=''){
	$sql_search.=" AND pid in (SELECT id FROM luntan_case WHERE tel='{$_GET['tel']}')";
}
if ($_GET['admin_id']!=''){
	$sql_search.=" AND pid in (SELECT id FROM luntan_case WHERE mid in (SELECT id FROM luntan WHERE admin_id={$_GET['admin_id']}))";
}
if ($_SESSION['lv']==2){
	$sql_search.=" AND pid in (SELECT id FROM luntan_case WHERE mid in (SELECT id FROM luntan WHERE admin_id={$_SESSION['admin']}))";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>稿件管理</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
<script type="text/javascript" src="../js/calendar.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>稿件 &gt; 稿件管理</div>
<div class="adminbox">
<form action="" method="get" name="form2" id="form2">
<div class="search_box">标题：
  <input name="title" type="text" id="title" size="10" />
频道：
  <input name="m_title" type="text" id="m_title" size="10" />
成本：
  <input name="cb_price" type="text" id="cb_price" size="3" style="width:30px;" />
<select name="zt" id="zt">
  <option value="">状态</option>
  <option value="1">待收稿</option>
  <option value="2">已收稿</option>
  <option value="3">已发布</option>
  <option value="4">已拒稿</option>
</select>
<?php if ($_SESSION['lv']==1) :?>
<select name="admin_id" id="admin_id">
  <option value="">子管理员</option>
<?php
$_result=_query("SELECT * FROM admin WHERE lv=2 ORDER BY id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
          <option value="<?php echo $rs_sort['id']?>"><?php echo $rs_sort['adminname']?></option>
<?php }?>
</select>
<?php endif ;?>
时间：
  <input name="shijian01" type="text" id="shijian01" size="6" class="_calendar" />
-
<input name="shijian02" type="text" id="shijian02" size="6" class="_calendar" />
QQ：
  <input name="qq" type="text" id="qq" size="6" />
电话：
<input name="tel" type="text" id="tel" size="6" />
条数
<input name="listnum" type="text" id="listnum" value="20" style="width:20px;" />
  <input type="submit" class="seach_btn" value="查询" />
</div>
</form>
  <form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="10%" height="32" align="center">订单编号</td>
      <td align="center">文章标题</td>   
       <td width="8%" align="center">会员</td>
      <td width="15%" align="center">发布网站频道</td>
      <td width="5%" align="center">成本</td>
      <td width="5%" align="center">费用</td>
      <td width="10%" align="center">发布状态</td>
      <td width="12%" align="center">添加时间</td>
      <td width="8%" align="center">操 作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$z_price=0;
$z_cb_price=0;
$sql="SELECT * FROM ltcart WHERE zt>0".$sql_search." ORDER BY id DESC";
_page($sql,$listnum);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
if ($row['zt']<4){
$z_price+=$row['price'];
$z_cb_price+=getDbName('luntan_case','cb_price',$row['pid']);
}
?>

    <tr>
      <td width="10%" height="35" align="center" class="pxid"><?php echo $row['bianhao']?></td>
      <td align="center"><?php echo $row['title']?></td>
       <td width="8%" align="center"><strong style="color:#FF0000;"><?php echo cart_member($row['uid'])?></strong></td>
      <td width="15%" align="center"><?php echo cart_case($row['pid'])?></td>
      <td width="5%" align="center"><strong style="color:#FF0000;"><?php echo getDbName('luntan_case','cb_price',$row['pid'])?>元</strong></td>
      <td width="5%" align="center"><strong><?php echo $row['price']?>元</strong></td>
      <td width="10%" align="center">
      <table ><tr><td width="50%" align="left">
	  <?php echo cart_zt($row['zt'])?> </td><td align="right">
      <strong style="color:#990066;"> <?php  if (cart_bao($row['pid']) ==1) echo '<a href="bao.php?id='.$row['id'].'">包</a>';?> </strong>
      </td></tr></table>
      </td>
      <td width="12%" align="center"><?php echo $row['addtime']?></td>
      <td width="8%" align="center">      
      <a href="gaojianlt_see.php?id=<?php echo $row['id']?>">[查看]</a>
    <?php  if ($row['zt'] ==4) echo '<a href="hf_add.php?id='.$row['id'].'">[回复]</a>';?> 
      </td>
    </tr>
<?php }?> 
  </table>
</form>
<div class="lipage"><?php echo _pageshow(2)?></div>
<div class="huizong"><span class="s1">成本：<?php echo $z_cb_price?>元</span>&nbsp; | &nbsp;<span class="s2">会员费用：<?php echo $z_price?>元</span>&nbsp; | &nbsp;<span class="s3">收益：<?php echo $z_price-$z_cb_price?>元</span></div>
</div>
</body>
</html>