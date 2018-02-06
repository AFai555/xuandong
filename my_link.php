<?php require 'session.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻软文自助发布平台</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./myadmin/editor/kindeditor.js"></script>
<script type="text/javascript" src="./myadmin/editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./myadmin/editor/Alleditor.js"></script>
</head>

<body>
<div class="main">
  <div class="weizhibox">当前位置：我的代理管理 &gt;&gt; 我的推广链接</div>
  <?php require 'user_top.php'?>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td><div class="xuqiu_about"><p>普通客户收益计算方式：<br />
        邀请好友注册交稿返现金。<br />
          好友通过您发布的邀请链接注册为本站会员，其在本站<?php echo $config_showtime?>内发稿每篇<?php echo $config_money?>元收益；<br />
          如您介绍客户发1000篇，则收益是1000*<?php echo $config_money?>=<?php echo $config_money?>000元。</p>
          <p>将本平台推广链接提供给客户注册会员，并自助发稿时才会产生数据。<br />
          只要客户访问过此链接并注册充值发稿，系统将会跟踪统计此客户为您的业绩收益。</p>
          <p>推广链接:  <a href="http://<?php echo $c_ym?>?u=<?php echo $_SESSION['user_name']?>" target="_blank">http://<?php echo $c_ym?>?u=<?php echo $_SESSION['user_name']?></a><br />
        复制推广链接放在您公司自己网站上作为自助发稿平台入口，或QQ群上推广，或博客推广等等，您只需坐等收益就可以了。</p></div></td>
    </tr>
    </table>
</div>
  <!--main end-->

</body>
</html>
