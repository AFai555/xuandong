<?php require 'session.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台顶部</title>
<link href="style/top.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/function.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
var displayBar=true;
function switchBar(obj)
{
	if (displayBar)
	{
		window.parent.document.getElementById("frame").cols="0,*";
		displayBar=false;
		$(obj).text("打开左侧")
	}
	else{
		window.parent.document.getElementById("frame").cols="160,*";
		displayBar=true;
		$(obj).text("关闭左侧")
	}
}

$(function(){
	$('#menu>dt').first().addClass('hover');
	$('#menu>dt').click(function(){
		$(this).addClass('hover').siblings().removeClass('hover');
	});
})
</script></head>

<body>
    <div id="header">
        <div class="logo">
            您好：<span><?php echo $_SESSION['username']?></span>　<a href="loginout.php" onclick="Esccfm()" target="_parent">退出登录</a>　<a href="javascript:void(0)" onClick="switchBar(this)">关闭左侧</a>　<a href="/" target="_blank">预览网站</a>
            <dl id="menu">
                <dt><a href="left.php" target="leftFrame">首页</a></dt>
<?php if ($_SESSION['lv']==1) :?>
                <dt><a href="left.php?act=config" target="leftFrame">设置</a></dt>
                <dt><a href="left.php?act=meiti" target="leftFrame">媒体</a></dt>
<?php endif ;?>
                <dt><a href="left.php?act=gaojian" target="leftFrame">稿件</a></dt>
<?php if ($_SESSION['lv']==1) :?>
                <dt><a href="left.php?act=daixie" target="leftFrame">代写</a></dt>
                <dt><a href="left.php?act=news" target="leftFrame">新闻</a></dt>
                <dt><a href="left.php?act=member" target="leftFrame">会员</a></dt>
                <dt><a href="left.php?act=caiwu" target="leftFrame">财务</a></dt>
<?php endif ;?>
            </dl>
        </div>
    </div>
</body>
</html>
