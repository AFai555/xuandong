<?php 

require 'session.php';

if ($_GET['act']=='del' && isset($_GET['id'])) {
	_query("DELETE FROM luntan WHERE id={$_GET['id']} LIMIT 1");
	ShowMsg('成功：论坛删除成功','luntan.php');
	exit();
}

if ($_GET['act']=='checkbox' & $_GET['lx']==3) {
	if (isset($_POST['ID'])) {
		$ids=implode(',',$_POST['ID']);
		_query("DELETE FROM luntan WHERE id in ({$ids})");
		ShowMsg('成功：批量删除成功','luntan.php');
		exit();
	}else{
		ShowMsg('错误：没有选择任何记录','-1');
		exit();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>友情链接管理</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>论坛 &gt; 论坛管理</div>
<div class="adminbox">
<div id="menu">
<dl>
	<dt class="dropdown"><span><a href="luntan_add.php">添加论坛</a></span>
    </dt>
</dl>
</div>
<form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="8%" height="32" align="center">ID</td>
      <td align="center">名 称</td>
      <td width="18%" align="center">子管理员</td>
      <td width="8%" align="center">排序</td>
      <td width="18%" align="center">添加时间</td>
      <td width="15%" align="center">操 作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$sql="SELECT * FROM luntan ORDER BY px_id ASC";
_page($sql,12);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
    <tr>
      <td width="8%" height="35" align="center" class="pxid"><?php echo $row['id']?></td>
      <td align="center"><?php echo $row['title']?></td>
      <td width="18%" align="center"><?php echo getDbname('admin','adminname',$row['admin_id'],'未指定')?></td>
      <td width="8%" align="center" class="pxid"><?php echo $row['px_id']?></td>
      <td width="18%" align="center"><?php echo $row['addtime']?></td>
      <td width="15%" align="center"><a href="luntan_edit.php?id=<?php echo $row['id']?>" class="icon_edit">编辑</a> <a href="?act=del&id=<?php echo $row['id']?>" class="icon_del" onclick="delcfm()">删除</a></td>
    </tr>
<?php }?> 
  </table>
</form>
<div class="lipage"><?php echo _pageshow(2)?></div>
</div>
</body>
</html>