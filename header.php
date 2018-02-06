<?php session_start();
require './include/conn.php';
$logo_url=_get_one('logo_up','1');
?>
<link rel="stylesheet" type="text/css" href="./other/base.css">
<link rel="stylesheet" type="text/css" href="./other/style.css">
<script src="./other/hm.js"></script><script src="./other/jquery.min.js" type="text/javascript"></script>
<script src="./other/jquery.sslide.js" type="text/javascript"></script>

<div class="header" style="padding-top: 0px;">
  <div class="wrapper" style="width: 100%;">
    <div class="logo"> <a href="/"  target="_parent" title="首页"><img src="<?php echo $logo_url['imgurl']?>" alt="logo"></a> </div>
    <!--logo end-->
    <div class="txt"> <strong><?php echo $config_d_dis?></strong>  </div>
    <div class="tel" style="top: 25px;left: 1100px;"> <div class="contact">
    	<p>客服QQ:<?php echo $config_qa?><a href="tencent://message/?uin=<?php echo $config_qa?>"><img src="images/pa.gif" align="absmiddle" /></a></p>
        <p>客服24小时值班电话：<?php echo $c_tel?></p>
    </div> </div>
  </div>
  <!--wrapper end-->
</div>

<div class="naver">
  <ul class="wrapper" style="width: 100%;">
    <li><a href="/"  target="_parent">网站首页</a></li>
    <li><a href="admin.php?act=gj" target="_parent">新闻发布</a></li>
    <li><a href="admin.php?act=wb" target="_parent">微  博</a></li>
    <li><a href="admin.php?act=lt" target="_parent">论  坛</a></li>
    <li><a href="admin.php?act=wx" target="_parent">微  信</a></li>

   <?php if ($_SESSION['userid']!='') :?>
        <li>[<?php echo $_SESSION['user_name']?>] <a href="loginout.php" target="_parent">退出</a></li>
        <?php else :?>
        <li>
        &nbsp; &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp;
        </li>
        
        <li><a href="login.php" target="_parent">登录</a> <a href="reg.php" target="_parent">注册</a></li>
        <?php endif ;?>
        
    <li><a href="admin.php?act=tj" target="_parent" style="color:#F00">提交资源</a></li>
       </ul>
</div>
<!--
<div class="nav">
	<ul>
    	<li><a href="/" target="_parent">首页</a></li>
    	<li><a href="admin.php?act=gj" target="_parent">新闻发布</a></li>
    	<li><a href="admin.php?act=dx" target="_parent">软文代写</a></li>
    	<li><a href="admin.php" target="_parent">自助发新闻后台</a></li>
        <?php if ($_SESSION['userid']!='') :?>
        <li>[<?php echo $_SESSION['user_name']?>] <a href="loginout.php" target="_parent">退出</a></li>
        <?php else :?>
        <li>
        &nbsp; &nbsp;&nbsp; &nbsp;  &nbsp; &nbsp;&nbsp; &nbsp;
        </li>
        
        <li><a href="login.php" target="_parent">登录</a> <a href="reg.php" target="_parent">注册</a></li>
        <?php endif ;?>
    </ul>
</div>
-->