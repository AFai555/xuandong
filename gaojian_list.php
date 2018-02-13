<?php
require 'session.php';
$vip=_mysql_show("SELECT * FROM vip WHERE id= 1");
if ($_SESSION['userid']) {
	$price=_mysql_show("select  ( (SELECT if(sum( money) is null,0,sum(money)) FROM `caiwu` WHERE uid = ".$_SESSION['userid']." and lx = 2)-(SELECT if(sum( money) is null,0,sum(money)) FROM `caiwu` WHERE uid = ".$_SESSION['userid']." and lx = 3)) as price from member where  id = ".$_SESSION['userid']);
}
/*
//加入购物车
if ($_GET['act']=='buy' && isset($_GET['pid'])){
require 'session3.php';
	if (!$row=_get_one('meiti_case',$_GET['pid'])){
		ShowMsg('错误：该媒体频道不存在！','-1');
	}
	if (_get_one_tj('cart',"pid={$_GET['pid']} AND uid={$_SESSION['userid']} AND zt=0")){
		ShowMsg('提示：该媒体频道已被加入购物车，无须重复添加！','-1');
	}
	$data['bianhao']=time();
	$data['pid']=$_GET['pid'];
	$data['uid']=$_SESSION['userid'];
	$data['referee']=$_SESSION['referee'];
	$data['price']=$row['price'];
	_insert('cart',$data);
	_location(NULL,$_SERVER['HTTP_REFERER']);
}

//删除购物车媒体
if ($_GET['act']=='cart_del' && isset($_GET['cid'])){
	if (!$row=_get_one_tj('cart',"id={$_GET['cid']} AND uid={$_SESSION['userid']} AND zt=0")){
		ShowMsg('错误：购物车中没有该商品！','-1');
	}
	_delete('cart',$_GET['cid']);
	_location(NULL,$_SERVER['HTTP_REFERER']);
}

//清空购物车
if ($_GET['act']=='cart_all_del'){
	_delete_tj('cart',"uid={$_SESSION['userid']} AND zt=0");
	_location(NULL,$_SERVER['HTTP_REFERER']);
}
*/
//购物车内容
function cartBox(){
	if ($_SESSION['userid']) {
		$r_html='已选择的媒体：<span id="checkbox_select_website_list"></span>';
	}else{
		$r_html.='<a href="login.php" target="_blank" class="addsub">您还未登陆会员</a>';
	}
	return $r_html;
}

function lianjie_lx($str){
	if ($str==1){
		return '只可以带文本网址';
	}elseif ($str==2){
		return '可以加入超链接';
	}elseif ($str==3){
		return '不可以添加任何链接';
	}else{
		return '未定义';
	}
}

function shoulu_lx($str){
	if ($str==1){
		return '新闻源收录';
	}elseif ($str==2){
		return '网页收录';
	}elseif ($str==3){
		return '有可能收录';
	}elseif ($str==4){
		return '有可能收录';
	}else{
		return '未定义';
	}
}

$sql_seach="";
if ($_GET['mid']!='') {
	$sql_seach.=" AND mid={$_GET['mid']}";
}
if ($_GET['diqu']!='') {
	$sql_seach.=" AND diquid={$_GET['diqu']}";
}
if ($_GET['did']!='') {
	$sql_seach.=" AND did={$_GET['did']}";
}
if ($_GET['jqkf']!='') {
	$sql_seach.=" AND jqkf={$_GET['jqkf']}";
}
if ($_GET['lianjie']!='') {
	$sql_seach.=" AND lianjie={$_GET['lianjie']}";
}
if ($_GET['shoulu']!='') {
	$sql_seach.=" AND shoulu={$_GET['shoulu']}";
}
if ($_GET['title']!='') {
	$sql_seach.=" AND title like '%{$_GET['title']}%'";
}
if ($_GET['money']!='') {
	if ($_GET['money']==1){
		$sql_seach.=" AND price BETWEEN 0 and 20";
	}elseif ($_GET['money']==2){
		$sql_seach.=" AND price BETWEEN 20 and 50";
	}elseif ($_GET['money']==3){
		$sql_seach.=" AND price BETWEEN 50 and 100";
	}elseif ($_GET['money']==4){
		$sql_seach.=" AND price>100";
	}
}

