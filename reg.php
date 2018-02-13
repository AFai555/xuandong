<?php
require './include/conn.php';

if ($_POST['pn_post']=='注册'){
	$data['my_username']=$_POST['username'];
	$data['my_password']=$_POST['password'];
	if ($data['my_username']=='' || $data['my_password']=='') ShowMsg('错误：用户或密码不能为空','-1');
	$data['my_password']=md5($data['my_password']);
	$data['regtime']=_nowtime();
	$data['referee']=$_SESSION['referee'];
	if (_get_one_tj('member',"my_username='{$data['my_username']}'")){
		ShowMsg('提示：该帐号已存在，请重新注册！','-1');
	}
	_insert('member',$data);

	if (!$row=_get_one_tj('member',"my_username='{$data['my_username']}' AND my_password='{$data['my_password']}'")){
		ShowMsg('错误：用户名或密码错误！','-1');
	}else{
		$_SESSION['userid']=$row['id'];
		$_SESSION['user_name']=$row['my_username'];
		if (time()-strtotime($row['regtime'])>$config_time){
			$_SESSION['referee']=0;
		}else{
			$_SESSION['referee']=$row['referee'];
		}
		ShowMsg('成功：恭喜您，会员注册成功！','admin.php');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $config_title?>-<?php echo $config_name?></title>
<meta name="description" content="<?php echo $config_dis?>">
<meta name="keywords" content="<?php echo $config_title?>">
<link href="css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/reg.js"></script>
</head>

<body>
<div class="loginBox">
	<h1><a href="/">首页<span class="nop">
	  <input name="password" type="password" id="password" maxlength="15" />
	</span></a></h1>
    <div class="box">
    <h2>10秒快速注册</h2>
		<p class="nop"><span style="width:180px">QQ号/帐号：</span><input name="username" type="text" id="username"/> (亲，请确保QQ号是真实的，找回密码需要用到) </p>
        <p class="nop"><span  style="width:180px">设置密码：</span> 
			<input name="pasd" type="password" id="pasd" maxlength="15" />
        (与真正QQ登录密码不同，此为本平台登录密码) </p>
		<p><span  style="width:180px">验证码：</span><input name="VerifyCode" type="text" maxlength="4" id="VerifyCode" style="width:80px;" />&nbsp;<span style="width:80px"><img src="myadmin/imgcode.php" title="看不清楚？点击刷新！" align="absmiddle" onClick="this.src='myadmin/imgcode.php?tm='+Math.random()" /></span><span> <strong id="errorTxt"></strong></span></p>
		
		<p class="sub" style="width:300px ">
			<input name="submit" type="button" id="submit" value="注册" />
			<a href="login.php">已有帐号，现在立即登陆</a>
		</p>
    </div>
    <div class="foot"><span>客服QQ：<a href="tencent://message/?uin=<?php echo $config_qa?>"><img src="images/pa.gif" align="absmiddle" /></a> 电话：<?php echo $c_tel?></span><?php echo $config_name?>---新闻软文自助发布平台</div>
</div>
</body>
</html>
