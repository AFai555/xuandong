<?php
require 'session.php';

if ($_GET['act']=='xiugai1') {
	
	$PreviousUrl=$_POST['PreviousUrl1'];
	$data['price']=$_POST['price1']	;
	if ($data['price']=='') ShowMsg('错误：价格称不能为空','-1');
	if($_POST['ck1']==1)
	{
			_query("update meiti_case set price = price+".$data['price']." ");
			
	ShowMsg('成功：新闻媒体批量增加价格成功',$PreviousUrl);
		}
	else
	{
	_query("update meiti_case set price = price-".$data['price']." ");
	
	
	ShowMsg('成功：新闻媒体批量减少价格成功',$PreviousUrl);
	}
}
// if ($_GET['act']=='xiugai2') {
	
// 	$PreviousUrl=$_POST['PreviousUrl2'];
// 	$data['price']=$_POST['price2']	;
// 	if ($data['price']=='') ShowMsg('错误：价格称不能为空','-1');
// 	if($_POST['ck2']==1)
// 	{
			
// 			_query("update weibo_case set price = price+".$data['price']." ");
// 	ShowMsg('成功：微博批量增加价格成功',$PreviousUrl);
// 		}
// 	else
// 	{
	
// 	_query("update weibo_case set price = price-".$data['price']." ");
	
// 	ShowMsg('成功：微博批量减少价格成功',$PreviousUrl);
// 	}
// }
// if ($_GET['act']=='xiugai3') {
	
// 	$PreviousUrl=$_POST['PreviousUrl3'];
// 	$data['price']=$_POST['price3']	;
// 	if ($data['price']=='') ShowMsg('错误：价格称不能为空','-1');
// 	if($_POST['ck3']==1)
// 	{
			
// 			_query("update weixin_case set price = price+".$data['price']." ");
			
// 	ShowMsg('成功：微信批量增加价格成功',$PreviousUrl);
// 		}
// 	else
// 	{
	
// 	_query("update weixin_case set price = price-".$data['price']." ");
		
// 	ShowMsg('成功：微信批量减少价格成功',$PreviousUrl);
// 	}
// }
// if ($_GET['act']=='xiugai4') {
	
// 	$PreviousUrl=$_POST['PreviousUrl4'];
// 	$data['price']=$_POST['price4']	;
// 	if ($data['price']=='') ShowMsg('错误：价格称不能为空','-1');
// 	if($_POST['ck4']==1)
// 	{
		
// 			_query("update luntan_case set price = price+".$data['price']." ");
			
// 	ShowMsg('成功：论坛批量增加价格成功',$PreviousUrl);
// 		}
// 	else
// 	{
	
// 	_query("update luntan_case set price = price-".$data['price']." ");
	
// 	ShowMsg('成功：论坛批量减少价格成功',$PreviousUrl);
// 	}
// }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title></title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>价格管理 &gt; 批量修改价格</div>
<div class="mainbox">
  <form  name="add1" method="post" action="?act=xiugai1">
    <input name="PreviousUrl1" type="hidden" id="PreviousUrl1" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      
      <dt>
          新闻媒体_选择加&nbsp;\减
    <select name="ck1">
    	<option value="1">批量+加+价</option>
    	<option value="2">批量-减-价</option>
    </select>
      </dt>
    </dl>
    <dl>
      <dt>会员价：
        <input name="price1" type="text" id="price1" size="10" value="0" />
        <span class="textinput">元</span></dt>
      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>

<!-- <div class="mainbox">
  <form  name="add2" method="post" action="?act=xiugai2">
    <input name="PreviousUrl2" type="hidden" id="PreviousUrl2" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      
      <dt>
          微博媒体_选择加&nbsp;\减
          <select name="ck">
    	<option value="1">批量+加+价</option>
    	<option value="2">批量-减-价</option>
    </select>
      </dt>
    </dl>
    <dl>
      <dt>会员价：
        <input name="price2" type="text" id="price2" size="10" value="0" />
        <span class="textinput">元</span></dt>
      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>

<div class="mainbox">
  <form  name="add3" method="post" action="?act=xiugai3">
    <input name="PreviousUrl3" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      
      <dt>
          微信媒体_选择加&nbsp;\减
          <select name="ck3">
    	<option value="1">批量+加+价</option>
    	<option value="2">批量-减-价</option>
    </select>
      </dt>
    </dl>
    <dl>
      <dt>会员价：
        <input name="price3" type="text" id="price3" size="10" value="0" />
        <span class="textinput">元</span></dt>
      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>

<div class="mainbox">
  <form  name="add4" method="post" action="?act=xiugai4">
    <input name="PreviousUrl4" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      
      <dt>
          论坛媒体_选择加&nbsp;\减
          <select name="ck4">
    	<option value="1">批量+加+价</option>
    	<option value="2">批量-减-价</option>
    </select>
      </dt>
    </dl>
    <dl>
      <dt>会员价：
        <input name="price4" type="text" id="price4" size="10" value="0" />
        <span class="textinput">元</span></dt>
      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div> -->
</body>
</html>