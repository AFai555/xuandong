<?php 
require 'session.php';
require_once "email.class.php";
if ($_GET['act']=='add') {	
	$data['body']=$_POST['body']	;
	$data['state']=0;
	$data['cid']=$_SESSION['cidtemp'];
	$data['addtime']=_nowtime();
	if ($data['body']=='') ShowMsg('错误：内容不能为空','-1');
	if ($data['cid']=='') ShowMsg($_SESSION['cidtemp'],'-1');
	_insert('jugaohf',$data);
	
	$mc=_get_one('cart',$_SESSION['cidtemp']);
	$r1=_get_one('member',$mc['uid']);
	$mail=_get_one('mail',1);
	$case=_get_one('meiti_case',$mc['pid']);
//******************** 配置信息 ********************************
	$smtpserver = $mail['name'];//SMTP服务器
	$smtpserverport = $mail['tip'];//SMTP服务器端口
	$smtpusermail = $mail['user'];//SMTP服务器的用户邮箱
	$smtpemailto = $r1['mail'];//发送给谁
	$smtpuser =  $mail['uname'];//SMTP服务器的用户帐号
	$smtppass =  $mail['pwd'];//SMTP服务器的用户密码
	$mailtitle =$mc['title']." 已拒稿";//邮件主题
	$mailcontent = "尊敬的客户"."<br />"."<?php echo $config_name?>自助发稿平台提醒您"."<br />"."标题：".$mc['title']."<br />"."媒体：".$case['title']."<br />"."拒稿原因：".$_POST['body']."<br />"."发稿平台：http://<?php echo $c_ym?> ";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
	
	ShowMsg('成功：添加成功','gaojian.php');
}

if ($_GET['act']=='up') {	
    $id=$_POST['id1'];
	$data['body']=$_POST['body1'];
	$data['state']=0;
	$data['cid']=$_POST['cid1'];
	$data['addtime']=_nowtime();
	if ($data['body']=='') ShowMsg('错误：内容不能为空1','-1');
	_update('jugaohf',$data,$id);
	ShowMsg('成功：修改成功','gaojian.php');
}
$_SESSION['cidtemp']=$_GET['id'];
$row=_get_ones('jugaohf',$_GET['id']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>添加通知</title>
<script type="text/javascript" src="editor/kindeditor.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="editor/Alleditor.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>拒搞通知 &gt; 添加通知</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=add">
    <dl>
     
      <dt><em>拒搞回复详细内容：</em>
       <input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
        <input name="cid" type="hidden" id="cid" value="<?php echo $row['cid']?>" />
         <textarea name="body" cols="60" rows="6" id="body"  ></textarea>
      </dt>
      
      <dt>
        <input type="submit" value="新增保存" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>

<div class="mainbox">
  <form  name="up" method="post" action="?act=up">
    <dl>
     
      <dt><em>拒搞回复详细内容：</em>
       <input name="id1" type="hidden" id="id1" value="<?php echo $row['id']?>" />
        <input name="cid1" type="hidden" id="cid1" value="<?php echo $row['cid']?>" />
         <textarea name="body1" cols="60" rows="6" id="body1"  ><?php echo $row['body']?> </textarea>
      </dt>
      
      <dt>
        <input type="submit" value="确认修改" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>