<?php 

require 'session.php';

if ($_GET['act']=='xiugai' && isset($_POST['uid'])) {

	$uid=$_POST['uid'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['nickname']=$_POST['nickname']	;
	$data['tel']=$_POST['tel'];
	$data['qq']=$_POST['qq']	;
	$data['mail']=$_POST['mail'];
	$data['regtime']=$_POST['regtime'];
  $data['grade'] = $_POST['grade'];
	if ($_POST['password']!='') $data['my_password']=md5($_POST['password']);
	_update('member',$data,$uid);
  _delete_tj('cart',"uid=".$uid." AND zt=0");
	ShowMsg('成功：会员修改成功',$PreviousUrl);
return ;
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
<div class="menubox"><strong>当前位置：</strong>会员 &gt; 会员管理 &gt; 会员修改</div>
<div class="mainbox">
<form  name="add" method="post" action="?act=xiugai">
<input name="uid" type="hidden" id="uid" value="<?php echo $row['id']?>" />
<input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      <dt><em>会员用户名：<?php echo $row['my_username']?></em>      </dt>
      <dt><em>登录密码：</em>
        <input name="password" type="password" id="password" size="30" />
        <span class="textinput">不修改留空</span></dt>
      <dt><em>姓名：</em>
        <input name="nickname" type="text" id="nickname" value="<?php echo $row['nickname']?>" size="30" />
      </dt>
     
      <dt><em>手机：</em>
        <input name="tel" type="text" id="tel" value="<?php echo $row['tel']?>" size="30" />
      </dt>

      <!-- 增加会员等级 -->
      <!-- 可以参照case_edit.php 的“地区” -->
      <dt><em>会员等级：</em>
        <select name="grade">
          <option selected="selected" value="普通会员">普通会员</option>
          <option value="高级会员">高级会员</option>
          <option value="钻石会员">钻石会员</option>
        </select>
      </dt>

      <dt><em>QQ：</em>
        <input name="qq" type="text" id="qq" value="<?php echo $row['qq']?>" size="30" />
      </dt>
      <dt><em>邮箱：</em>
        <input name="mail" type="text" id="mail" value="<?php echo $row['mail']?>" size="30" />
      </dt>
      <dt><em>注册时间：</em>
        <input name="regtime" type="text" value="<?php echo $row['regtime']?>" size="30" />
        <span class="textinput">时间格式：2014-08-15 22:49:11</span></dt>
      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>