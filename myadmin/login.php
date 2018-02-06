<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/login.css" rel="stylesheet" type="text/css" />
<title>新闻软文自助发布平台</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>

<body>
	<div id="loginbox">
    	<div class="logo">
        	<img src="images/login_logo.gif" />
            <div class="menu"><a href="/" class="a">返回网站</a><a href="tencent://message/?uin=396813261" class="b">联系我们</a></div>
        </div>
        <div class="login">
        <div id="errortxt"></div>
            <dl>
                <dt>用户名：<input type="text" name="adminname" class="u" maxlength="20" id="adminname" />
              </dt>
                <dt>密　码：<input type="password" name="password" class="u" maxlength="20" id="password" />
              </dt>
                <dt>验证码：<input type="text" name="VerifyCode" class="c" maxlength="4" id="VerifyCode" /> <img src="imgcode.php" title="看不清楚？点击刷新！" align="absmiddle" onClick="this.src='imgcode.php?tm='+Math.random()" /></dt>
                <dd><input type="submit" value="登录" class="lbnt" id="submit" /><input type="reset" value="重置" class="lbnt" /></dd>
            </dl>
        </div>
    </div>
</body>
</html>