// 引入gaojian_add.php 的部分内容
//购物车内容
function cartBox2(){
	$_result=_query("SELECT * FROM cart WHERE uid={$_SESSION['userid']} AND zt=0");
	global $z_price;
	$z_price=0;
	while (!!$row=_mysql_list($_result)) {
		$r_html.=getDbName('meiti_case','title',$row['pid']).'<em>'.$row['price'].'</em>元 ';

		if ($_SESSION['userid']) {
		 	if($vip['kd']=='1') { 
				if($_SESSION['user_grade']=="钻石会员") {
					$price=$row['price']+$vip['lv3'];				
				} else if($_SESSION['user_grade']=="高级会员") {
					$price=$row['price']+$vip['lv2'];
				} else {
					$price=$row['price']+$vip['lv1'];
				}
			}
		}	


		$z_price+=$price;
	}
	$r_html.='总计<em><strong>'.$z_price.'</strong></em>元 ';
	return $r_html;
}
$cartBoxHtml=cartBox2();

if ($_POST['pn_post']=='立即提交稿件'){
	$data['title']=$_POST['title'];
	$data['content']=getcontent($_POST['content']);
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


$sql_seach=$sql_seach." ORDER BY id DESC";
$sql_seach=" WHERE hide = 0".$sql_seach;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻软文自助发布平台--铭一传媒</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.scrollFollow.js"></script>
<script type="text/javascript" src="./myadmin/editor/kindeditor.js"></script>
<script type="text/javascript" src="./myadmin/editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./myadmin/editor/Alleditor.js"></script>

</head>

<body>
<div class="main">
  <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 选择发布媒体</div>
  <?php require 'user_top_tp.php'?>
<?php require 'user_top_gg.php'?>
<?php require 'user_top.php'?>
<?php if ($userMoney<$z_price) :?>
	<div class="tishibox"><strong>* 当前可用余额不足支付<?php echo $z_price?>元,将无法成功发布稿件 <a href="alipay.php">请为您的账号充值</a></strong></div>
<?php else :?>
	<div class="tishibox" style="display:none"></div>
<?php endif ;?>

    <div class="meitiBox">
	<?php
		$_result=_query("SELECT * FROM meiti ORDER BY px_id ASC");
		$_printBorder=_query("SELECT COUNT(*) FROM meiti");
		$_printBorder = $_printBorder - 1;
		$printNum = 0;
		while (!!$row=_mysql_list($_result)) {
		?>
			<div class="aBorder1">
				<ul>
					<div class="sortName"><?php echo $row['title']."："?></div>

					<div class="siteBox">
					<?php
						$sql="SELECT * FROM meiti_case WHERE mid=$row[id]";
						$_result2=_query($sql);
						while (!!$row2=_mysql_list($_result2)) {
					?>
						<!-- 在这个地方循环网站，<li>为循环体 -->
						<li>
							<div class="site">
							<input type="checkbox" name="checkbox_media_id" id="c_id_<?php echo $row2['id']?>" class="addcart" value="<?php echo $row2['id']?>" />
							<span>
								<?php if($row2['case_url']=='') :?>
									<?php echo $row2['title']?>
								<?php else :?>
									<a href="<?php echo $row2['link']?>" target="_blank"><?php echo $row2['title']?></a>
								<?php endif ;?>

								<!-- 输出价格 -->
								<?php  
								if ($_SESSION['userid']) {
								 	if($vip['kd']=='1') { 
										if($_SESSION['user_grade']=="钻石会员") {
											echo "<td><p ><del>".($row2['price']+ $vip['lv1'])."元</del></p></td>&ensp;";
											echo '<td><p class="price">'.($row2['price']+ $vip['lv3']).'元</p></td>';								
										} else if($_SESSION['user_grade']=="高级会员") {
											echo "<td><p ><del>".($row2['price']+ $vip['lv1'])."元</del></p></td>&ensp;";
											echo '<td><p class="price">'.($row2['price']+ $vip['lv2']).'元</p></td>';
										} else {
											echo '<td><p class="price">'.($row2['price']+ $vip['lv1']).'元</p></td>';
										}
									}
								}
								?>
							</span>
							</div>
						</li>
					<?php }?>
					</div>
				</ul>
				<div class="clear"></div>
				<?php
				if($printNum < $_printBorder ) {
					echo '<div class="aBorder2"></div>';
					$printNum++;
				}
				?>
			</div>
		<?php }?>
	</div>


<!-- <div class="tishibox">
  
   <td width="353px" align="left"><div class="tishibox1">
   <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="15%" align="left">
   <a href="gaojian_listr.php" ><img src="images/b1.jpg" name="Image1" border="0" id="Image1" /></a>
  </td>
    <td width="20%" align="left">
   <a href="gaojian_list.php" ><img src="images/sy2.jpg" name="Image1" border="0" id="Image1" /></a>
   </td>
  
   <td width="65%" align="right">&nbsp;</td>
   </tr>
   </table>
   </div></td>
  </div>
  -->

<form action="" method="post">
<div class="main" style="width: 100%;">
<div class="add_buzhuo">
    	<a href="gaojian_list.php" class="online">方式一：创建新的软文</a>
    	<a href="gaojian1_add.php" >方式二：从发布列表选择</a>
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
        <td><p class="mc"><input name="title" type="text" size="80" maxlength="28" />
        （标题字数应小于28个汉字）</p></td>
      </tr>
      <tr>
        <td height="450"><p class="mc">文章正文<em>*必填</em></p></td>
        <td>
        <p class="mc"><textarea name="content" class="editor_content" id="content"></textarea>
        </p>
        <p class="mc pt10">友情提示:1.禁止负面、违法、政治敏感内容！2.发布后不可修改或删除！3.最好不要带网址，带网址有可能被拒稿且带图片不超三张</p>        </td>
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


<div class="ie8 cartbox"><p><?php echo cartBox()?></p>
</div>

</div>



	<script type="text/javascript">
	
	var userMoney = <?php echo $userMoney?>;
	$(function(){

		__str='';
		
		$.getJSON('cart.php', function(json, textStatus) {

				if(json.s=="1"){

					$.each(json.arr,function(index, el) {

						__str=__str+el.name+' '+el.price+'元<a style="cursor:pointer;" onclick="cx(\''+el.id+'\')">[删]</a> ';

						$('#c_id_'+el.id).attr('checked', 'checked');

					});

					__str=__str+' 总计 '+json.zj+' 元 <a style="cursor:pointer;" onclick="cx(\'0\')">【全部清空】</a>';

					$("#checkbox_select_website_list").html(__str)

				}else{

					$("#checkbox_select_website_list").html('您还未选择媒体，将不能提交稿件')

				}

			});

	})

	$(".addcart").click(function(event) {
		
		if($(this).is(":checked")){
			/******************By Born*******************/
			var mc = '';
			/********************************************/
			
			__str='';

			$.getJSON('cart.php', {id: $(this).val()}, function(json, textStatus) {

				if(json.s=="1"){

					$.each(json.arr,function(index, el) {

						__str=__str+el.name+' '+el.price+'元<a style="cursor:pointer;" onclick="cx(\''+el.id+'\')">[删]</a> ';

						$('#c_id_'+el.id).attr('checked', 'checked');
						
						/******************By Born*******************/
						mc += el.name + '<em>' + el.price + '</em>元 ';
						/********************************************/

					});

					__str=__str+' 总计 '+json.zj+' 元 <a style="cursor:pointer;" onclick="cx(\'0\')">【全部清空】</a>';

					$("#checkbox_select_website_list").html(__str);
					
					/*****************By Born*********************/
					mc += '总计<em><strong>' + json.zj + '</strong></em>元 ';
					$(".mc")[1].innerHTML = mc;
					
					if(userMoney < json.zj){
						$('.tishibox')[2].innerHTML = '<strong>* 当前可用余额不足支付' + json.zj + '元,将无法成功发布稿件 <a href="alipay.php">请为您的账号充值</a></strong>';
						$('.tishibox')[2].style.display = 'block';
						$('.addSub')[0].innerHTML = '<div class="addSub"><span>当前余额不足，无法提交稿件</span></div>';
					}else{
						$('.tishibox')[2].innerHTML = '';
						$('.tishibox')[2].style.display = 'none';
						$('.addSub')[0].innerHTML = '<input type="submit" name="pn_post" value="立即提交稿件">';
					}
					/*********************************************/

				}else{

					$("#checkbox_select_website_list").html('您还未选择媒体，将不能提交稿件')

				}

			});

			

		}else{
			/******************By Born*******************/
			var mc = '';
			/********************************************/

			__str=''

			$.getJSON('cart_del.php', {id: $(this).val()}, function(json, textStatus) {

				if(json.s=="1"){

					$.each(json.arr,function(index, el) {

						__str=__str+el.name+' '+el.price+'元<a style="cursor:pointer;" onclick="cx(\''+el.id+'\')">[删]</a> ';

						$('#c_id_'+el.id).attr('checked', 'checked');
						
						/******************By Born*******************/
						mc += el.name + '<em>' + el.price + '</em>元 ';
						/********************************************/
					});

					__str=__str+' 总计 '+json.zj+' 元 <a style="cursor:pointer;" onclick="cx(\'0\')">【全部清空】</a>';
					
					$("#checkbox_select_website_list").html(__str);
					
					/*****************By Born*********************/
					mc += '总计<em><strong>' + json.zj + '</strong></em>元 ';
					$(".mc")[1].innerHTML = mc;
					
					if(userMoney < json.zj){
						$('.tishibox')[2].innerHTML = '<strong>* 当前可用余额不足支付' + json.zj + '元,将无法成功发布稿件 <a href="alipay.php">请为您的账号充值</a></strong>';
						$('.tishibox')[2].style.display = 'block';
						$('.addSub')[0].innerHTML = '<div class="addSub"><span>当前余额不足，无法提交稿件</span></div>';
					}else{
						$('.tishibox')[2].innerHTML = '';
						$('.tishibox')[2].style.display = 'none';
						$('.addSub')[0].innerHTML = '<input type="submit" name="pn_post" value="立即提交稿件">';
					}
					/*********************************************/

				}else{

					$("#checkbox_select_website_list").html('您还未选择媒体，将不能提交稿件')

				}

			});

		}
	});

	function cx(_s){
		/******************By Born*******************/
		var mc = '';
		/********************************************/

		__str=''

		$(".addcart").removeAttr('checked');

		$.getJSON('cart_del.php', {id: _s}, function(json, textStatus) {

			if(json.s=="1"){

				$.each(json.arr,function(index, el) {

					__str=__str+el.name+' '+el.price+'元<a style="cursor:pointer;" onclick="cx(\''+el.id+'\')">[删]</a> ';



					$('#c_id_'+el.id).attr('checked', 'checked');
					
					/******************By Born*******************/
					mc += el.name + '<em>' + el.price + '</em>元 ';
					/********************************************/
				});

				__str=__str+' 总计 '+json.zj+' 元 <a style="cursor:pointer;" onclick="cx(\'0\')">【全部清空】</a>';

				$("#checkbox_select_website_list").html(__str);
				
				/*****************By Born*********************/
				mc += '总计<em><strong>' + json.zj + '</strong></em>元 ';
				$(".mc")[1].innerHTML = mc;
				
				if(userMoney < json.zj){
					$('.tishibox')[2].innerHTML = '<strong>* 当前可用余额不足支付' + json.zj + '元,将无法成功发布稿件 <a href="alipay.php">请为您的账号充值</a></strong>';
					$('.tishibox')[2].style.display = 'block';
					$('.addSub')[0].innerHTML = '<div class="addSub"><span>当前余额不足，无法提交稿件</span></div>';
				}else{
					$('.tishibox')[2].innerHTML = '';
					$('.tishibox')[2].style.display = 'none';
					$('.addSub')[0].innerHTML = '<input type="submit" name="pn_post" value="立即提交稿件">';
				}
				/*********************************************/
			}else{
				$("#checkbox_select_website_list").html('您还未选择媒体，将不能提交稿件')
			}
		});
	}
</script>

</body>
</html>
