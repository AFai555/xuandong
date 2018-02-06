<?php 
require 'session.php';
require '../include/encrypt.php';

if ($_GET['act']=='ju' && isset($_GET['id'])){
	if (!$row=_get_one_tj('wbcart',"id={$_GET['id']} AND (zt=1 or zt=2)")) ShowMsg('错误：该稿件不存在','-1');
	$data['zt']=4;
	_update('wbcart',$data,$_GET['id']);
	_query("UPDATE member SET money=money+{$row['price']} WHERE id='{$row['uid']}'");
	
	$data2['uid']=$row['uid'];
	$data2['money']=$row['price'];
	$data2['lx']=3;
	$data2['beizhu']='拒稿"'.$row['title'].'"还返';
	$data2['addtime']=_nowtime();
	_insert('caiwu',$data2);

	ShowMsg('成功：已拒稿成功',$_SERVER['HTTP_REFERER']);
}

if ($_POST['pn_post']=='提交网址' && isset($_POST['gid'])){
	if (!$row=_get_one('wbcart',$_POST['gid'])) ShowMsg('错误：该稿件不存在','-1');
	$g_zt=$row['zt'];
	$data['get_url']=$_POST['get_url'];
	$data['zt']=3;
	if ($data['get_url']=='') ShowMsg('错误：提交的网址不能为空','-1');
	$gid=$_POST['gid'];
	_update('wbcart',$data,$gid);
	
	if ($row['referee']>0 && $g_zt==2){
		_query("UPDATE member SET money=money+{$config_money} WHERE id='{$row['referee']}'");	
		$data2['uid']=$row['referee'];
		$data2['pid']=$gid;
		$data2['money']=$config_money;
		$data2['lx']=5;
		$data2['beizhu']='稿件"'.$row['title'].'"代理收益';
		$data2['addtime']=_nowtime();
		_insert('caiwu',$data2);
	}

	ShowMsg('成功：已成功提交发布网址！',$_SERVER['HTTP_REFERER']);
}


if ($_POST['pn_postx']=='确定修改频道' && isset($_POST['gidx'])){
	if (!$row=_get_one('wbcart',$_POST['gidx'])) ShowMsg('错误：该稿件不存在','-1');	
	
	$data['pid']=$_POST['pidx'];
    $data['price']=$_POST['jgx'];
	if ($data['pid']=='') ShowMsg('错误：频道ID不能为空','-1');
	if ($data['price']=='') ShowMsg('错误：会员价不能为空','-1');
	if (!is_numeric($data['pid'])) ShowMsg('错误：：频道ID只能是数字','-1');
	if (!is_numeric($data['price'])) ShowMsg('错误：价格只能是数字','-1');
	$gidx=$_POST['gidx'];
	_update('wbcart',$data,$gidx);
	ShowMsg('成功：已成修改频道！',$_SERVER['HTTP_REFERER']);
}

if ($_GET['act']=='shou' && isset($_GET['id'])){
	if (!$row=_get_one('wbcart',$_GET['id'])) ShowMsg('错误：该稿件不存在','-1');
	$data['zt']=2;
	_update('wbcart',$data,$_GET['id']);

	ShowMsg('成功：已收稿成功',$_SERVER['HTTP_REFERER']);
}

function cart_case($pid){
	$row=_get_one('weibo_case',$pid);
	$t_html = '<a href="'.$row['link'].'" target="_blank">'.$row['title'].'</a> <a href="'.$row['case_url'].'" target="_blank">[案例]</a> ';
	$t_html.='<a href="tencent://message/?uin='.$row['qq'].'"><img src="images/pa.gif" /></a> QQ:'.$row['qq'].' 电话：'.$row['tel'];
	return $t_html;
}

function cart_zt($str){
	if ($str==1){
		return '待收稿';
	}elseif ($str==2){
		return '已收稿';
	}elseif ($str==3){
		return '已发布';
	}elseif ($str==4){
		return '已拒稿';
	}else{
		return '未发布';
	}
}

function cart_cz($zt,$id){
	if ($zt==1){
		return '【<a href="?act=shou&id='.$id.'">收稿</a>】 【<a href="?act=ju&id='.$id.'">拒稿</a>】';
	}elseif ($zt==2){
		return '【<a href="?act=ju&id='.$id.'">拒稿</a>】';
	}
}

function wz_lx($lx){
	if ($lx==1){
		return '一天内完成';
	}elseif ($lx==2){
		return '两天内完成（推荐）';
	}elseif ($lx==3){
		return '三天内完成';
	}elseif ($lx==4){
		return '一周内完成';
	}else{
		return '未定义';
	}
}
function jg_lx($lx){
	if ($lx==1){
		return '置顶（24小时）';
	}elseif ($lx==2){
		return '加精（一般一周或一个月）';
	}else{
		return '未定义';
	}
}

$row=_get_one('wbcart',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>查看稿件</title>
<script src="js/function.js" type="text/javascript"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>稿件 &gt; 稿件管理  &gt; 查看稿件</div>
<div class="adminbox">
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#EEEEEE">
    <tr>
      <td width="15%" height="35"><P class="see_con">文章标题</P></td>
      <td><p class="see_con"><span style="float:right;"><a href="/seewb.php?<?php echo encrypt($row['id'], 'E')?>" target="_blank">【查看链接】</a></span><strong><?php echo $row['title']?></strong></p></td>
    </tr>
    <tr>
      <td width="15%" height="35"><P class="see_con">发布状态</P></td>
      <td><p class="see_con"><span style="float:right;"><?php echo cart_cz($row['zt'],$row['id'])?></span><strong><?php echo cart_zt($row['zt'])?></strong></p></td>
    </tr>
<?php if ($row['zt']==2 || $row['zt']==3) :?>
    <tr>
      <td height="35"><p class="see_con">发布网址</p></td>
      <td><div class="see_con">
		<form name="p1" action="" method="post">
        	<input type="hidden" name="gid" value="<?php echo $row['id']?>" />
            <input type="text" name="get_url" value="<?php echo $row['get_url']?>" style="width:500px; height:30px; line-height:30px;" />
            <input type="submit" name="pn_post" value="提交网址" style=" padding:8px 30px;" />
        </form></div></td>
    </tr>
<?php endif ;?>
    <tr>
      <td height="35"><p class="see_con">发布网站频道</p></td>
      <td><p class="see_con"><?php echo cart_case($row['pid'])?></p>
    
      </td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">费用</p></td>
      <td><p class="see_con"><?php echo $row['price']?>元</p></td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">稿件内容</p></td>
      <td>
      <table width="98%" border="0"  align="center" cellpadding=0 cellspacing=1 bordercolor=#c9d3e9 style="margin-top:20px;margin-bottom:20px;border-collapse:collapse;table-layout:fixed;">
  <tr>
    <td style="overflow-x:hidden;overflow-y:hidden; word-wrap:break-word;">
       <p class="see_con" ><?php echo $row['content']?></p>
    </td>
  </tr>
</table>   
</td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">附言</p></td>
      <td><p class="see_con"><?php echo $row['beizhu']?></p></td>
    </tr>
    <tr>
      <td height="35"><p class="see_con">完成时间</p></td>
      <td><p class="see_con"><?php echo wz_lx($row['wangzhi'])?></p></td>
    </tr>

    <tr>
      <td height="35"><p class="see_con">添加时间</p></td>
      <td><p class="see_con"><?php echo $row['addtime']?></p></td>
    </tr>
  </table>
</div>
</body>
</html>
