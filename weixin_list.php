<?php
require 'session2.php';
$vip=_mysql_show("SELECT * FROM vip WHERE id= 1");
if ($_SESSION['userid']) {
$price=_mysql_show("select  ( (SELECT if(sum( money) is null,0,sum(money)) FROM `caiwu` WHERE uid = ".$_SESSION['userid']." and lx = 2)-(SELECT if(sum( money) is null,0,sum(money)) FROM `caiwu` WHERE uid = ".$_SESSION['userid']." and lx = 3)) as price from member where  id = ".$_SESSION['userid']);
}else{
			
}
//加入购物车
if ($_GET['act']=='buy' && isset($_GET['pid'])){
require 'session3.php';
	if (!$row=_get_one('weixin_case',$_GET['pid'])){
		ShowMsg('错误：该媒体频道不存在！','-1');
	}
	if (_get_one_tj('wxcart',"pid={$_GET['pid']} AND uid={$_SESSION['userid']} AND zt=0")){
		ShowMsg('提示：该媒体频道已被加入购物车，无须重复添加！','-1');
	}
	$data['bianhao']=time();
	$data['pid']=$_GET['pid'];
	$data['wangzhi']=0;
	$data['jiegao']=0;
	$data['get_admin']=0;
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
	   
	_insert('wxcart',$data);
	_location(NULL,$_SERVER['HTTP_REFERER']);

}

//删除购物车媒体
if ($_GET['act']=='wxcart_del' && isset($_GET['cid'])){
	if (!$row=_get_one_tj('wxcart',"id={$_GET['cid']} AND uid={$_SESSION['userid']} AND zt=0")){
		ShowMsg('错误：购物车中没有该商品！','-1');
	}
	_delete('wxcart',$_GET['cid']);
	_location(NULL,$_SERVER['HTTP_REFERER']);
}

//清空购物车
if ($_GET['act']=='wxcart_all_del'){
	_delete_tj('wxcart',"uid={$_SESSION['userid']} AND zt=0");
	_location(NULL,$_SERVER['HTTP_REFERER']);
}

