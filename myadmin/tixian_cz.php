<?php 

require 'session.php';

if ($_GET['act']=='xiugai' && isset($_POST['id'])) {
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['jietu']=$_POST['img'];
	$data['zt']=1;
	_update('tixian',$data,$id);
	ShowMsg('成功：提现申请已经确定！',$PreviousUrl);
}
$row=_get_one('tixian',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>打款操作</title>
<script type="text/javascript" src="editor/kindeditor.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="editor/Alleditor.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>财务 &gt; 提现申请 &gt; 打款操作</div>
<div class="mainbox">
<form  name="add" method="post" action="?act=xiugai">
<input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
<input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      <dt style="line-height:40px; height:40px;"><em>会员用户名：<?php echo getDbName('member','my_username',$row['uid'])?></em>      </dt>
      <dt style="line-height:40px; height:40px;"><em>类型：<?php echo $row['leixing']?></em>      </dt>
      <dt style="line-height:40px; height:40px;"><em>帐号：<?php echo $row['zhanghao']?></em>      </dt>
      <dt style="line-height:40px; height:40px;"><em>户名：<?php echo $row['huming']?></em>      </dt>
      <dt style="line-height:40px; height:40px;"><em>金额：<span style="color:#FF0000"><?php echo $row['money']?>元</span></em>      </dt>
      <dt><em>打款截图：</em>
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