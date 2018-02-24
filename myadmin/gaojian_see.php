<?php 
require 'session.php';
require '../include/encrypt.php';
require_once "email.class.php";

if ($_GET['act']=='ju' && isset($_GET['id'])){
	if (!$row=_get_one_tj('cart',"id={$_GET['id']} AND (zt=1 or zt=2)")) ShowMsg('错误：该稿件不存在','-1');
	$data['zt']=4;
	_update('cart',$data,$_GET['id']);
	_query("UPDATE member SET money=money+{$row['price']} WHERE id='{$row['uid']}'");
	
	$data2['uid']=$row['uid'];
	$data2['money']=$row['price'];
	$data2['lx']=3;
	$data2['beizhu']='拒稿"'.'【'.cart_tui_case($row['pid']).'】'.$row['title'].'"返还';
	$data2['addtime']=_nowtime();
	_insert('caiwu',$data2);
/*
	$r1=_get_one('member',$row['uid']);
	$mail=_get_one('mail',1);
	$case=_get_one('meiti_case',$row['pid']);
//******************** 配置信息 ********************************
	$smtpserver = $mail['name'];//SMTP服务器
	$smtpserverport = $mail['tip'];//SMTP服务器端口
	$smtpusermail = $mail['user'];//SMTP服务器的用户邮箱
	$smtpemailto = $r1['mail'];//发送给谁
	$smtpuser =  $mail['uname'];//SMTP服务器的用户帐号
	$smtppass =  $mail['pwd'];//SMTP服务器的用户密码
	$mailtitle =$row['title']." 已拒搞";//邮件主题
	$mailcontent = "尊敬的客户"."<br />"."风行自助发稿平台提醒您"."<br />"."标题：".$row['title']."<br />"."媒体：".$case['title']."<br />"."发稿平台：http://www.6697.cc ";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
*/
	ShowMsg('成功：已拒稿成功',$_SERVER['HTTP_REFERER']);
}

if ($_POST['pn_post']=='提交网址' && isset($_POST['gid'])){
	if (!$row=_get_one('cart',$_POST['gid'])) ShowMsg('错误：该稿件不存在','-1');
	$g_zt=$row['zt'];
	$data['get_url']=$_POST['get_url'];
	$data['zt']=3;
	if ($data['get_url']=='') ShowMsg('错误：提交的网址不能为空','-1');
	$gid=$_POST['gid'];
	_update('cart',$data,$gid);
	
	if ($row['referee']>0 && $g_zt==2){
		_query("UPDATE member SET money=money+{$config_money} WHERE id='{$row['referee']}'");	
		$data2['uid']=$row['referee'];
		$data2['pid']=$gid;
		$data2['money']=$config_money;
		$data2['lx']=5;
		$data2['beizhu']='稿件"'.$row['title'].'"代理收益';
		$data2['addtime']=_nowtime();
		_insert('caiwu',$data2);
	}
	$r1=_get_one('member',$row['uid']);
	$mail=_get_one('mail',1);
	$case=_get_one('meiti_case',$row['pid']);
//******************** 配置信息 ********************************
	/*
	$smtpserver = $mail['name'];//SMTP服务器
	$smtpserverport = $mail['tip'];//SMTP服务器端口
	$smtpusermail = $mail['user'];//SMTP服务器的用户邮箱
	$smtpemailto = $r1['mail'];//发送给谁
	$smtpuser =  $mail['uname'];//SMTP服务器的用户帐号
	$smtppass =  $mail['pwd'];//SMTP服务器的用户密码
	$mailtitle =$row['title']." 已出稿";//邮件主题
	$mailcontent = "尊敬的客户"."<br />"."<?php echo $config_name?>自助发稿平台提醒您"."<br />"."标题：".$row['title']."<br />"."媒体：".$case['title']."<br />"."发布结果：".$data['get_url']."<br />"."发稿平台：http://<?php echo $c_ym?> ";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);*/

	/*ShowMsg('成功：已成功提交发布网址！',$_SERVER['HTTP_REFERER']);*/

}


