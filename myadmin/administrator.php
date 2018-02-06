<?php 

require 'session.php';

if ($_GET['act']=='del' && isset($_GET['id'])) {
	if ($_GET['id']<3){
		ShowMsg('错误：无法删除创始人！','-1');
	}
	_query("DELETE FROM admin WHERE id={$_GET['id']} LIMIT 1");
	ShowMsg('成功：管理员删除成功','administrator.php');
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>管理员管理</title>
<script src="js/function.js" type="text/javascript"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>设置 &gt; 管理员管理</div>
<div class="adminbox">
<div id="menu">
  <dl>
	<dt class="dropdown"><span><a href="administrator_add.php">添加管理员</a></span></dt>
	</dl>
</div>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="5%" height="32" align="center">ID</td>
      <td align="center">用户名</td>
      <td width="15%" align="center">身份</td>
      <td width="15%" align="center">登陆数次</td>
      <td width="15%" align="center">最后登陆IP</td>
      <td width="15%" align="center">最后登陆时间</td>
      <td width="12%" align="center">操 作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$i=0;
$_result=_query("SELECT * FROM admin WHERE id>1 ORDER BY id ASC");
while (!!$row=_mysql_list($_result)) {
$i++
?>
    <tr>
      <td width="5%" height="35" align="center" class="pxid"><?php echo $i?></td>
      <td align="center"><?php echo $row['adminname']?></td>
      <td width="15%" align="center"><?php echo $row['lv']==1 ? '<strong>管理员</strong>' : '编辑'?></td>
      <td width="15%" align="center"><?php echo $row['dlcs']?>次</td>
      <td width="15%" align="center"><?php echo $row['dlip']?></td>
      <td width="15%" align="center"><?php echo $row['dldata']?></td>
      <td width="12%" align="center"><a href="administrator_edit.php?id=<?php echo $row['id']?>" class="icon_edit">编辑</a> <a href="?act=del&id=<?php echo $row['id']?>" class="icon_del" onclick="delcfm()">删除</a></td>
    </tr>
<?php }?> 
  </table>
</div>
</body>
</html>
