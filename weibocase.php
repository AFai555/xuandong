<?php 
require 'session.php';

if ($_GET['act']=='del' && isset($_GET['id'])) {
	_query("DELETE FROM weibo_case WHERE id={$_GET['id']} LIMIT 1");
	ShowMsg('成功：媒体案例删除成功',$_SERVER['HTTP_REFERER']);
}

if ($_GET['act']=='checkbox' & isset($_GET['lx'])) {
	if (isset($_POST['ID'])) {
		$ids=implode(',',$_POST['ID']);
		if ($_GET['lx']==3) {
			_query("DELETE FROM weibo_case WHERE id in ({$ids})");
		}
		ShowMsg('成功：批量操作成功',$_SERVER['HTTP_REFERER']);
	}else{
		ShowMsg('错误：没有选择任何记录','-1');
	}
}

$sql_seach="";
if ($_GET['mid']!='') {
	$sql_seach.=" AND mid={$_GET['mid']}";
}
if ($_GET['hide']!='') {
	$sql_seach.=" AND hide={$_GET['hide']}";
}
if ($_GET['title']!='') {
	$sql_seach.=" AND title like '%{$_GET['title']}%'";
}
if ($_GET['cb_price']!='') {
	$sql_seach.=" AND cb_price={$_GET['cb_price']}";
}
if ($_GET['price']!='') {
	$sql_seach.=" AND price={$_GET['price']}";
}
if ($_GET['qq']!='') {
	$sql_seach.=" AND qq='{$_GET['qq']}'";
}
if ($_GET['tel']!='') {
	$sql_seach.=" AND tel='{$_GET['tel']}'";
}
$sql_seach=" WHERE 1=1".$sql_seach." ORDER BY id DESC";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>媒体案例管理</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>媒体 &gt; 媒体案例管理</div>
<div class="adminbox">
<form action="" method="get" name="form2" id="form2">
<div class="search_box">媒体频道：
  <input name="title" type="text" class="seacrch_input" id="title" size="15" />
分类：
  <label>
  <select name="mid" id="mid">
    <option value="">全部</option>
<?php
$_result=_query("SELECT * FROM weibo ORDER BY px_id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
    <option value="<?php echo $rs_sort['id']?>"><?php echo $rs_sort['title']?></option>
<?php 
}
?>
  </select>
  </label>
  显示状态：
    <label>
  <select name="hide" id="hide">
    <option value="">全部</option>
  <option value="0">显示</option>
  <option value="1">隐藏</option>
  </select>
  </label>
  成本价：
  <input name="cb_price" type="text" class="seacrch_input" id="cb_price" size="5" />
会员价：
<input name="price" type="text" class="seacrch_input" id="price" size="5" />
 QQ：
 <input name="qq" type="text" class="seacrch_input" id="qq" size="8" />
电话：
<input name="tel" type="text" class="seacrch_input" id="tel" size="8" />
  <input type="submit" class="seach_btn" value="查询" />
</div>
</form>
<form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable" >
    <tr>
      <td width="3%" height="32" align="center"><input type="checkbox" name="allbox" id="allbox" class="checkbox_input" style="border:0px;" /></td>
      <td width="4%" align="center">ID</td>
      <td align="center">媒体频道</td>
      <td width="12%" align="center">分类</td>
      <td width="10%" align="center">成本价</td>
      <td width="10%" align="center">会员价</td>
      <td width="12%" align="center">编辑QQ</td>
      <td width="22%" align="center">编辑电话</td>
      <td width="10%" align="center">操作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable" >
<?php
$sql="SELECT * FROM weibo_case".$sql_seach;
_page($sql,12);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
    <tr>
      <td width="3%" height="33" align="center"><input name="ID[]" type="checkbox"  class="listbox" value="<?php echo $row['id']?>" /></td>
      <td width="4%" align="center" class="pxid"><?php echo $row['id']?></td>
      <td align="left"><div class="newstitle"><a href="<?php echo $row['link']?>" target="_blank"><?php echo $row['title']?></a> <a href="<?php echo $row['case_url']?>" target="_blank">[案例]</a></div></td>
      <td width="12%" align="center"><?php echo getweibo($row['mid'])?></td>
      <td width="10%" align="center"><?php echo $row['cb_price']?>元</td>
      <td width="10%" align="center"><?php echo $row['price']?>元</td>
      <td width="12%" align="center"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $row['qq']?>&site=qq&menu=yes"><img src="images/pa.gif" /></a></td>   
      <td width="22%" align="center"><?php echo $row['tel']?></td>
      <td width="10%" align="center"><a href="weibocase_edit.php?id=<?php echo $row['id']?>" class="icon_edit">编辑</a> <a href="?act=del&id=<?php echo $row['id']?>" class="icon_del" onclick="delcfm()">删除</a></td>
    </tr>
<?php }?> 
  </table>
</form>
<div class="lipage"><?php echo _pageshow(2)?></div>

</div>
</body>
</html>