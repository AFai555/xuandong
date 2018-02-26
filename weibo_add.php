<?php
require 'session.php';

//购物车内容
function cartBox(){
	$_result=_query("SELECT * FROM wbcart WHERE uid={$_SESSION['userid']} AND zt=0");
	global $z_price;
	$z_price=0;
	while (!!$row=_mysql_list($_result)) {
		$r_html.=getDbName('weibo_case','title',$row['pid']).'<em>'.$row['price'].'</em>元 ';
		$z_price+=$row['price'];
	}
	$r_html.='总计<em><strong>'.$z_price.'</strong></em>元 ';
	return $r_html;
}
$cartBoxHtml=cartBox();

if ($_POST['pn_post']=='立即提交稿件'){
	$data['title']=$_POST['title'];
	$data['content']=getcontent($_POST['content']);
	$data['beizhu']=$_POST['beizhu'];
	$data['wangzhi']=$_POST['wangzhi'];
	$data['zt']=1;
	$data['baoimg']='index.php';
	$data['addtime']=_nowtime();
	
	if ($data['title']=='') ShowMsg('错误：稿件标题不能为空！','-1');
	if ($data['content']=='') ShowMsg('错误：稿件内容不能为空！','-1');
	if (strlen(strip_tags($data['content']))>30000) {
		ShowMsg('错误：稿件内容字数不能超过1万字！','-1');
	}
	if (strlen(strip_tags($data['beizhu']))>600) {
		ShowMsg('错误：附言字数不能超过200字！','-1');
	}
	_update_tj('wbcart',$data,"uid={$_SESSION['userid']} AND zt=0");
	_query("UPDATE member SET money=money-{$z_price} WHERE id='{$_SESSION['userid']}'");
	
	$data2['uid']=$_SESSION['userid'];
	$data2['money']=$z_price;
	$data2['lx']=2;
	$data2['beizhu']='稿件"'.$data['title'].'"支出';
	$data2['addtime']=_nowtime();
	_insert('caiwu',$data2);
	
	ShowMsg('成功：您的稿件已提交成功，金额变化-'.$z_price.'元！','weibo_admin.php');
}

if (!_get_one_tj('wbcart',"uid={$_SESSION['userid']} AND zt=0")) ShowMsg('提示：您还没有选择需要发布稿件的媒体！','-1');

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
  <!-- <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 提交软文稿件内容</div> -->
    <?php require 'user_top_tp.php'?>
<?php require 'user_top_gg.php'?>
<?php require 'user_top.php'?>
   <div class="add_buzhuo">
    	<a href="weibo_list.php">第一步：选择需要发布的网站媒体</a>
    	<a href="weibo_add.php" class="online">第二步：添加并提交软文稿件内容</a>
    	<a href="weibo_admin.php">第三步：查看软文发布进度结果</a>
    </div>
<?php if ($userMoney<$z_price) :?>
	<div class="tishibox"><strong>* 当前可用余额不足支付<?php echo $z_price?>元,将无法成功发布稿件 <a href="alipay.php">请为您的账号充值</a></strong></div>
<?php endif ;?> 
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td width="120" height="40"><p class="mc">所选媒体</p></td>
        <td><p class="mc"><?php echo $cartBoxHtml?> <a href="weibo_list.php">返回重新选择</a></p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">活动标题<em>*必填
</em></p></td>
        <td><p class="mc"><input name="title" type="text" size="80" maxlength="28" />
        （为你的推广活动去一个好记的名字，方便你日后查询）</p></td>
      </tr>
      <tr>
        <td height="450"><p class="mc">直转发内容<em>*必填</em></p></td>
        <td>
        <p class="mc"><textarea name="content" class="editor_content" id="content"></textarea>
        </p>
        <p class="mc pt10">可以此处填写转发链接、转发语及直发内容和上传直发图片</p>        </td>
      </tr>
      
      <tr>
        <td height="130"><p class="mc">附言<em>*必填</em></p></td>
        <td><p class="mc">
          <textarea name="beizhu" cols="110" rows="6" id="beizhu"></textarea>
        </p>
            <p class="mc pt10"><em>提示必看：</em>给博主留言说明要求
            </p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">完成时间<em>*必填</em></p></td>
        <td><p class="mc">
          <input name="wangzhi" type="radio" id="radio" value="1"  />
          一天内完成
           <input type="radio" name="wangzhi" id="radio" value="2" checked="checked" />
          两天内完成（推荐）
          <input type="radio" name="wangzhi" id="radio" value="3" />
          三天内完成
          <input type="radio" name="wangzhi" id="radio" value="4" />
          一周内完成 
       </p></td>
      </tr>
     
    </table>
    <?php if ($userMoney<$z_price) :?>
    <div class="addSub"><span>当前余额不足，无法提交稿件</span></div>
    <?php else :?>
    <div class="addSub"><input type="submit" name="pn_post" value="立即提交稿件" /></div>
    <?php endif ;?>
  <!--main end-->
</div>
</form>
</body>
</html>
