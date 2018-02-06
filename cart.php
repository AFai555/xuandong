<?php
require 'session2.php';

//加入购物车
$arr['s']=0;

if ($_SESSION['userid']<=0) {
	exit(json_encode($arr));
}

$id=intval($_GET['id']);
if($id>0){
	if (!$row=_get_one('meiti_case',$_GET['id'])){
		exit(json_encode($arr));
	}
	if (_get_one_tj('cart',"pid={$_GET['id']} AND uid={$_SESSION['userid']} AND zt=0")){
		
		
	}else{
		$data['bianhao']=time();
		$data['pid']=$_GET['id'];
		$data['uid']=$_SESSION['userid'];
		$data['referee']=$_SESSION['referee'];
		$data['price']=$row['price'];
		_insert('cart',$data);
	}
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

