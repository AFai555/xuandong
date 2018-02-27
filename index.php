<?php
require './include/conn.php';

if ($_GET['u']!=''){
	if ($row=_get_one_tj('member',"my_username='{$_GET['u']}'")){
		$_SESSION['referee']=$row['id'];
	}else{
		$_SESSION['referee']=0;
	}
}

if ($_SESSION['userid']) {
	_location2(NULL,'admin.php?act=gj');
}

if ($_POST['pn_post']=='登陆'){
	$_char_pattern = '/[<>\'\"\ ]/';
	$data['my_username']=$_POST['username'];
	$data['my_password']=$_POST['password'];
	//$data['lttime']=_nowtime();
	$VerifyCode=$_POST['yzm'];
	if ((preg_match($_char_pattern,$data['my_username'])) || (preg_match($_char_pattern,$data['my_password']))) {
		ShowMsg('错误：请勿进行非法操作！','-1');
	}
	if ($VerifyCode=='') ShowMsg('错误：验证码不能为空！','-1');
	if ($data['my_username']=='' || $data['my_password']=='') ShowMsg('错误：用户或密码不能为空','-1');
	if ($VerifyCode != $_SESSION[an]) ShowMsg('错误：验证码不正确！','-1');
	$data['my_password']=md5($data['my_password']);
	if (!$row=_get_one_tj('member',"my_username='{$data['my_username']}' AND my_password='{$data['my_password']}'")){
		ShowMsg('错误：用户名或密码错误！','-1');
	}else{
		$_SESSION['userid']=$row['id'];
		$_SESSION['user_name']=$row['my_username'];
		$_SESSION['user_grade']=$row['grade'];
		if (time()-strtotime($row['regtime'])>$config_time){
			$_SESSION['referee']=0;
		}else{
			$_SESSION['referee']=$row['referee'];
		}
		ShowMsg('成功：恭喜您，会员登陆成功！','admin.php');
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
</head>

<body>
<form action="" method="post">
<div class="loginBox">
	<h1><a href="/">首页</a></h1>
    <div class="box">
    	<h2>登录</h2>
        <p><span>QQ号/帐号：</span><input name="username" type="text" maxlength="20" id="username" />
      </p>
        <p><span>登录密码：</span><input name="password" type="password" maxlength="15" />
       （忘记密码请联系客服）</p>
        <p><span>验证码：</span><input name="yzm" type="text" maxlength="4" id="yzm" style="width:80px;" />&nbsp;<img src="myadmin/imgcode.php" title="看不清楚？点击刷新！" align="absmiddle" onClick="this.src='myadmin/imgcode.php?tm='+Math.random()" />
      </p>
        <p class="sub">
        	<input type="submit" name="pn_post" value="登陆" />
            <a href="reg.php">没有帐号，立即10秒注册</a>
        </p>
    </div>
    <div class="foot"><span>客服QQ：<a href="tencent://message/?uin=<?php echo $config_qa?>"><img src="images/pa.gif" align="absmiddle" /></a> 电话：<?php echo $c_tel?></span><?php echo $config_name?>---新闻软文自助发布平台</div>
</div>
</form>
</body>
</html>
