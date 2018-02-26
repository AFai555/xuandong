<?php
require 'session.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻软文自助发布平台</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./myadmin/editor/kindeditor.js"></script>
<script type="text/javascript" src="./myadmin/editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./myadmin/editor/Alleditor.js"></script>
</head>

<body>

<input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
<input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
<div class="main">
  <!-- <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 软文稿件修改</div> -->
<?php require 'user_top.php'?>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
<?php
$_result=_query("SELECT * FROM daixie_get WHERE pid={$_GET['id']} ORDER BY id ASC");
$i=0;
while (!!$row=_mysql_list($_result)) {
$i++;
?>
    <tr>
      <td width="120" height="40"><p class="mc">交稿<?php echo $i?></p></td>
      <td><p class="mc"><?php echo $row['content']?></p></td>
    </tr>
<?php }?>
<?php if ($i==0) :?>
    <tr>
      <td height="40" colspan="2"><p class="mc">暂时还未有交稿</p></td>
    </tr>
<?php endif ;?>
  </table>
  <!--main end-->
</div>
</body>
</html>
