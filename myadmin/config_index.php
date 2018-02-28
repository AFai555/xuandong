<?php
require 'session.php';

if ($_GET['act']=='xiugai') {
	if ($_POST['config_showtime']=='') ShowMsg('错误：有效时间不能为空','-1');
	if (!is_numeric($_POST['config_time'])) ShowMsg('错误：时间只能是数字','-1');
	if (!is_numeric($_POST['config_money'])) ShowMsg('错误：收益金额只能是数字','-1');
	if ($_POST['config_alipay_pid']=='') ShowMsg('错误：合作者身份（PID）不能为空','-1');
	if ($_POST['config_alipay_key']=='') ShowMsg('错误：安全校验码（Key）不能为空','-1');
	if (!is_numeric($_POST['config_tixianmoney'])) ShowMsg('错误：最低提现金额只能是数字','-1');
	// if ($_POST['config_meiti']=='') ShowMsg('错误：综合媒体不能为空','-1');
	if (!is_numeric($_POST['config_daixie_price'])) ShowMsg('错误：代写金额只能是数字','-1');

	$bodyhtml='<?php';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_showtime="'.$_POST['config_showtime'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_time_day="'.$_POST['config_time'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_money="'.$_POST['config_money'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_alipay_pid="'.$_POST['config_alipay_pid'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_alipay_key="'.$_POST['config_alipay_key'].'";';	
	$bodyhtml.="\n";	
	$bodyhtml.='$config_name="'.$_POST['config_name'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_title="'.$_POST['config_title'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_dis="'.$_POST['config_dis'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_d_dis="'.$_POST['config_d_dis'].'";';	
	$bodyhtml.="\n";		
	$bodyhtml.='$config_meiti="'.$_POST['config_meiti'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_tixianmoney="'.$_POST['config_tixianmoney'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_daixie_price="'.$_POST['config_daixie_price'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_qa="'.$_POST['config_qa'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_qb="'.$_POST['config_qb'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$config_qc="'.$_POST['config_qc'].'";';	
	$bodyhtml.="\n";	
	$bodyhtml.='$c_tel="'.$_POST['c_tel'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$c_dress="'.$_POST['c_dress'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$c_comp="'.$_POST['c_comp'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$c_email="'.$_POST['c_email'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$c_zfb="'.$_POST['c_zfb'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$c_zfb_name="'.$_POST['c_zfb_name'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$c_ym="'.$_POST['c_ym'].'";';	
	$bodyhtml.="\n";
	$bodyhtml.='$c_bah="'.$_POST['c_bah'].'";';	
	$bodyhtml.="\n";	
	$bodyhtml.='?>';	
	$fp = fopen("../include/config.index.php","w");
	if(!$fp){
		ShowMsg('错误：无法写入配置文件','-1');
	}else{
		fwrite($fp,$bodyhtml);
		fclose($fp);
		ShowMsg('成功：网站配置成功','config_index.php');
	}
			
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>基本设置</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>设置 &gt; 网站基本设置</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=xiugai">
    <dl>
      <dt><em>推广有效时间（显示）：</em>
        <input name="config_showtime" type="text" id="config_showtime" value="<?php echo $config_showtime?>" size="10" />
        <span class="textinput">只为显示作用，不参与程序计算</span></dt>
      <dt><em>推广有效时间（程序）：</em>
        <input name="config_time" type="text" id="config_time" size="10" value="<?php echo $config_time_day?>" />
        天
        <span class="textinput">必须为数字</span></dt>
      <dt><em>每单收益：</em>
        <input name="config_money" type="text" id="config_money" size="10" value="<?php echo $config_money?>" />
        元
        <span class="textinput">推广注册，有效期内每单稿件的收益</span></dt>
      <dt><em>代写价格：</em>
        <input name="config_daixie_price" type="text" id="config_daixie_price" size="10" value="<?php echo $config_daixie_price?>" />
        元
        <span class="textinput">代写单篇价格</span></dt>
      <dt><em>最低提现金额：</em>
        <input name="config_tixianmoney" type="text" id="config_tixianmoney" size="10" value="<?php echo $config_tixianmoney?>" />
        元
        <span class="textinput">推广注册，有效期内每单稿件的收益</span></dt>
      <dt><em>合作者身份（PID）：</em>
        <input name="config_alipay_pid" type="text" id="config_alipay_pid" size="25" value="<?php echo $config_alipay_pid?>" />
        <span class="textinput">合作身份者id，以2088开头的16位纯数字</span></dt>
      <dt><em>安全校验码（Key）：</em>
        <input name="config_alipay_key" type="text" id="config_alipay_key" size="35" value="<?php echo $config_alipay_key?>" />
        <span class="textinput">安全检验码，以数字和字母组成的32位字符</span></dt>        
         <dt><em>网站名称：</em>
        <input name="config_name" type="text" id="config_name" size="25" value="<?php echo $config_name?>" />
        <span class="textinput">适当字数，不宜过长</span></dt>
         <dt><em>关键字：</em>
        <input name="config_title" type="text" id="config_title" size="100" value="<?php echo $config_title?>" />
        <span class="textinput">请以 “,”或者“|” 隔开</span></dt>
         <dt><em>网站描述：</em>
        <input name="config_dis" type="text" id="config_dis" size="100" value="<?php echo $config_dis?>" />
        <span class="textinput"></span></dt>    
          <dt><em>网站顶部文字描述：</em>
        <input name="config_d_dis" type="text" id="config_d_dis" size="100" value="<?php echo $config_d_dis?>" />
        <span class="textinput"></span></dt>     
         <dt><em>QQ1：</em>
        <input name="config_qa" type="text" id="config_qa" size="25" value="<?php echo $config_qa?>" />
        <span class="textinput"></span></dt>
         <dt><em>QQ2：</em>
        <input name="config_qb" type="text" id="config_qb" size="25" value="<?php echo $config_qb?>" />
        <span class="textinput"></span></dt>
         <dt><em>QQ3：</em>
        <input name="config_qc" type="text" id="config_qc" size="25" value="<?php echo $config_qc?>" />
        <span class="textinput"></span></dt>
            <dt><em>电话：：</em>
        <input name="c_tel" type="text" id="c_tel" size="25" value="<?php echo $c_tel?>" />
        <span class="textinput"></span></dt>
            <dt><em>联系地址：：</em>
        <input name="c_dress" type="text" id="c_dress" size="50" value="<?php echo $c_dress?>" />
        <span class="textinput"></span></dt>
            <dt><em>公司名称：</em>
        <input name="c_comp" type="text" id="c_comp" size="50" value="<?php echo $c_comp?>" />
        <span class="textinput"></span></dt>
            <dt><em>邮箱：</em>
        <input name="c_email" type="text" id="c_email" size="25" value="<?php echo $c_email?>" />
        <span class="textinput"></span></dt>
            <dt><em>企业支付宝账号：</em>
        <input name="c_zfb" type="text" id="c_zfb" size="25" value="<?php echo $c_zfb?>" />
        <span class="textinput"></span></dt>
         <dt><em>企业支付宝名称：</em>
        <input name="c_zfb_name" type="text" id="c_zfb_name" size="25" value="<?php echo $c_zfb_name?>" />
        <span class="textinput"></span></dt>
           <dt><em>域名：</em>
        <input name="c_ym" type="text" id="c_ym" size="25" value="<?php echo $c_ym?>" />
        <span class="textinput"></span></dt>
           <dt><em>备案号：</em>
        <input name="c_bah" type="text" id="c_bah" size="25" value="<?php echo $c_bah?>" />
        <span class="textinput"></span></dt>
        
      <!-- <dt><em>综合门户媒体：</em>
        <textarea name="config_meiti" cols="100" rows="6" id="config_meiti"><?php //echo $config_meiti?></textarea>
        <span class="textareatxt">每个关键词之间用、分开，例如 ：搜狐、新浪、腾讯、网易、凤凰网</span></dt> -->
      <dt>
        <input type="submit" value="保存" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>
