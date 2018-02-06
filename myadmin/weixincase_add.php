<?php 
require 'session.php';

if ($_GET['act']=='add') {
	$data['title']=$_POST['title']	;
	$data['mid']=$_POST['mid'];
	$data['cb_price']=$_POST['cb_price'];
	$data['price']=$_POST['price'];
	$data['beizhu']=$_POST['beizhu'];
	$data['qq']=$_POST['qq'];
	$data['tel']=$_POST['tel'];
	$data['addtime']=_nowtime();	
	$data['hide']=$_POST['hide'];
	$data['isbao']=$_POST['isbao'];	
	$data['fas']=$_POST['fsl'];
	$data['leix']=$_POST['leix'];
		$data['lianjie']=0;
	$data['shoulu']=0;
	
	if ($data['title']=='') ShowMsg('错误：频道名称不能为空','-1');
	if (!is_numeric($data['cb_price'])) ShowMsg('错误：价格只能是数字','-1');
	if (!is_numeric($data['price'])) ShowMsg('错误：价格只能是数字','-1');
	
	_insert('weixin_case',$data);
	ShowMsg('成功：微信案例添加成功，继续添加','weixincase_add.php?mid='.$data['mid']);
}
$mid=$_GET['mid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>添加微信案例</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>微信 &gt; 微信案例管理 &gt; 添加微信案例</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=add">
    <dl>
      <dt><em>微信名称：</em>
        <input name="title" type="text" id="title" value="" size="50" />
      </dt>
    <!--  <dt><em>频道链接：</em>
        <input name="link" type="text" id="link" value="" size="50" />
      </dt>
      -->
         <dt><em>微信号：</em>
           <input name="isbao" type="text" id="isbao" size="50" />
       </dt>
        <dt><em>粉丝量：</em>
          <input name="fsl" type="text" id="fsl" size="10" />万
      
      </dt>
     <!-- <dt><em>板块链接：</em>
        <input name="case_url" type="text" id="case_url" value="" size="50" />
      </dt>
      -->
      <dt><em>类型：</em>
       <input name="leix" type="radio" id="radio2" value="1" checked="checked" />
        订阅号荐
  <input type="radio" name="leix" id="radio2" value="2"  />
  服务号
      </dt>
      <dt><em>微信分类：</em>
        <select name="mid" id="mid">
<?php
$_result=_query("SELECT * FROM weixin ORDER BY px_id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
          <option value="<?php echo $rs_sort['id']?>" <?php _xiala($rs_sort['id'],$mid)?>><?php echo $rs_sort['title']?></option>
<?php 
}
?>
        </select>
      </dt>
      <dt><em>成本价格：</em>
        <input name="cb_price" type="text" id="cb_price" size="10" />
      <span class="textinput">价格只能是数字</span></dt>
      <dt><em>会员价格：</em>
        <input name="price" type="text" id="price" size="10" />
      <span class="textinput">价格只能是数字</span></dt>
    <!--     <dt><em>链接：</em>
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
-->
      <dt><em>微信编辑QQ：</em>
        <input name="qq" type="text" id="qq" value="" size="50" />
      </dt>
      <dt><em>微信编辑电话：</em>
        <input name="tel" type="text" id="tel" value="" size="50" />
      </dt>
      <dt><em>备注：</em>
        <input name="beizhu" type="text" id="beizhu" value="" size="50" />
      </dt>
       <dt><em>是否隐藏：</em>
         <input name="hide" type="radio"  value="0" checked="checked" class="danxuan" />
       显示
        <input type="radio" name="hide"  value="1" class="danxuan" />
      隐藏
      </dt>
    
      <dt>
        <input type="submit" value="确认" class="lbnt" />
        <input type="button" class="lbnt" value="返回" onClick="location.href='javascript:history.go(-1)'" />
      </dt>
    </dl>
  </form>
</div>
</body>
</html>