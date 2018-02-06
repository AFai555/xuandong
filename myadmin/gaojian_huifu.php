<?php 

require 'session.php';


function cart_zt($str){
	if ($str==1){
		return '<p style="color:#0000FF;">待收稿</p>';
	}elseif ($str==2){
		return '<p style="color:#FF0000;">已收稿</p>';
	}elseif ($str==3){
		return '已发布';
	}elseif ($str==4){
		return '<strong>已拒稿</strong>';
	}else{
		return '未发布';
	}
}
function cart_case($pid){
	$row=_get_one('meiti_case',$pid);
	return '<a href="'.$row['link'].'" target="_blank">'.$row['title'].'</a> <a href="'.$row['case_url'].'" target="_blank">[案例]</a>';
}

$sql_search=" AND id={$_GET['id']}";
$listnum=$_GET['listnum'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>稿件管理</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/function.js"></script>
<script type="text/javascript" src="../js/calendar.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>稿件 &gt; 稿件管理</div>

  <form id="form1" name="form1" method="post">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCE0F6" class="newstitletable">
    <tr>
      <td width="10%" height="32" align="center">订单编号</td>
      <td align="center">文章标题</td>
      <td width="15%" align="center">发布网站频道</td>
      <td width="8%" align="center">成本</td>
      <td width="8%" align="center">费用</td>
      <td width="10%" align="center">发布状态</td>
      <td width="14%" align="center">添加时间</td>
      <td width="8%" align="center">操 作</td>
    </tr>
  </table>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE" class="newslitable">
<?php
$z_price=0;
$z_cb_price=0;
$sql="SELECT * FROM cart WHERE zt>0".$sql_search." ORDER BY id DESC";
_page($sql,$listnum);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
if ($row['zt']<4){
$z_price+=$row['price'];
$z_cb_price+=getDbName('meiti_case','cb_price',$row['pid']);
}
?>
    <tr>
      <td width="10%" height="35" align="center" class="pxid"><?php echo $row['bianhao']?></td>
      <td align="center"><?php echo $row['title']?></td>
      <td width="15%" align="center"><?php echo cart_case($row['pid'])?></td>
      <td width="8%" align="center"><strong style="color:#FF0000;"><?php echo getDbName('meiti_case','cb_price',$row['pid'])?>元</strong></td>
      <td width="8%" align="center"><strong><?php echo $row['price']?>元</strong></td>
      <td width="10%" align="center"><?php echo cart_zt($row['zt'])?></td>
      <td width="14%" align="center"><?php echo $row['addtime']?></td>
      <td width="8%" align="center"><a href="gaojian_see.php?id=<?php echo $row['id']?>">[查看]</a><a href="tongzhi_add.php?id=<?php echo $row['id']?>">[回复]</a></td>
    </tr>
<?php }?> 
  </table>
</form>

</body>
</html>