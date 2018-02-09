<?php require 'session.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/left.css" rel="stylesheet" type="text/css" />
<title>后台左侧</title>
<script type="text/javascript" src="js/function.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(function(){
	$('#menu>dt').first().addClass('hover');
	var url=$("#left dt:first-child a").attr("href");
	parent.mainFrame.location=url;
	$('#menu>dt').click(function(){
		$(this).addClass('hover').siblings().removeClass('hover');
	});
})
</script>
</head>

<body>
    <div id="left">
        <dl id="menu">
<?php
	$act=$_GET['act'];
	switch ($act){
		case "config":
?>
            <dt><a href="config_index.php" target="mainFrame">○ 网站设置</a></dt>
            <dt><a href="administrator.php" target="mainFrame">○ 管理员管理</a></dt>
            <dt><a href="logo_up.php" target="mainFrame">○ logo设置</a></dt>
            <!-- <dt><a href="shouye_up.php" target="mainFrame">○ 首页大图设置</a></dt> -->
            <!-- <dt><a href="mail_edit.php" target="mainFrame">○ 邮箱设置</a></dt> -->
            <dt><a href="price.php" target="mainFrame">○ 价格批量操作</a></dt>
            <dt><a href="dbbak.php" target="mainFrame">○ 数据库备份还原</a></dt>
            <dt><a href="uvip.php" target="mainFrame">○ 会员信息设置</a></dt>
            <!-- <dt><a href="diqu.php" target="mainFrame">○ 地区设置</a></dt> -->
          
<?php
		break;
		case "tongzhi":
?>
            <dt><a href="tongzhi.php" target="mainFrame">○ 会员通知</a></dt>
<?php
		break;
		case "meiti":
?>
            <dt><a href="case.php" target="mainFrame">○ 案例管理</a></dt>
            <dt><a href="case_add.php" target="mainFrame">○ 添加案例</a></dt>
            <!-- <dt><a href="case_in.php" target="mainFrame">○ 新闻媒体导入</a></dt> -->
            <dt><a href="meiti.php" target="mainFrame">○ 媒体管理</a></dt>
            <!-- <dt><a href="weibocase.php" target="mainFrame">○ 微博案例管理</a></dt>
            <dt><a href="weibocase_add.php" target="mainFrame">○ 添加微博案例</a></dt>
            <dt><a href="weibo.php" target="mainFrame">○ 微博管理</a></dt>
            <dt><a href="luntancase.php" target="mainFrame">○ 论坛案例管理</a></dt>
            <dt><a href="luntancase_add.php" target="mainFrame">○ 添加论坛案例</a></dt>
            <dt><a href="luntan.php" target="mainFrame">○ 论坛管理</a></dt>
            <dt><a href="weixincase.php" target="mainFrame">○ 微信案例管理</a></dt>
            <dt><a href="weixincase_add.php" target="mainFrame">○ 添加微信案例</a></dt>
            <dt><a href="weixin.php" target="mainFrame">○ 微信管理</a></dt>
            <dt><a href="taocan.php" target="mainFrame">○ 套餐管理</a></dt> -->
<?php
		break;
		case "news":
?>
            <dt><a href="news.php" target="mainFrame">○ 新闻管理</a></dt>
<?php
		break;
		case "case":
?>
            <dt><a href="case.php" target="mainFrame">○ 案例管理</a></dt>
            <dt><a href="case_add.php" target="mainFrame">○ 添加案例</a></dt>
<?php
		break;
		case "caiwu":
?>
            <dt><a href="caiwu.php" target="mainFrame">○ 财务记录</a></dt>
            <dt><a href="tixian.php" target="mainFrame">○ 提现申请</a></dt>
<?php
		break;
		case "gaojian":
?>
            <dt><a href="gaojian.php" target="mainFrame">○ 稿件管理</a></dt>
            <!-- <dt><a href="gaojianbb.php" target="mainFrame">○ 付款核对表</a></dt>
            <dt><a href="gaojianwb.php" target="mainFrame">○ 微博稿件管理</a></dt>
            <dt><a href="gaojianlt.php" target="mainFrame">○ 论坛稿件管理</a></dt>
            <dt><a href="gaojianwx.php" target="mainFrame">○ 微信稿件管理</a></dt> -->
<?php
		break;
		case "daixie":
?>
            <dt><a href="daixie.php" target="mainFrame">○ 代写需求</a></dt>
<?php
		break;
		case "member":
?>
            <dt><a href="member.php" target="mainFrame">○ 会员管理</a></dt>
<?php
		break;
		default:
?>
            <dt><a href="main.php" target="mainFrame">○ 管理首页</a></dt>
            <dt><a href="password.php" target="mainFrame">○ 修改密码</a></dt>
            <dt><a href="loginout.php" onclick="Esccfm()" target="_parent">○ 退出登录</a></dt>
<?php }?>
        </dl>
    </div>
</body>
</html>
