<?php
require 'session.php';

if ($_GET['act']=='xiugai') {
	
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['kd']=$_POST['kd']	;
	$data['name1']=$_POST['name1']	;
	$data['lv1']=$_POST['lv1']	;
	$data['name2']=$_POST['name2']	;
	$data['lv2']=$_POST['lv2']	;
	if ($data['name1']=='') ShowMsg('错误：普通会员消费金额不能为空','-1');
	if ($data['lv1']=='') ShowMsg('错误：普通会享受折扣不能大于1','-1');
	if ($data['name2']=='') ShowMsg('错误：高级会员消费金额不能为空','-1');
	if ($data['lv2']=='') ShowMsg('错误：高级通会享受折扣不能大于1','-1');
	_update('vip',$data,1);
	ShowMsg('成功：会员信息成功',$PreviousUrl);
		
}
$row=_get_one('vip',1);
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
  <form  name="add" method="post" action="?act=xiugai">
    <input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
  
    <dl>
    <dt>会员启用：
        <input name="kd" type="radio" id="kd" value="1" <?php echo _danxuan(1,$row['kd'])?> />
        启用
  <input type="radio" name="kd" id="kd" value="0" <?php echo _danxuan(0,$row['kd'])?> />
  关闭
        </dt>

      <!-- <dt>普通会员：
        <input name="name1" type="text" id="name1" size="10" value="<php echo $row['name1']?>" />
        <span class="textinput">元   ---普通会员的条件，消费满XX元</span></dt>
 
      <dt>普通会员：
        <input name="lv1" type="text" id="lv1" size="10" value="<php echo $row['lv1']?>" />
        <span class="textinput"> 普通会员享受的价格折扣--1为不打折--0.9为打九折以此类推。</span></dt>
      
      <dt>高级会员：
        <input name="name2" type="text" id="name2" size="10" value="<php echo $row['name2']?>" />
        <span class="textinput">元 ---高级会员的条件，消费满XX元</span></dt>
    
      <dt>高级会员：
        <input name="lv2" type="text" id="lv2" size="10" value="<php echo $row['lv2']?>" />
        <span class="textinput">  ---高级会员享受的价格折扣--1为不打折--0.9为打九折以此类推。</span></dt> -->

        <dt>普通会员：
        <input name="name1" type="text" id="name1" size="10" value="<?php echo $row['name1']?>" />
        <span class="textinput">元   ---普通会员比成本价高15元</span></dt>
      
      <dt>高级会员：
        <input name="name2" type="text" id="name2" size="10" value="<?php echo $row['name2']?>" />
        <span class="textinput">元 ---高级会员比成本价高10元</span></dt>

      <dt>钻石会员：
        <input name="name3" type="text" id="name3" size="10" value="<?php echo $row['name3']?>" />
        <span class="textinput">元 ---钻石会员比成本价高5元</span></dt>


      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>