<?php 
require 'session.php';
if ($_GET['act']=='del' && isset($_GET['getid'])){
	_delete('daixie_get',$_GET['getid']);
	ShowMsg('成功：已成功删除交稿！',$_SERVER['HTTP_REFERER']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>查看交稿</title>
<script src="js/function.js" type="text/javascript"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>需求 &gt; 代写需求  &gt; 查看交稿</div>
<div class="adminbox">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE">
<?php
$_result=_query("SELECT * FROM daixie_get WHERE pid={$_GET['id']} ORDER BY id ASC");
$i=0;
while (!!$row=_mysql_list($_result)) {
$i++;
?>
    <tr>
      <td width="8%" height="35"><p class="see_con">交稿<?php echo $i?></p></td>
      <td><p class="see_con"><strong><a href="?act=del&getid=<?php echo $row['id']?>">[删除]</a> 交稿时间：<?php echo $row['addtime']?></strong><br /><?php echo $row['content']?></p></td>
    </tr>
<?php }?>
  </table>
</div>
</body>
</html>
