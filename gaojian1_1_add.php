<?php
require 'session.php';

//购物车内容
function cartBox(){
	$_result=_query("SELECT * FROM cart WHERE uid={$_SESSION['userid']} AND zt=0");
	global $z_price;
	$z_price=0;
	while (!!$row=_mysql_list($_result)) {
		$r_html.=getDbName('meiti_case','title',$row['pid']).'<em>'.$row['price'].'</em>元 ';
		$z_price+=$row['price'];
	}
	$r_html.='总计<em><strong>'.$z_price.'</strong></em>元 ';
	return $r_html;
}
$cartBoxHtml=cartBox();
$row=_get_one('cart',$_GET['id']);
if ($_POST['pn_post']=='立即提交稿件'){
	$data['title']=$_POST['title'];
	$data['content']=getcontent($_POST['content']);
	$data['beizhu']=$_POST['beizhu'];
	$data['wangzhi']=$_POST['wangzhi'];
	$data['jiegao']=$_POST['jiegao'];
	$data['zt']=1;
	$data['baoimg']='index.php';
	$data['addtime']=_nowtime();
	$data['fangshi']=2;
	
	if ($data['title']=='') ShowMsg('错误：稿件标题不能为空！','-1');
	if ($data['content']=='') ShowMsg('错误：稿件内容不能为空！','-1');
	if (strlen(strip_tags($data['content']))>30000) {
		ShowMsg('错误：稿件内容字数不能超过1万字！','-1');
	}
	if (strlen(strip_tags($data['beizhu']))>600) {
		ShowMsg('错误：附言字数不能超过200字！','-1');
	}
	_update_tj('cart',$data,"uid={$_SESSION['userid']} AND zt=0");
	_query("UPDATE member SET money=money-{$z_price} WHERE id='{$_SESSION['userid']}'");
	
	$data2['uid']=$_SESSION['userid'];
	$data2['money']=$z_price;
	$data2['lx']=2;
	$data2['beizhu']='稿件"'.$data['title'].'"支出';
	$data2['addtime']=_nowtime();
	_insert('caiwu',$data2);
	
	ShowMsg('成功：您的稿件已提交成功，金额变化-'.$z_price.'元！','gaojian_admin.php');
}

if (!_get_one_tj('cart',"uid={$_SESSION['userid']} AND zt=0")) ShowMsg('提示：您还没有选择需要发布稿件的媒体！','-1');

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
  <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 提交软文稿件内容</div>
    <?php require 'user_top_tp.php'?>
<?php require 'user_top_gg.php'?>
<?php require 'user_top.php'?>
<?php if ($userMoney<$z_price) :?>
	<div class="tishibox"><strong>* 当前可用余额不足支付<?php echo $z_price?>元,将无法成功发布稿件 <a href="alipay.php">请为您的账号充值</a></strong></div>
<?php endif ;?> 
<div class="add_buzhuo">
    	<a href="gaojian_add.php" >方式一：创建新的软文</a>
    	<a href="gaojian1_add.php" class="online">方式二：从发布列表选择</a>
    	<a href="gaojian2_add.php">方式三：提交WORD文档稿件</a>
    	<a href="gaojian3_add.php">方式四：转载来源</a>
    </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td width="120" height="40"><p class="mc">所选媒体</p></td>
        <td><p class="mc"><?php echo $cartBoxHtml?></p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">文章标题<em>*必填
</em></p></td>
        <td><p class="mc"><input name="title" type="text" size="80" maxlength="28" value="<?php echo $row['title']?>"/>
        （标题字数应小于28个汉字）</p></td>
      </tr>
      <tr>
        <td height="450"><p class="mc">文章正文<em>*必填</em></p></td>
        <td>
        <p class="mc"><textarea name="content" class="editor_content" id="content"><?php echo $row['content']?></textarea>
        </p>
        <p class="mc pt10">友情提示:1.禁止负面、违法、政治敏感内容！2.发布后不可修改或删除！3.最好不要带网址，带网址有可能被拒稿且带图片不超三张</p>        </td>
      </tr>
      <!-- <tr>
        <td height="40"><p class="mc">频道调剂<em>*必读</em></p></td>
        <td bgcolor="#FFFFFF"><p>
            <input name="jiegao1" type="radio" id="radio21" value="1" checked="checked" />
            如因该频道未完成发布，允许管理员调剂其他类似频道完成发布
        。如不同意管理员调剂请在附言中写明<em><strong>“禁止调剂”</strong></em>。否则默认为同意。</p></td>
      </tr>
      <tr>
        <td height="270"><p class="mc">附言<em>*必填</em></p></td>
        <td><p class="mc">
          <textarea name="beizhu" cols="110" rows="6" id="beizhu"></textarea>
        </p>
            <p class="mc pt10"><em>提示必看：</em>亲们，为了减少沟通时间成本和不必要的纠纷，请在附言里注明以下几条说明<br />
              1、有些网站标题只能显示17个字，请提供一条17个字内的备用标题<br />
              2、有些网站不能带联系方式 如网址、 电话、QQ、二维码、微信号等，有要求的，请一定要注明，没注明的视为无要求，编辑可以自主删除或保留<br />
              3、有些网站编辑看稿是否给安排入口，如果有入口要求的，请一定要注明，没注明的视为无要求<br />
              4、没要求的，可填写无要求<br />
            </p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">网址强调<em>*必填</em></p></td>
        <td><p class="mc">
          <input name="wangzhi" type="radio" id="radio" value="1" checked="checked" />
          稿件里网址不带都无所谓（推荐）
           <input type="radio" name="wangzhi" id="radio" value="2" />
          稿件里网址一定要带上，否则不发
          <input type="radio" name="wangzhi" id="radio" value="3" />
          稿件里关键字超链一定要带上，否则不发 
       </p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">截稿时间<em>*必填</em></p></td>
        <td><p class="mc">
          <input name="jiegao" type="radio" id="radio2" value="1" checked="checked" />
          因编辑原因当天未完成发布，隔天也可以等（推荐）
  <input type="radio" name="jiegao" id="radio2" value="2" />
        当天要完成发布，超时就撤消稿件 </p></td>
      </tr> -->
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
