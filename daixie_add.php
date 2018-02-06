<?php
require 'session.php';

if ($_POST['pn_post']=='提交代写需求'){
	$data['title']=$_POST['title'];
	$data['content']=getcontent($_POST['content']);
	$data['num']=$_POST['num'];
	$data['price']=$data['num']*$config_daixie_price;
	$data['uid']=$_SESSION['userid'];
	$data['addtime']=_nowtime();
	$data['bianhao']=time();

	if (!is_numeric($data['num']) || $data['num']<1) ShowMsg('错误：非法操作！','-1');
	if ($data['title']=='') ShowMsg('错误：需求标题不能为空！','-1');
	if ($data['content']=='') ShowMsg('错误：需求内容不能为空！','-1');
	$row_user=_get_one('member',$_SESSION['userid']);
	$userMoney=$row_user['money'];
	if ($data['price']>$userMoney) ShowMsg('错误：当前可用余额不足支付代写费用！','-1');
	if (strlen(strip_tags($data['content']))>1500) {
		ShowMsg('错误：需求描述字数不能超过500字！','-1');
	}
	
	_insert('daixie',$data);
	_query("UPDATE member SET money=money-{$data['price']} WHERE id='{$_SESSION['userid']}'");

	$data2['uid']=$_SESSION['userid'];
	$data2['money']=$data['price'];
	$data2['lx']=2;
	$data2['beizhu']='代写"'.$data['title'].'"支出';
	$data2['addtime']=_nowtime();
	_insert('caiwu',$data2);
	
	ShowMsg('成功：您的稿件已提交成功，金额变化-'.$data2['money'].'元！','daixie_admin.php');
}
?>
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
<form action="" method="post">
<div class="main">
  <div class="weizhibox">当前位置：软文代写管理 &gt;&gt; 发布代写需求</div>
<?php require 'user_top_tp.php'?>
<?php require 'user_top.php'?>
    <div class="add_buzhuo">
    	<a href="daixie_add.php" class="online">第一步：添加并发布写作需求</a>
    	<a href="daixie_admin.php">第三步：查看写作需求列表</a>    </div>
<?php if ($userMoney<$config_daixie_price) :?>
	<div class="tishibox"><strong>* 当前可用余额不足支付代写费用 <a href="alipay.php">请为您的账号充值</a></strong></div>
<?php endif ;?> 
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td width="120" height="40"><p class="mc">需求标题<em>*必填</em></p></td>
        <td><p class="mc"><input name="title" type="text" size="60" maxlength="20" />
        （示例：XXX网推广一期软文代写需求） </p></td>
      </tr>
      <tr>
        <td height="570"><p class="mc">需求详细描述<em>*必填</em></p></td>
        <td>
        <p class="mc"><textarea name="content" class="editor_content" id="content"></textarea>
        </p>
        <p class="mc pt10"><em>需求详细描述示例：</em><br />
          1、推广对象：XXX网（www.XXX.com），正文里嵌入一处网址；<br />
          2、文章体裁：采访型、评论型、故事型、自由型或其它，字数600以上；<br />
          3、文章标题：含关键词“软文发布”，“网络营销”<br />
        4、宣传要点：专业软文发布服务商，丰富媒体资源，为客户带来价值等 </p>        </td>
      </tr>
      <tr>
        <td height="40"><p class="mc">代写篇数-价格</p></td>
        <td><p class="mc">
          <select name="num" id="num">
            <option value="1">代写1篇<?php echo $config_daixie_price*1?>元</option>
            <option value="2">代写2篇<?php echo $config_daixie_price*2?>元</option>
            <option value="3">代写3篇<?php echo $config_daixie_price*3?>元</option>
            <option value="4">代写4篇<?php echo $config_daixie_price*4?>元</option>
            <option value="5">代写5篇<?php echo $config_daixie_price*5?>元</option>
            <option value="6">代写6篇<?php echo $config_daixie_price*6?>元</option>
            <option value="7">代写7篇<?php echo $config_daixie_price*7?>元</option>
            <option value="8">代写8篇<?php echo $config_daixie_price*8?>元</option>
            <option value="9">代写9篇<?php echo $config_daixie_price*9?>元</option>
            <option value="10">代写10篇<?php echo $config_daixie_price*10?>元</option>
          </select>
        </p></td>
      </tr>
    </table>
<?php if ($userMoney<100) :?>
  <div class="addSub"><span>当前余额不足，无法发布需求</span></div>
<?php else :?>
    <div class="addSub"><input type="submit" name="pn_post" value="提交代写需求" />
<?php endif ;?>
  </div>
  <!--main end-->
</div>
</form>
</body>
</html>
