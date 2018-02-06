<?php 
require 'session2.php';
if ($_GET['act']=='add') {
	$data['title']=$_POST['title'];
	$data['link']=$_POST['link'];
	$data['case_url']=$_POST['case_url'];
	$data['mid']=$_POST['mid'];
	$data['diquid']=$_POST['diqu'];
	$data['price']=0;
	$data['cb_price']=$_POST['cb_price'];
	$data['lianjie']=$_POST['lianjie'];
	$data['shoulu']=$_POST['shoulu'];
	$data['beizhu']=$_POST['beizhu'];
	$data['qq']=$_POST['qq'];
	$data['tel']=$_POST['tel'];
	$data['addtime']=_nowtime();	
	$data['hide']=1;
	$data['isbao']=$_POST['bao'];
	$data['memid']=$_SESSION['userid'];
	
	if ($data['title']=='') ShowMsg('错误：频道名称不能为空','-1');
	if ($data['link']=='') ShowMsg('错误：频道链接不能为空','-1');
	if ($data['case_url']=='') ShowMsg('错误：案例链接不能为空','-1');
	if ($data['cb_price']=='') ShowMsg('错误：合作报价不能为空','-1');
	if ($data['qq']=='') ShowMsg('错误：联系QQ不能为空','-1');
	if ($data['tel']=='') ShowMsg('错误：联系电话不能为空','-1');
	if (!is_numeric($data['cb_price'])) ShowMsg('错误：价格只能是数字','-1');
	
	_insert('meiti_case',$data);
	ShowMsg('成功：案例添加成功，等待审核中...','case_ad.php');
}
$row=_get_one('member',$_SESSION['userid']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>添加案例</title>
</head>

<body>
<div class="mainbox">

  <form  name="add" method="post" action="?act=add">
    <dl>
  
      <dt><em>媒体频道：</em>
        <input name="title" type="text" id="title" value="" size="50" />
        <span style="color:#F00">*</span>
      </dt>
      <dt><em>频道链接：</em>
        <input name="link" type="text" id="link" value="" size="50" />
         <span style="color:#F00">*</span>
      </dt>
      <dt><em>案例链接：</em>
        <input name="case_url" type="text" id="case_url" value="" size="50" />
         <span style="color:#F00">*</span>
      </dt>
      <dt><em>媒体分类：</em>
        <select name="mid" id="mid">
<?php
$_result=_query("SELECT * FROM meiti ORDER BY px_id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
          <option value="<?php echo $rs_sort['id']?>" <?php _xiala($rs_sort['id'],$mid)?>><?php echo $rs_sort['title']?></option>
<?php 
}
?>
        </select>  <span style="color:#F00">*</span> <span class="textinput">找不到分类直接联系在线客服添加</span>
      </dt>
       <dt><em>地区：</em>
        <select name="diqu" id="diqu">
<?php
$_result=_query("SELECT * FROM diqu ORDER BY px_id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
          <option value="<?php echo $rs_sort['id']?>" <?php _xiala($rs_sort['id'],$mid)?>><?php echo $rs_sort['title']?></option>
<?php 
}
?>
        </select>
      </dt>
      <dt><em>合作报价：</em>
        <input name="cb_price" type="text" id="cb_price" size="10" />
         <span style="color:#F00">*</span>
      <span class="textinput">报价低的优势资源更有可能被采用</span></dt>
      <dt><em>链接：</em>
        <input name="lianjie" type="radio"  value="1" checked="checked" class="danxuan" />
        只可以带文本网址
        <input type="radio" name="lianjie"  value="2" class="danxuan" />
      可以加入超链接 
      <input type="radio" name="lianjie"  value="3" class="danxuan" />
不可以添加任何链接 </dt>
      <dt><em>收录：</em>
        <input name="shoulu" type="radio"  value="1" checked="checked" class="danxuan" />
        新闻源收录
        <input type="radio" name="shoulu"  value="2" class="danxuan" />
      百度收录 
        <input type="radio" name="shoulu"  value="3" class="danxuan" />
有可能收录 </dt>
      <dt><em>联系QQ：</em>
        <input name="qq" type="text" id="qq" value="<?php echo $row['qq']?>" size="50" />
         <span style="color:#F00">*</span>
      </dt>
      <dt><em>联系电话：</em>
        <input name="tel" type="text" id="tel" value="<?php echo $row['tel']?>" size="50" />
         <span style="color:#F00">*</span>
      </dt>
      <dt><em>备注：</em>
        <input name="beizhu" type="text" id="beizhu" value="" size="50" />
      </dt>      
 <dt><em>是否包收录：</em>
         <input name="bao" type="radio"  value="0" checked="checked" class="danxuan" />
       不包收录
        <input type="radio" name="bao"  value="1" class="danxuan" />
      包收录
      </dt>
      <dt>
        <input type="submit" value="确认" class="lbnt" />
      </dt>
    </dl>
  </form>
  
    <dl>
  
      <dt><em>我提交的资源列表</em>
        <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="weblist">
  <tr>
    
    <th>媒体频道</th>
    <th width="12%">分类</th>
    <th width="6%">会员价</th>
    <th width="15%">链接[仅供参考]</th>
    <th width="10%">收录[仅供参考]</th>
    <th width="18%">备注</th>
    <th width="10%">审核</th>
  </tr>
  
<?php

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

$sql_seach=" WHERE memid = ".$_SESSION['userid'];
$sql="SELECT * FROM meiti_case".$sql_seach;
_page($sql,1000);
$sql=$sql." LIMIT $_pagenum,$_pagesize";
$_result=_query($sql);
while (!!$row=_mysql_list($_result)) {
?>
  <tr align="center">
    <td><?php if($row['case_url']=='') :?><?php echo $row['title']?><?php else :?><a href="<?php echo $row['link']?>" target="_blank"><?php echo $row['title']?></a><?php endif ;?>   <?php if($row['case_url']!='') :?><a href="<?php echo $row['case_url']?>" target="_blank">[案例] </a><?php endif ;?></td>
    <td><?php echo  getMeiti($row['mid'])?></td>
     <td><?php echo $row['cb_price']?>元</td>
    <td><?php echo lianjie_lx($row['lianjie'])?></td>
    <td><?php echo shoulu_lx($row['shoulu'])?></td>
    <td style="color:#F00"><?php echo $row['beizhu']?></td>
    <td style="color:#F00"> <?php  if ($row['hide'] ==1) echo '未审核';?><?php  if ($row['hide'] ==0) echo '审核通过';?></td>
  </tr>
 <?php }?>    
  
</table>
      
      </dt>
      </dl>
</div>
</body>
</html>