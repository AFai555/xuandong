<?php 
require 'session.php';

if ($_GET['act']=='add') {
	$data['title']=$_POST['title']	;
	$data['link']=$_POST['link'];
	$data['case_url']=$_POST['case_url'];
	$data['mid']=$_POST['mid'];
	// $data['diquid']=$_POST['diqu'];
/*	$data['cb_price']=$_POST['cb_price'];*/
	$data['price']=$_POST['price'];
	// $data['lianjie']=$_POST['lianjie'];
	// $data['shoulu']=$_POST['shoulu'];
	// $data['beizhu']=$_POST['beizhu'];
	// $data['qq']=$_POST['qq'];
	// $data['tel']=$_POST['tel'];
	// $data['addtime']=_nowtime();	
	// $data['hide']=$_POST['hide'];	
	// $data['isbao']=$_POST['bao'];
	
	if ($data['title']=='') ShowMsg('错误：频道名称不能为空','-1');
/*	if (!is_numeric($data['cb_price'])) ShowMsg('错误：价格只能是数字','-1');*/
	if (!is_numeric($data['price'])) ShowMsg('错误：价格只能是数字','-1');
	_insert('meiti_case',$data);
	ShowMsg('成功：案例添加成功，继续添加','case_add.php?mid='.$data['mid']);
}
$mid=$_GET['mid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>添加案例</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>媒体 &gt; 案例管理 &gt; 添加案例</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=add">
    <dl>
      <dt><em>媒体频道：</em>
        <input name="title" type="text" id="title" value="" size="50" />
      </dt>
      <dt><em>频道链接：</em>
        <input name="link" type="text" id="link" value="" size="50" />
      </dt>
      <dt><em>案例链接：</em>
        <input name="case_url" type="text" id="case_url" value="" size="50" />
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
        </select>
      </dt>

       <!-- <dt><em>地区：</em>
        <select name="diqu" id="diqu">
<php
$_result=_query("SELECT * FROM diqu ORDER BY px_id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
          <option value="<php echo $rs_sort['id']?>" <php _xiala($rs_sort['id'],$mid)?>><php echo $rs_sort['title']?></option>
<php 
}
?>
        </select>
      </dt> -->

<!--       <dt><em>成本价格：</em>
  <input name="cb_price" type="text" id="cb_price" size="10" />
<span class="textinput">价格只能是数字</span></dt> -->
      <dt><em>成本价格：</em>
        <input name="price" type="text" id="price" size="10" />
      <span class="textinput">价格只能是数字</span></dt>

      <!-- <dt><em>链接：</em>
        <input name="lianjie" type="radio"  value="1" checked="checked" class="danxuan" />
        只可以带文本网址
        <input type="radio" name="lianjie"  value="2" class="danxuan" />
      可以加入超链接 
      <input type="radio" name="lianjie"  value="3" class="danxuan" />
不可以添加任何链接 </dt> -->

      <!-- <dt><em>收录：</em>
        <input name="shoulu" type="radio"  value="1" checked="checked" class="danxuan" />
        新闻源收录
        <input type="radio" name="shoulu"  value="2" class="danxuan" />
      百度收录 
        <input type="radio" name="shoulu"  value="3" class="danxuan" />
有可能收录 </dt> -->

      <!-- <dt><em>媒体编辑QQ：</em>
        <input name="qq" type="text" id="qq" value="" size="50" />
      </dt> -->

      <!-- <dt><em>媒体编辑电话：</em>
        <input name="tel" type="text" id="tel" value="" size="50" />
      </dt> -->

      <!-- <dt><em>备注：</em>
        <input name="beizhu" type="text" id="beizhu" value="" size="50" />
      </dt> -->

       <!-- <dt><em>是否隐藏：</em>
         <input name="hide" type="radio"  value="0" checked="checked" class="danxuan" />
       显示
        <input type="radio" name="hide"  value="1" class="danxuan" />
      隐藏
      </dt> -->

       <!-- <dt><em>是否包收录：</em>
         <input name="bao" type="radio"  value="0" checked="checked" class="danxuan" />
       不包收录
        <input type="radio" name="bao"  value="1" class="danxuan" />
      包收录
      </dt> -->

      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>