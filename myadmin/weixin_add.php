<?php
require 'session.php';

if ($_GET['act']=='add') {
	$data['title']=$_POST['title']	;
	$data['px_id']=$_POST['px_id'];
	$data['admin_id']=$_POST['admin_id'];
	$data['addtime']=_nowtime();
	if ($data['title']=='') ShowMsg('错误：名称不能为空','-1');
	if (!is_numeric($data['px_id'])) ShowMsg('错误：排序ID只能是数字','-1');
	_insert('weixin',$data);
	ShowMsg('成功：微信添加成功','weixin_add.php');

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>添加友情链接</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>微信 &gt; 微信管理 &gt; 添加微信</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=add">
    <dl>
      <dt><em>微信名称：</em>
        <input name="title" type="text" id="title" size="40" />
      </dt>
      <dt><em>子管理员：</em>
        <select name="admin_id" id="admin_id">
        <option value="0">未指定</option>
<?php
$_result=_query("SELECT * FROM admin WHERE lv=2 ORDER BY id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
          <option value="<?php echo $rs_sort['id']?>"><?php echo $rs_sort['adminname']?></option>
<?php 
}
?>
        </select>
      </dt>
      <dt><em>排序ID：</em>
        <input name="px_id" type="text" id="px_id" value="1" size="10" />
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