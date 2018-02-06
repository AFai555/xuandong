<?php 

require 'session.php';

if ($_GET['act']=='xiugai' ) {
	
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['imgurl']=$_POST['img'];
	_update('logo_up',$data,'1');

	
	ShowMsg('成功：上传成功了！',$PreviousUrl);
}
$row1=_get_one('logo_up',1);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>上传图片操作</title>
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
     
      <dt><em>logo标志（250*60）：  </em>
     
        <input name="img" type="text" id="img" size="60" class="up_pic_input" value="<?php echo $row1['imgurl']?>"/>
        <div class="up_pic_but" id="image">上传截图</div>
      </dt>
      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
 
  <img style="width:250px;" src="<?php echo $row1['imgurl']?>"/>
 

  
  
</div>
</body>
</html>