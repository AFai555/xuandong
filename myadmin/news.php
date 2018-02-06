<?php 

require 'session.php';

if ($_GET['act']=='del' && isset($_GET['id'])) {
	_query("DELETE FROM news WHERE id={$_GET['id']} LIMIT 1");
	ShowMsg('成功：新闻删除成功',$_SERVER['HTTP_REFERER']);
	exit();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>新闻管理</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>新闻 &gt; 新闻管理</div>
<div class="adminbox">
<div id="menu">
<dl>
	<dt class="dropdown"><span><a href="news_add.php">添加新闻</a></span>
    </dt>
</dl>
</div>
  <form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="3%" height="32" align="center"><input type="checkbox" name="allbox" id="allbox" class="checkbox_input" style="border:0px;" /></td>
      <td width="4%" align="center">ID</td>
      <td align="center">新闻标题</td>
      <td width="6%" align="center">显示</td>
      <td width="8%" align="center">分类</td>
      <td width="5%" align="center">排序</td>
      <td width="15%" align="center">发布时间</td>
      <td width="12%" align="center">操作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$sql="SELECT * FROM news ORDER BY px_id ASC";
_page($sql,12);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
    <tr>
      <td width="3%" height="33" align="center"><input name="ID[]" type="checkbox"  class="listbox" value="<?php echo $row['id']?>" /></td>
      <td width="4%" align="center" class="pxid"><?php echo $row['id']?></td>
      <td align="left"><div class="newstitle"><?php echo $row['title']?></div></td>
      <td width="6%" align="center" class="pxid"><?php if($row['hide']==1) {?>显示<?php }else{?>隐藏<?php }?></td>
      <td width="8%" align="center" class="pxid"><?php if($row['lei']==1) {?>平台公告<?php }else if($row['lei']==2){?>客户案例<?php } else {?>行业新闻<?php }?></td>
      <td width="5%" align="center" class="pxid"><?php echo $row['px_id']?></td>
      <td width="15%" align="center"><?php echo $row['addtime']?></td>
      <td width="12%" align="center"><a href="news_edit.php?id=<?php echo $row['id']?>" class="icon_edit">编辑</a> <a href="?act=del&id=<?php echo $row['id']?>" class="icon_del" onclick="delcfm()">删除</a></td>
    </tr>
<?php }?> 
  </table>
</form>
<div class="lipage"><?php echo _pageshow(2)?></div>

</div>
</body>
</html>