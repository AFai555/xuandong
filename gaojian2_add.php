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

if ($_POST['pn_post']=='立即提交稿件'){
	$data['title']=$_POST['title'];
	$data['content']=getcontent($_POST['content']);
	$data['beizhu']=$_POST['beizhu'];
	$data['wangzhi']=$_POST['wangzhi'];
	$data['jiegao']=$_POST['jiegao'];
	$data['zt']=1;
	$data['baoimg']='index.php';
	$data['addtime']=_nowtime();
	$data['fangshi']=3;
	
	if ($data['title']=='') ShowMsg('错误：稿件标题不能为空！','-1');
	if ($data['content']=='') ShowMsg('错误：稿件内容不能为空！','-1');
	if (strlen(strip_tags($data['content']))>30000) {
		ShowMsg('错误：稿件内容字数不能超过1万字！','-1');
	}
	if (strlen(strip_tags($data['beizhu']))>600) {
		ShowMsg('错误：附言字数不能超过200字！','-1');
	}
	if (!_get_one_tj('member',"id={$_SESSION['userid']} AND money>={$z_price}")) ShowMsg('提示：您的余额不足请充值！','-1');
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
if ($_GET['act']=='xiugai' && isset($_POST['id'])) {
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['content']=$_POST['url'];
	if ($data['content']=='') ShowMsg('错误：上传的文档不能为空！','-1');
	_update_tj('cart',$data,"uid={$_SESSION['userid']} AND zt=0");
	ShowMsg('文件上传成功！','gaojian2_2_add.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻软文自助发布平台</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="./myadmin/style/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./myadmin/editor/kindeditor.js"></script>
<script type="text/javascript" src="./myadmin/editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./myadmin/editor/Alleditor.js"></script>
<script type="text/javascript" src="./myadmin/editor/kindeditor-min.js"></script>
<script>
			KindEditor.ready(function(K) {
				var uploadbutton = K.uploadbutton({
					button : K('#uploadButton')[0],
					fieldName : 'imgFile',
					url : 'myadmin/editor/php/upload_json.php?dir=file',
					afterUpload : function(data) {
						if (data.error === 0) {
							var url = K.formatUrl(data.url, 'absolute');
							K('#url').val(url);
						} else {
							alert(data.message);
						}
					},
					afterError : function(str) {
						alert('自定义错误信息: ' + str);
					}
				});
				uploadbutton.fileBox.change(function(e) {
					uploadbutton.submit();
				});
			});
		</script>
</head>

<body>

<div class="main">
  <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 提交软文稿件内容</div>
    <?php require 'user_top_tp.php'?>
<?php require 'user_top_gg.php'?>
<?php require 'user_top.php'?>
   <div class="add_buzhuo">
    	<a href="gaojian_list.php">第一步：选择需要发布的网站媒体</a>
    	<a href="gaojian_add.php" class="online">第二步：添加并提交软文稿件内容</a>
    	<a href="gaojian_admin.php">第三步：查看软文发布进度结果</a>
    </div>

<?php if ($userMoney<$z_price) :?>
	<div class="tishibox"><strong>* 当前可用余额不足支付<?php echo $z_price?>元,将无法成功发布稿件 <a href="alipay.php">请为您的账号充值</a></strong></div>
<?php endif ;?> 
    <div class="add_buzhuo">
    	<a href="gaojian_add.php">方式一：创建新的软文</a>
    	<a href="gaojian1_add.php" >方式二：从发布列表选择</a>
    	<a href="gaojian2_add.php" class="online">方式三：提交WORD文档稿件</a>
    	<a href="gaojian3_add.php">方式四：转载来源</a>
    </div>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td width="140" height="40"><p class="mc">所选媒体</p></td>
        <td><p class="mc"><?php echo $cartBoxHtml?> <a href="gaojian_list.php">返回重新选择</a></p></td>
      </tr>
    
      <tr>
        <td height="40"><p class="mc">上传<em>Word</em>文档<em>*必填</em></p></td>
        <td>
         
         <div class="mainbox">
<form  name="add" method="post" action="?act=xiugai">
<input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
<input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
     
      <dt>
        <input name="url" id="url" size="60" class="up_pic_input" readonly="readonly"/>
        <input id="uploadButton" type="button"  class="up_pic_input" value="选择要上传的Word文档"/>    
      </dt>
      <dt>
        <input type="submit" value="确认上传" class="lbnt" />
    
        
      </dt>
    </dl>
  </form>
</div>
         </td>
      </tr>
    </table>
  
  <!--main end-->
</div>

</body>
</html>
