<?php 

require 'session.php';

if ($_GET['act']=='del' && isset($_GET['id'])) {
	_query("DELETE FROM tongzhi WHERE id={$_GET['id']} LIMIT 1");
	ShowMsg('成功：删除成功',$_SERVER['HTTP_REFERER']);
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>通知管理</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>通知 &gt; 通知管理</div>
<div class="adminbox">
<div id="menu">
<dl>
	<dt class="dropdown"><span><a href="tongzhi_add.php">添加通知</a></span>
    </dt>
</dl>
</div>
  <form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="3%" height="32" align="center"><input type="checkbox" name="allbox" id="allbox" class="checkbox_input" style="border:0px;" /></td>
      <td width="4%" align="center">ID</td>
      <td align="center">通知标题</td>     
      <td width="25%" align="center">内容</td>
      <td width="20%" align="center">回复</td>
      <td width="15%" align="center">发布时间</td>
      <td width="12%" align="center">操作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$sql="SELECT * FROM tongzhi ORDER BY addtime desc";
_page($sql,12);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
    <tr>
      <td width="3%" height="33" align="center"><input name="ID[]" type="checkbox"  class="listbox" value="<?php echo $row['id']?>" /></td>
      <td width="4%" align="center" class="pxid"><?php echo $row['id']?></td>
      <td align="left"><?php echo $row['title']?></td>
      <td width="25%"><div class="newstitle"><?php echo $row['body']?></div></td>
      <td width="20%"><div class="newstitle"><?php echo $row['huifu']?></div></td>
      <td width="15%" align="center"><?php echo $row['addtime']?></td>
      <td width="12%" align="center"><a href="tongzhi_edit.php?id=<?php echo $row['id']?>" class="icon_edit">编辑</a> <a href="?act=del&id=<?php echo $row['id']?>" class="icon_del" onclick="delcfm()">删除</a></td>
    </tr>
<?php }?> 
  </table>
</form>
<div class="lipage"><?php echo _pageshow(2)?></div>

</div>
</body>
</html>