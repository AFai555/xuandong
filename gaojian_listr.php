<?php
require 'session2.php';
$vip=_mysql_show("SELECT * FROM vip WHERE id= 1");
if ($_SESSION['userid']) {
$price=_mysql_show("select  ( (SELECT if(sum( money) is null,0,sum(money)) FROM `caiwu` WHERE uid = ".$_SESSION['userid']." and lx = 2)-(SELECT if(sum( money) is null,0,sum(money)) FROM `caiwu` WHERE uid = ".$_SESSION['userid']." and lx = 3)) as price from member where  id = ".$_SESSION['userid']);
}
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
  if($vip['kd']=='1') {
   		  if($price['price'] > $vip['name1']){
          		   if($price['price'] > $vip['name2']) {
                      $data['price']=$row['price']*$vip['lv2'];
                    } else  {
                      $data['price']=$row['price']*$vip['lv1'];
                     }           
  		   } else  {
           $data['price']=$row['price'];
 		   } 
   
     } else {
     $data['price']=$row['price'];
      }   
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

//购物车内容
function cartBox(){
if ($_SESSION['userid']) {
	$r_html='已选择的媒体：';
	$_result=_query("SELECT * FROM cart WHERE uid={$_SESSION['userid']} AND zt=0");
	$z_price=0;
	while (!!$row=_mysql_list($_result)) {
		$r_html.=getDbName('meiti_case','title',$row['pid']).$row['price'].'元<a href="?act=cart_del&cid='.$row['id'].'">[X]</a> ';
		$z_price+=$row['price'];
	}
	$r_html.='总计'.$z_price.'元 ';
	$r_html.='<a href="?act=cart_all_del">【全部清空】</a> ';
	$r_html.='<a href="gaojian_add.php" class="addsub">下一步，提交稿件</a>';
}else{
	$r_html.='<a href="login.php" class="addsub">您还未登陆会员</a>';
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
	}else{
		return '未定义';
	}
}

