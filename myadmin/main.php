<?php require 'session.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link href="style/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>后台首页</div>
<div class="title top10px"><div class="subject"><span>管理首页</span></div></div>
<div class="box">
	<p class="t1">您好：<?php echo $_SESSION['username']?></p>
    <p class="t2">您已登录：<span><?php echo $_SESSION['dlcs']+1?> 次</span> 上一次登录IP：<span><?php echo $_SESSION['dlip']?></span> 上一次登录日期：<span><?php echo $_SESSION['dldata']?></span></p>
</div>
<div class="title"><div class="subject"><span>系统信息</span></div></div>
<div class="box">
	<dl>
    	<dt>程序信息： <?php echo $config_name?>新闻软文自助发布平台</dt>
    	<dt>当前版本： Mycms 2.1.0 beta </dt>
    	<dt>程序架构： PHP+MYSQL  UTF-8版本 </dt>
   	</dl>
</div>
</body>
</html>