if ($_POST['pn_postx']=='确定修改频道' && isset($_POST['gidx'])){
	if (!$row=_get_one('cart',$_POST['gidx'])) ShowMsg('错误：该稿件不存在','-1');	
	$r1=_get_one('member',$row['uid']);
	$mail=_get_one('mail',1);
	$data['pid']=$_POST['pidx'];
    $data['price']=$_POST['jgx'];
	if ($data['pid']=='') ShowMsg('错误：频道ID不能为空','-1');
	if ($data['price']=='') ShowMsg('错误：会员价不能为空','-1');
	if (!is_numeric($data['pid'])) ShowMsg('错误：：频道ID只能是数字','-1');
	if (!is_numeric($data['price'])) ShowMsg('错误：价格只能是数字','-1');
	$gidx=$_POST['gidx'];
	_update('cart',$data,$gidx);
	ShowMsg('成功：已成修改频道！',$_SERVER['HTTP_REFERER']);
}

if ($_GET['act']=='shou' && isset($_GET['id'])){
	if (!$row=_get_one('cart',$_GET['id'])) ShowMsg('错误：该稿件不存在','-1');
	$data['zt']=2;
	_update('cart',$data,$_GET['id']);
/*
	$r1=_get_one('member',$row['uid']);
	$mail=_get_one('mail',1);
	$case=_get_one('meiti_case',$row['pid']);	
	//******************** 配置信息 ********************************
	$smtpserver = $mail['name'];//SMTP服务器
	$smtpserverport = $mail['tip'];//SMTP服务器端口
	$smtpusermail = $mail['user'];//SMTP服务器的用户邮箱
	$smtpemailto = $r1['mail'];//发送给谁
	$smtpuser =  $mail['uname'];//SMTP服务器的用户帐号
	$smtppass =  $mail['pwd'];//SMTP服务器的用户密码
	$mailtitle =$row['title']." 已收稿";//邮件主题
	$mailcontent = "尊敬的客户"."<br />"."风行自助发稿平台提醒您"."<br />"."标题：".$row['title']."<br />"."媒体：".$case['title']."<br />"."发稿平台：http://www.6697.cc ";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
*/
	ShowMsg('成功：已收稿成功',$_SERVER['HTTP_REFERER']);
}

function cart_case($pid){
	$row=_get_one('meiti_case',$pid);
	$t_html = '<a href="'.$row['link'].'" target="_blank">'.$row['title'].'</a> <a href="'.$row['case_url'].'" target="_blank">[案例]</a> ';
	$t_html.='<a href="tencent://message/?uin='.$row['qq'].'"><img src="images/pa.gif" /></a> QQ:'.$row['qq'].' 电话：'.$row['tel'];
	return $t_html;
}

function cart_tui_case($pid){
	$row=_get_one('meiti_case',$pid);
	return $row['title'];
}
function cart_zt($str){
	if ($str==1){
		return '待收稿';
	}elseif ($str==2){
		return '已收稿';
	}elseif ($str==3){
		return '已发布';
	}elseif ($str==4){
		return '已拒稿';
	}else{
		return '未发布';
	}
}

function cart_cz($zt,$id){
	if ($zt==1){
		return '【<a href="?act=shou&id='.$id.'">收稿</a>】 【<a href="?act=ju&id='.$id.'">拒稿</a>】';
	}elseif ($zt==2){
		return '【<a href="?act=ju&id='.$id.'">拒稿</a>】';
	}
}

function wz_lx($lx){
	if ($lx==1){
		return '稿件里网址不带都无所谓';
	}elseif ($lx==2){
		return '稿件里网址一定要带上，否则不发';
	}elseif ($lx==3){
		return '稿件里关键字超链一定要带上，否则不发';
	}else{
		return '未定义';
	}
}
function jg_lx($lx){
	if ($lx==1){
		return '因编辑原因当天未完成发布，隔天也可以等';
	}elseif ($lx==2){
		return '当天要完成发布，超时就撤消稿件';
	}else{
		return '未定义';
	}
}

