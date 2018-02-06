<?php 
require 'session.php';

if ($_GET['act']=='xiugai') {
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['title']=$_POST['title']	;
	$data['body']=$_POST['body']	;
	$data['huifu']=$_POST['huifu']	;
	$data['pid']=$_SESSION['userid'];
	if ($data['body']=='') ShowMsg('错误：内容不能为空','-1');
	_update('tongzhi',$data,$id);
	ShowMsg('成功：修改成功',$PreviousUrl);

}

$row=_get_one('tongzhi',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>修改通知</title>
<script type="text/javascript" src="editor/kindeditor.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="editor/Alleditor.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>通知 &gt; 通知管理 &gt; 修改通知</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=xiugai">
    <dl>
      <dt><em>通知标题：</em>
        <input name="title" type="text" id="title" value="<?php echo $row['title']?>" size="70" />
        <input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
        <input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
      </dt>
      <dt><em>页面内容：</em>
         <textarea name="body" cols="60" rows="6" id="body"><?php echo $row['body']?></textarea>
      </dt>
    
      <dt><em>回复内容：</em>
         <textarea name="huifu" cols="60" rows="6" id="body"><?php echo $row['huifu']?></textarea>
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