<?php 
require 'session.php';

if ($_GET['act']=='add') {
	$data['title']=$_POST['title']	;
	$data['body']=$_POST['body']	;
	$data['state']=0;
	$data['pid']=$_SESSION['userid'];
	$data['addtime']=_nowtime();
	if ($data['body']=='') ShowMsg('错误：内容不能为空','-1');
	_insert('tongzhi',$data);
	ShowMsg('成功：添加成功','tongzhi.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>添加通知</title>
<script type="text/javascript" src="editor/kindeditor.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="editor/Alleditor.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>通知 &gt; 通知管理 &gt; 添加通知</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=add">
    <dl>
      <dt><em>通知标题：</em>
        <input name="title" type="text" id="title" value="" size="70" />
      </dt>
      <dt><em>页面内容：</em>
         <textarea name="body" cols="60" rows="6" id="body"></textarea>
      </dt>
      
      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>