<?php
require 'session.php';

if ($_GET['act']=='xiugai') {
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['title']=$_POST['title']	;
	$data['px_id']=$_POST['px_id'];
	$data['admin_id']=$_POST['admin_id'];
	$data['addtime']=_nowtime();
	if ($data['title']=='') ShowMsg('错误：名称不能为空','-1');
	if (!is_numeric($data['px_id'])) ShowMsg('错误：排序ID只能是数字','-1');
	_update('meiti',$data,$id);
	ShowMsg('成功：媒体修改成功',$PreviousUrl);

}

$row=_get_one('meiti',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>修改媒体</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>媒体 &gt; 媒体管理 &gt; 修改媒体</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=xiugai">
    <input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
    <input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      <dt><em>媒体名称：</em>
        <input name="title" type="text" id="title" size="40" value="<?php echo $row['title']?>" />
      </dt>
      <dt><em>子管理员：</em>
        <select name="admin_id" id="admin_id">
        <option value="0" <?php _xiala(0,$row['admin_id'])?>>未指定</option>
<?php
$_result=_query("SELECT * FROM admin WHERE lv=2 ORDER BY id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
          <option value="<?php echo $rs_sort['id']?>" <?php _xiala($rs_sort['id'],$row['admin_id'])?>><?php echo $rs_sort['adminname']?></option>
<?php 
}
?>
        </select>
      </dt>
      <dt><em>排序ID：</em>
        <input name="px_id" type="text" id="px_id" size="10" value="<?php echo $row['px_id']?>" />
        <span class="textinput">排序ID只能是数字</span></dt>
      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>