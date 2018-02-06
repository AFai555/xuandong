<?php 

require 'session.php';
if ($_GET['act']=='xiugai' && isset($_POST['uid'])) {

	$uid=$_POST['uid'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['beizhu']=$_POST['beizhu']	;
	$data['money']=$_POST['money'];
	$data['uid']=$uid;
	$data['addtime']=_nowtime();
	$data['lx']=4;

	if (!is_numeric($data['money'])) ShowMsg('错误：金额只能是数字','-1');
	if ($data['beizhu']=='') ShowMsg('错误：备注不能为空','-1');
	_query("UPDATE member SET money=money+{$data['money']} WHERE id='{$uid}'");
	_insert('caiwu',$data);
	ShowMsg('成功：会员充值成功',$PreviousUrl);
}
$row=_get_one('member',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>会员充值</title>
<script type="text/javascript" src="editor/kindeditor.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="editor/Alleditor.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>会员 &gt; 会员管理 &gt; 会员充值</div>
<div class="mainbox">
<form  name="add" method="post" action="?act=xiugai">
<input name="uid" type="hidden" id="uid" value="<?php echo $row['id']?>" />
<input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      <dt><em>会员用户名：<?php echo $row['my_username']?></em> 
      </dt>
      <dt><em>充值金额：</em>
        <input name="money" type="text" id="money" value="" size="10" />
        <span class="textinput">金额只能是数字</span></dt>
      <dt><em>备注：</em>
        <input name="beizhu" type="text" class="up_pic_input" id="beizhu" value="客服代充值" size="60" />
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