$sql_seach="";
if ($_GET['mid']!='') {
	$sql_seach.=" AND mid={$_GET['mid']}";
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


$sql_seach=$sql_seach." ORDER BY id DESC";
$sql_seach=" WHERE isbao = 1 and hide = 0".$sql_seach;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻软文自助发布平台--<?php echo $config_name?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.scrollFollow.js"></script>
</head>

<body>
<div class="main">
  <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 选择发布媒体</div>
  <?php require 'user_top_tp.php'?>
<?php require 'user_top_gg.php'?>
<?php require 'user_top.php'?>
    <div class="add_buzhuo">
    	<a href="gaojian_list.php" class="online">第一步：选择需要发布的网站媒体</a>
    	<a href="gaojian_add.php">第二步：添加并提交软文稿件内容</a>
    	<a href="gaojian_admin.php">第三步：查看软文发布进度结果</a>
    </div>
    <div class="meitiBox">
    	<ul>
        	<li>媒体类型</li>
        	<li class="nostyle">---》</li>
<?php
$_result=_query("SELECT * FROM meiti ORDER BY px_id ASC");
while (!!$row=_mysql_list($_result)) {
?>
        	<li><a href="?mid=<?php echo $row['id']?>"><?php echo $row['title']?></a></li>
<?php }?>
        	<li><a href="gaojian_list.php">更多...</a></li>
        </ul>
        <div class="clear mb10"></div>
    	<ul>
        	<li>综合门户媒体</li>
        	<li class="nostyle">---》</li>
<?php
if (!empty($config_meiti)) {
	$arr_meiti=explode('、',$config_meiti);
	foreach ($arr_meiti as $value) {
?>
        	<li><a href="?title=<?php echo $value?>"><?php echo $value?></a></li>
<?php }}?>
	       	<li><a href="gaojian_list.php">更多...</a></li>
        </ul>
        <div class="clear mb10"></div>
    	<ul>
        	<li>价格分类媒体</li>
        	<li class="nostyle">---》</li>
        	<li><a href="?money=1">0-20元</a></li>
        	<li><a href="?money=2">20-50元</a></li>
        	<li><a href="?money=3">50-100元</a></li>
        	<li><a href="?money=4">100元以上</a></li>
        	<li><a href="gaojian_list.php">更多...</a></li>
        </ul>
        <div class="clear"></div>
  </div>
  <div class="meiti_search">
<form action="" method="get">
  	媒体分类
    <select name="mid">
    	<option value="">选择</option>
<?php
$_result=_query("SELECT * FROM meiti ORDER BY px_id ASC");
while (!!$row=_mysql_list($_result)) {
?>
        	<option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>
<?php }?>
    </select>
    链接
    <select name="lianjie">
    	<option value="">选择</option>
    	<option value="1">只可以带文本网址</option>
    	<option value="2">可以加入超链接</option>
    	<option value="3">不可以添加任何链接</option>
    </select>
    收录
    <select name="shoulu">
    	<option value="">选择</option>
    	<option value="1">新闻源收录</option>
    	<option value="2">网页收录</option>
    	<option value="3">有可能收录</option>
    </select>
    媒体名称
    <input type="text" name="title" />
    <input type="submit" value="搜索" class="sub" />
</form>
  </div>
  <div class="tishibox">
   <td width="353px" align="left"><div class="tishibox1">
  <table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="15%" align="left">
   <a href="gaojian_listr.php" ><img src="images/b2.jpg" name="Image1" border="0" id="Image1" /></a>
  </td>
    <td width="20%" align="left">
   <a href="gaojian_list.php" ><img src="images/sy1.jpg" name="Image1" border="0" id="Image1" /></a>
   </td>
  
   <td  width="65%" align="right">&nbsp;</td>
   </tr>
   </table>
   </div></td>
  </div>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="weblist">
  <tr>
    <th width="10%">发布稿件</th>
    <th>媒体频道</th>
    <th width="12%">分类</th>
    <th width="6%">会员价</th>
      <?php  if ($_SESSION['userid']) { ?>
     <?php if($vip['kd']=='1') {?>  
   		  <?php if($price['price'] > $vip['name1']) {?>
          		   <?php if($price['price'] > $vip['name2']) {?>
                   <th width="8%">高级会员价</th>
                   <?php } else  {?>
                   <th width="8%">普通会员价</th>
                    <?php }  ?>            
  		  <?php } else  {?>
           <th width="8%">注册会员价</th>
 		  <?php }  ?>  
   
    <?php } else {?>
     
     <?php } ?> 
     <?php } ?>  
    
    <th width="15%">链接[仅供参考]</th>
    <th width="10%">收录[仅供参考]</th>
    <th width="18%">备注</th>
  </tr>
<?php
$sql="SELECT * FROM meiti_case".$sql_seach;
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
  <tr>
    <td><a href="?act=buy&pid=<?php echo $row['id']?>" class="sub">加入购物车</a></td>
    <td><?php if($row['case_url']=='') :?><?php echo $row['title']?><?php else :?><a href="<?php echo $row['link']?>" target="_blank"><?php echo $row['title']?></a><?php endif ;?>   <?php if($row['case_url']!='') :?><a href="<?php echo $row['case_url']?>" target="_blank">[案例] </a><?php endif ;?></td>
    <td><a href="?mid=<?php echo $row['mid']?>"><?php echo  getMeiti($row['mid'])?></a></td>
       <?php  if ($_SESSION['userid']) { ?>
   <?php if($vip['kd']=='1') {?>   
     <td><p ><del><?php echo $row['price']?>元</del></p></td>

   		  <?php if($price['price'] > $vip['name1']) {?>
          		   <?php if($price['price'] > $vip['name2']) {?>
                   <td><p class="price"><?php echo $row['price']* $vip['lv2'] ?>元</p></td>
                   <?php } else  {?>
                   <td><p class="price"><?php echo $row['price']* $vip['lv1'] ?>元</p></td>
                    <?php }  ?>            
  		  <?php } else  {?>
            <td><p class="price"><?php echo $row['price'] ?>元</p></td>
 		  <?php }  ?>  
   
    <?php } else {?>
      <td><p class="price"><?php echo $row['price']?>元</p></td>
     <?php } ?> 
      <?php } else {?>  
            <td><p class="price"><?php echo $row['price']?>元</p></td>
              <?php } ?>  
    <td><?php echo lianjie_lx($row['lianjie'])?></td>
    <td><?php echo shoulu_lx($row['shoulu'])?></td>
    <td><p class="beizhu"><?php echo $row['beizhu']?></p></td>
  </tr>
 <?php }?>  
  <tr>
    <td colspan="7" style="height:40px; line-height:40px;"><?php echo _pageshow(2)?></td>
    </tr>
</table>

<div style=" height:60px; clear:both; "><a  style="color:#3E5F9B;" href="/exp.php?mid=<?php echo $_GET['mid'];?>&lianjie=<?php echo $_GET['lianjie'];?>&money=<?php echo $_GET['money'];?>&title=<?php echo $_GET['title'];?>&shoulu=<?php echo $_GET['shoulu'];?>" target="_blank">下载此分类报价表</a></div>

<div style=" height:60px; clear:both;"></div>
<div class="cartbox"><p><?php echo cartBox()?></p>
</div>
</div>
</body>
</html>
