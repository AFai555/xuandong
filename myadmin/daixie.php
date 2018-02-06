<?php 
require 'session.php';

if ($_GET['act']=='ju' && isset($_GET['id'])) {
	if (!$row=_get_one('daixie',$_GET['id'])) ShowMsg('错误：该需求不存在','-1');
	$data['zt']=1;
	_update('daixie',$data,$_GET['id']);
	_query("UPDATE member SET money=money+{$row['price']} WHERE id='{$row['uid']}'");

	$data2['uid']=$row['uid'];
	$data2['money']=$row['price'];
	$data2['lx']=3;
	$data2['beizhu']='拒写"'.$row['title'].'"还返';
	$data2['addtime']=_nowtime();
	_insert('caiwu',$data2);
	
	ShowMsg('成功：操作成功!',$_SERVER['HTTP_REFERER']);
}
if ($_GET['act']=='ok' && isset($_GET['id'])) {
	$data['zt']=0;
	_update('daixie',$data,$_GET['id']);
	ShowMsg('成功：操作成功!',$_SERVER['HTTP_REFERER']);
}

function daixie_get_num($pid){
	$sql = "SELECT id FROM daixie_get WHERE pid={$pid}";
	return mysql_num_rows(_query($sql));
}

$sql_search="";
if ($_GET['keyword']!=''){
	$sql_search.=" AND title like '%{$_GET['keyword']}%'";
}
if ($_GET['uid']!=''){
	$sql_search.=" AND uid={$_GET['uid']}";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>代写需求</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>需求 &gt; 代写需求</div>
<div class="adminbox">
  <form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="10%" height="32" align="center">需求编号</td>
      <td align="center">需求标题</td>
      <td width="10%" align="center">代写篇数</td>
      <td width="10%" align="center">代写费用</td>
      <td width="10%" align="center">已交稿篇数</td>
      <td width="14%" align="center">创建时间</td>
      <td width="15%" align="center">操 作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$sql="SELECT * FROM daixie WHERE 1=1".$sql_search."  ORDER BY id DESC";
_page($sql,20);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
    <tr>
      <td width="10%" height="35" align="center" class="pxid"><?php echo $row['bianhao']?></td>
      <td align="center"><?php echo $row['title']?></td>
      <td width="10%" align="center"><?php echo $row['num']?>篇</td>
      <td width="10%" align="center"><strong><?php echo $row['price']?>元</strong></td>
      <td width="10%" align="center"><strong style="color:#FF0000"><?php if ($row['zt']==0) :?><?php echo daixie_get_num($row['id'])?>篇 <a href="daixie_get_see.php?id=<?php echo $row['id']?>">[查看]</a><?php else :?>拒写<?php endif ;?></strong></td>
      <td width="14%" align="center"><?php echo $row['addtime']?></td>
      <td width="15%" align="center"><a href="daixie_see.php?id=<?php echo $row['id']?>">[查看]</a> <?php if ($row['zt']==0) :?><a href="daixie_get.php?id=<?php echo $row['id']?>">[交稿]</a> <a href="?act=ju&id=<?php echo $row['id']?>">[拒写]</a><?php else :?> <?php endif ;?></td>
    </tr>
<?php }?> 
  </table>
</form>
<div class="lipage"><?php echo _pageshow(2)?></div>
<div id="menu" style="margin-top:10px;">
<form action="daixie.php" method="get" name="form2" id="form2">
<div class="search"><input type="text" name="keyword" class="ip" value="请输入关键字" /><input type="submit" class="sbnt" value="查询" /></div>
</form>
</div>
</div>
</body>
</html>