//购物车内容
function cartBox(){
if ($_SESSION['userid']) {
	$r_html='已选择的媒体：';
	$_result=_query("SELECT * FROM wxcart WHERE uid={$_SESSION['userid']} AND zt=0");
	$z_price=0;
	while (!!$row=_mysql_list($_result)) {
		$r_html.=getDbName('weixin_case','title',$row['pid']).$row['price'].'元<a href="?act=wxcart_del&cid='.$row['id'].'">[删]</a> ';
		$z_price+=$row['price'];
	}
	$r_html.='总计'.$z_price.'元 ';
	$r_html.='<a href="?act=wxcart_all_del">【全部清空】</a> ';
	$r_html.='<a href="weixin_add.php" class="addsub">下一步，提交稿件</a>';
}else{
	$r_html.='<a href="login.php"  target="_blank"  class="addsub">您还未登陆会员</a>';
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
if ($_GET['shoulu1']!='') {
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
if ($_GET['isbao']!='') {
	if ($_GET['isbao']==1){
		$sql_seach.=" AND isbao BETWEEN 0 and 5";
	}elseif ($_GET['isbao']==2){
		$sql_seach.=" AND isbao BETWEEN 5 and 10";
	}elseif ($_GET['isbao']==3){
		$sql_seach.=" AND isbao BETWEEN 10 and 50";
	}elseif ($_GET['isbao']==4){
		$sql_seach.=" AND isbao BETWEEN 50 and 100";
	}elseif ($_GET['isbao']==5){
		$sql_seach.=" AND isbao BETWEEN 100 and 300";
	}elseif ($_GET['isbao']==6){
		$sql_seach.=" AND isbao BETWEEN 300 and 500";
	}elseif ($_GET['isbao']==7){
		$sql_seach.=" AND isbao>500";
	}
}


$sql_seach=$sql_seach." ORDER BY price {$_GET['shoulu']}";
$sql_seach=" WHERE hide = 0".$sql_seach;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $config_title?>-<?php echo $config_name?></title>
<meta name="description" content="<?php echo $config_dis?>">
<meta name="keywords" content="<?php echo $config_title?>">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.scrollFollow.js"></script>




</head>

<body>
<div class="main">
  <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 选择发布微信</div>
  <?php require 'user_top_tp.php'?>
<?php require 'user_top_gg.php'?>
<?php require 'user_top.php'?>
    <div class="add_buzhuo">
    	<a href="weixin_list.php" class="online">第一步：选择需要发布的网站微信</a>
    	<a href="weixin_add.php">第二步：添加并提交软文稿件内容</a>
    	<a href="weixin_admin.php">第三步：查看软文发布进度结果</a>
    </div>
    <div class="meitiBox">
    	<ul>
        	<li>微信类型</li>
        	<li class="nostyle">---》</li>
<?php
$_result=_query("SELECT * FROM weixin ORDER BY px_id ASC");
while (!!$row=_mysql_list($_result)) {
?>
        	<li><a href="?mid=<?php echo $row['id']?>"><?php echo $row['title']?></a></li>
<?php }?>
        	<li><a href="weixin_list.php">更多...</a></li>
        </ul>
        <div class="clear mb10"></div>
    	
        <div class="clear mb10"></div>
    	<ul>
        	<li>价格分类</li>
        	<li class="nostyle">---》</li>
        	<li><a href="?money=1">0-20元</a></li>
        	<li><a href="?money=2">20-50元</a></li>
        	<li><a href="?money=3">50-100元</a></li>
        	<li><a href="?money=4">100元以上</a></li>
        	<li><a href="weixin_list.php">更多...</a></li>
        </ul>
           <div class="clear mb10"></div>
   
        <div class="clear"></div>
  </div>
  <div class="meiti_search" style="position:relative;>
<form action="" method="get">
  	微信分类
    <select name="mid">
    	<option value="">选择</option>
<?php
$_result=_query("SELECT * FROM weixin ORDER BY px_id ASC");
while (!!$row=_mysql_list($_result)) {
?>
        	<option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>
<?php }?>
    </select>
   <!--  链接
    <select name="lianjie">
    	<option value="">选择</option>
    	<option value="1">只可以带文本网址</option>
    	<option value="2">可以加入超链接</option>
    	<option value="3">不可以添加任何链接</option>
    </select>-->
    价格排序
   <select name="shoulu">
    	<option value="asc">按价格从低到高</option>
    	<option value="desc">按价格从高到低</option>
    </select>
    
    微信名称
    <input type="text" name="title" />
    <input type="submit" value="搜索" class="sub" />
</form>
<div style="position:absolute; top:0px; right:1px"></div>
  </div>
  
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="weblist">
  <tr>
    <th width="10%">发布稿件</th>
    <th>微信频道</th>
    <th width="7%">类型</th>
    <th width="7%">粉丝量</th>
    <th width="10%">分类</th>
    <th width="8%">会员价</th>
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
    <th width="22%">备注</th>
  </tr>
<?php
$sql="SELECT * FROM weixin_case".$sql_seach;
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
  <tr>
    <td><a href="?act=buy&pid=<?php echo $row['id']?>" class="sub">加入购物车</a></td>
    <td><?php if($row['case_url']=='') :?><?php echo $row['title']?>【<?php echo $row['isbao']?>】<?php else :?><a href="<?php echo $row['link']?>" target="_blank"><?php echo $row['title']?></a><?php endif ;?>   <?php if($row['case_url']!='') :?><?php endif ;?></td>
      <td><?php if($row['leix']=='1') :?>订阅号<?php else :?>服务号<?php endif ;?></td>
      <td><?php echo $row['fas']?>万</td>
      <td><a href="?mid=<?php echo $row['mid']?>"><?php echo  getweixin($row['mid'])?></a></td>
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
    <td><p class="beizhu"><?php echo $row['beizhu']?></p></td>
  </tr>
 <?php }?>  
  <tr>
    <td colspan="8" style="height:40px; line-height:40px;"><?php echo _pageshow(2)?></td>
    </tr>
</table>
<div style=" height:60px; clear:both; "><a  style="color:#3E5F9B;" href="/weixinlist.xls" target="_blank">下载微信资源报价表</a></div>
<div style=" height:60px; clear:both;"></div>
<div class="cartbox"><p><?php echo cartBox()?></p>
</div>
</div>
<script src="http://s4.cnzz.com/stat.php?id=5192996&web_id=5192996" language="JavaScript"></script>
</body>
</html>
