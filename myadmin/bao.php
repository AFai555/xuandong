<?php 

require 'session.php';

if ($_GET['act']=='xiugai' && isset($_POST['id'])) {
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['baoimg']=$_POST['img'];
	_update('cart',$data,$id);
	ShowMsg('成功：成功了！',$PreviousUrl);
}
$row=_get_one('cart',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>包收录上传图片操作</title>
<script type="text/javascript" src="editor/kindeditor.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="editor/Alleditor.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong></div>
<div class="mainbox">
<form  name="add" method="post" action="?act=xiugai">
<input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
<input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
     
      <dt><em>收录截图：</em>
        <input name="img" type="text" id="img" size="60" class="up_pic_input" />
        <div class="up_pic_but" id="image">上传截图</div>
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