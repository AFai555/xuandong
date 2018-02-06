<?php
require 'session2.php';

//加入购物车
$arr['s']=0;

if ($_SESSION['userid']<=0) {
	exit(json_encode($arr));
}
$id=intval($_GET['id']);
if($id<=0){
	_delete_tj('cart',"uid={$_SESSION['userid']} AND zt=0");
}else{
	_delete_tj('cart',"uid={$_SESSION['userid']} AND zt=0 AND pid=".$id  );
}
$_result=_query("SELECT * FROM cart WHERE uid={$_SESSION['userid']} AND zt=0");
$z_price=0;
$list=array();
while (!!$row=_mysql_list($_result)) {
	$z_price+=$row['price'];
	
	$a['name']=getDbName('meiti_case','title',$row['pid']);
	$a['price']=$row['price'];
	$a['id']=$row['pid'];
	$list[]=$a;
}
$arr['s']=1;
$arr['zj']=$z_price;
$arr['arr']=$list;
exit(json_encode($arr));

