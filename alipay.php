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
  <div class="weizhibox">当前位置：我的财务管理 &gt;&gt; 我要充值</div>
  <?php require 'user_top_tp.php'?>
  <?php require 'user_top.php'?>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td width="220" height="120" align="center"><strong>在线充值</strong><br />
        (自动到帐)</td>
        <td>
        <form action="../alipay/alipayapi.php" method="post" target="_parent">
        <input type="hidden" value="<?php echo time()?>" name="WIDout_trade_no" />
        <p class="mc"><img src="images/alipay_logo.jpg" /><br />金额：<input name="WIDprice" type="text" id="WIDprice" size="6" />
        元</p>
        <div class="addSub addSub2"><input type="submit" value="确认，下一步在线充值" /></div>
        <p class="mc"><span >支付宝账户：xuandongwl@163.com</span>  &nbsp;&nbsp;&nbsp;户名：东莞市炫动网络科技有限公司 </p>
      
</form>
        </td>
      </tr>
      <tr>
        <td height="50" align="center"><strong>对公账户</strong><br />
        (需要通知客服代操作)</td>
        <td><p ><span><br />账号：7449510182600007614</span><br/>
        <span>户名：东莞市炫动网络科技有限公司</span><br/>
        <span>开户行：中信银行股份有限公司东莞寮步支行</span></p><br/>
</td>
      </tr>
    </table>
  </div>
  <!--main end-->

</body>
</html>
