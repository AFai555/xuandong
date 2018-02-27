<?php 
require 'session.php';

if ($_GET['act']=='xiugai') {
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['title']=$_POST['title']	;
	$data['link']=$_POST['link'];
	$data['case_url']=$_POST['case_url'];
	$data['mid']=$_POST['mid'];
/*	$data['diquid']=$_POST['diqu'];*/
/*	$data['cb_price']=$_POST['cb_price'];*/
	$data['price']=$_POST['price'];
/*	$data['lianjie']=$_POST['lianjie'];*/
/*	$data['shoulu']=$_POST['shoulu'];*/
/*	$data['beizhu']=$_POST['beizhu'];*/
/*	$data['qq']=$_POST['qq'];*/
/*	$data['tel']=$_POST['tel'];*/
	$data['addtime']=_nowtime();
/*	$data['hide']=$_POST['hide'];*/
/*	$data['isbao']=$_POST['bao'];*/

	if ($data['title']=='') ShowMsg('错误：频道名称不能为空','-1');
/*	if (!is_numeric($data['cb_price'])) ShowMsg('错误：价格只能是数字','-1');*/
	if (!is_numeric($data['price'])) ShowMsg('错误：价格只能是数字','-1');
	
  //var_dump($_POST);
	_update('meiti_case',$data,$id);
	ShowMsg('成功：案例修改成功，继续添加',$PreviousUrl);
}
if ($_GET['id']) {
  # code...
  $row=_get_one('meiti_case',$_GET['id']);
} else if($_POST['id']) {
  $row=_get_one('meiti_case',$_POST['id']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>添加案例</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>媒体 &gt; 案例管理 &gt; 修改案例</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=xiugai">
    <input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
    <input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      <dt><em>媒体频道：</em>
        <input name="title" type="text" id="title" value="<?php echo $row['title']?>" size="50" />
      </dt>
      <dt><em>频道链接：</em>
        <input name="link" type="text" id="link" value="<?php echo $row['link']?>" size="50" />
      </dt>
      <dt><em>案例链接：</em>
        <input name="case_url" type="text" id="case_url" value="<?php echo $row['case_url']?>" size="50" />
      </dt>
      <dt><em>媒体分类：</em>
        <select name="mid" id="mid">
<?php
$_result=_query("SELECT * FROM meiti ORDER BY px_id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
          <option value="<?php echo $rs_sort['id']?>" <?php _xiala($rs_sort['id'],$row['mid'])?>><?php echo $rs_sort['title']?></option>
<?php 
}
?>
        </select>

      </dt>
      
      <dt><em>成本价格：</em>
        <input name="price" type="text" id="price" size="10" value="<?php echo $row['price']?>" />
      <span class="textinput">价格只能是数字</span></dt>

      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>