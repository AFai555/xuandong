<?php 
require 'session.php';

if ($_GET['act']=='add') {
	$data['pid']=$_POST['pid']	;
	$data['content']=$_POST['content']	;
	$data['addtime']=_nowtime();
	if ($data['content']=='') ShowMsg('错误：交稿内容不能为空','-1');
	_insert('daixie_get',$data);
	ShowMsg('成功：交稿成功！','daixie.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>交稿</title>
<script type="text/javascript" src="editor/kindeditor.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="editor/Alleditor.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>需求 &gt; 代写需求 &gt; 交稿</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=add">
  <input type="hidden" name="pid" value="<?php echo $_GET['id']?>" />
    <dl>
      <dt><em>稿件内容：</em>
        <textarea name="content" class="editor_content"></textarea>
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