$row=_get_one('cart',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>查看稿件</title>
<script src="js/function.js" type="text/javascript"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>稿件 &gt; 稿件管理  &gt; 查看稿件</div>
<div class="adminbox">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE">
    <tr>
      <td width="15%" height="35"><P class="see_con">文章标题</P></td>
      <td><p class="see_con"><span style="float:right;"><a href="/see.php?<?php echo encrypt($row['id'], 'E')?>" target="_blank">【查看链接】</a></span><strong><?php echo $row['title']?></strong></p></td>
    </tr>
    <tr>
      <td width="15%" height="35"><P class="see_con">发布状态</P></td>
      <td><p class="see_con"><span style="float:right;"><?php echo cart_cz($row['zt'],$row['id'])?></span><strong><?php echo cart_zt($row['zt'])?></strong></p></td>
    </tr>
<?php if ($row['zt']==2 || $row['zt']==3) :?>
    <tr>
      <td height="35"><p class="see_con">发布网址</p></td>
      <td><div class="see_con">
		<form name="p1" action="" method="post">
        	<input type="hidden" name="gid" value="<?php echo $row['id']?>" />
            <input type="text" name="get_url" value="<?php echo $row['get_url']?>" style="width:500px; height:30px; line-height:30px;" />
            <input type="submit" name="pn_post" value="提交网址" style=" padding:8px 30px;" />
        </form></div></td>
    </tr>
<?php endif ;?>
    <!-- <tr>
      <td height="35"><p class="see_con">发布网站频道</p></td>
      <td><p class="see_con"><?php //echo cart_case($row['pid'])?></p>
      <div class="see_con">
      <form name="p2" action="" method="post">
      <input type="hidden" name="gidx" value="<?php //echo $row['id']?>" />
      <label>新频道的ID：</label>
        	<input type="text" name="pidx" style="width:100px; height:20px; line-height:20px;" value="" />
            <label>新频道的会员价：</label>
        	<input type="text" name="jgx" style="width:100px; height:20px; line-height:20px;" value="" />
            <input type="submit" name="pn_postx" value="确定修改频道" style=" padding:8px 10px;" />
        </form>
      </div>
      </td>
    </tr> -->
    <tr>
      <td height="35"><p class="see_con">费用</p></td>
      <td>
      <p class="see_con"><span style="float:right;">
      
      <?php if ($row['fangshi']==3) echo '<a href="http://' .$c_ym.$row['content'].'" target="_blank">【下载文档】</a> ';?>
      </span><strong><?php echo $row['price']?>元</strong></p>
      </td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">稿件内容</p></td>
      <td>
      <table width="98%" border="0"  align="center" cellpadding=0 cellspacing=1 bordercolor=#c9d3e9 style="margin-top:20px;margin-bottom:20px;border-collapse:collapse;table-layout:fixed;">
  <tr>
    <td style="overflow-x:hidden;overflow-y:hidden; word-wrap:break-word;">
       <p class="see_con" ><?php echo $row['content']?></p>
    </td>
  </tr>
</table>   
</td>
    </tr>
    <!-- <tr>
      <td height="35"><p class="see_con">附言</p></td>
      <td><p class="see_con"><?php //echo $row['beizhu']?></p></td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">网址强调</p></td>
      <td><p class="see_con"><?php //echo wz_lx($row['wangzhi'])?></p></td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">截稿时间</p></td>
      <td><p class="see_con"><?php //echo jg_lx($row['jiegao'])?></p></td>
    </tr> -->
    <tr>
      <td height="35"><p class="see_con">添加时间</p></td>
      <td><p class="see_con"><?php echo $row['addtime']?></p></td>
    </tr>
  </table>
</div>
</body>
</html>
