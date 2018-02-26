<?php
require 'session.php';

if (date('d',time())>25) ShowMsg('提示：提现时间为每月1-5号！','-1');

function shouyi_money($uid){
	$sql="SELECT SUM(money) AS sum FROM caiwu WHERE uid={$uid} AND lx=5";
	$money=_mysql_show($sql);
	$sql2="SELECT SUM(money) AS sum FROM caiwu WHERE uid={$uid} AND lx=6";
	$money2=_mysql_show($sql2);
	return $money['sum']-$money2['sum'];
}


if ($_POST['pn_post']=='确定提现'){
	$data['leixing']=$_POST['leixing'];
	$data['huming']=$_POST['huming'];
	$data['zhanghao']=$_POST['zhanghao'];
	$data['money']=$_POST['money'];
	$data['uid']=$_SESSION['userid'];
	$shouyi_money=$_POST['shouyi_money'];
	if ($data['money']>$shouyi_money) ShowMsg('提示：提现金额不能大于代理收益余额','-1');
	if ($data['money']<$config_tixianmoney) ShowMsg('提示：提现金额不能于'.$config_tixianmoney.'元','-1');
	$data['addtime']=_nowtime();
	if ($data['leixing']=='' || $data['huming']=='' || $data['zhanghao']=='' || $data['money']=='') ShowMsg('必填项不能为空！','-1');
	if (!is_numeric($data['money'])) ShowMsg('错误：提现金额只能是数字','-1');
	_insert('tixian',$data);
	$newid=mysql_insert_id();
	_query("UPDATE member SET money=money-{$data['money']} WHERE id='{$_SESSION['userid']}'");
	
	$data2['uid']=$_SESSION['userid'];
	$data2['pid']=$newid;
	$data2['money']=$data['money'];
	$data2['lx']=6;
	$data2['beizhu']='代理提现';
	$data2['addtime']=_nowtime();
	_insert('caiwu',$data2);
	
	ShowMsg('成功：您的提现申请已成功提交，提现需1-2个工作日！','my_income.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻软文自助发布平台</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form action="" method="post">
<input type="hidden" name="shouyi_money" value="<?php echo shouyi_money($_SESSION['userid'])?>" />
<div class="main">
  <!-- <div class="weizhibox">当前位置：软文代写管理 &gt;&gt; 发布代写需求</div> -->
<?php require 'user_top.php'?>
<div class="meiti_search shouyi">提取余额到银行卡或支付宝 收益余额:<strong><?php echo shouyi_money($_SESSION['userid'])?></strong>元</div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td width="120" height="40"><p class="mc">类型<em>*必填</em></p></td>
        <td><p class="mc"><input name="leixing" type="text" id="leixing" size="40" maxlength="20" />
        （例如：支付宝、农业银行、建设银行） </p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">帐号<em>*必填</em></p></td>
        <td><p class="mc">
          <input name="zhanghao" type="text" id="zhanghao" size="40" maxlength="20" />
        （银行卡号或支付宝帐号） </p></td>
      </tr>
      <tr>
        <td width="120" height="40"><p class="mc">户名<em>*必填</em></p></td>
        <td><p class="mc"><input name="huming" type="text" id="huming" size="40" maxlength="20" />
        </p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">金额<em>*必填</em></p></td>
        <td><p class="mc">
          <input name="money" type="text" id="money" size="10" maxlength="20" />
元 （最低提现金额<?php echo $config_tixianmoney?>元）</p></td>
      </tr>
    </table>
<div class="addSub"><input type="submit" name="pn_post" value="确定提现" />
</div>
  </div>

  <!--main end-->
</div>
</form>
</body>
</html>
