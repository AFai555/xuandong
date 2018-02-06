<?php 
require 'session.php';

if ($_GET['act']=='xiugai') {
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['title']=$_POST['title']	;
	$data['link']=$_POST['link'];
	$data['case_url']=$_POST['case_url'];
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
	
	if ($data['title']=='') ShowMsg('错误：频道名称不能为空','-1');
	if (!is_numeric($data['cb_price'])) ShowMsg('错误：价格只能是数字','-1');
	if (!is_numeric($data['price'])) ShowMsg('错误：价格只能是数字','-1');
	
	_update('weixin_case',$data,$id);
	ShowMsg('成功：微信案例修改成功，继续添加',$PreviousUrl);
}
$row=_get_one('weixin_case',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>添加微信案例</title>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>微信 &gt; 微信案例管理 &gt; 修改微信案例</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=xiugai">
    <input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
    <input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
    <dl>
      <dt><em>微信名称：</em>
        <input name="title" type="text" id="title" value="<?php echo $row['title']?>" size="50" />
      </dt>
    
             <dt><em>微信号：</em>
   
        <input name="isbao" type="text" id="isbao" size="50" value="<?php echo $row['isbao']?>"  />
      </dt>
     <dt><em>粉丝量：</em>
          <input name="fsl" type="text" id="fsl" size="10"  value="<?php echo $row['fas']?>"/>万
      
      </dt>
     <!-- <dt><em>板块链接：</em>
        <input name="case_url" type="text" id="case_url" value="" size="50" />
      </dt>
      -->
      <dt><em>类型：</em>
       <input name="leix" type="radio" id="radio2" value="1" <?php echo _danxuan(1,$row['leix'])?> />
        订阅号荐
  <input type="radio" name="leix" id="radio2" value="2" <?php echo _danxuan(2,$row['leix'])?> />
  服务号
      </dt>
      <dt><em>微信分类：</em>
        <select name="mid" id="mid">
<?php
$_result=_query("SELECT * FROM weixin ORDER BY px_id ASC");
while (!!$rs_sort=_mysql_list($_result)) {
?>
          <option value="<?php echo $rs_sort['id']?>" <?php _xiala($rs_sort['id'],$row['mid'])?>><?php echo $rs_sort['title']?></option>
<?php 
}
?>
        </select>
      </dt>
      <dt><em>成本价格：</em>
        <input name="cb_price" type="text" id="cb_price" size="10" value="<?php echo $row['cb_price']?>" />
      <span class="textinput">价格只能是数字</span></dt>
      <dt><em>会员价格：</em>
        <input name="price" type="text" id="price" size="10" value="<?php echo $row['price']?>" />
      <span class="textinput">价格只能是数字</span></dt>
   <!--   <dt><em>链接：</em>
        <input name="lianjie" type="radio"  value="1" class="danxuan" <?php _danxuan(1,$row['lianjie'])?> />
        只可以带文本网址
        <input type="radio" name="lianjie"  value="2" class="danxuan" <?php _danxuan(2,$row['lianjie'])?> />
      可以加入超链接 
      <input type="radio" name="lianjie"  value="3" class="danxuan" <?php _danxuan(3,$row['lianjie'])?> />
不可以添加任何链接 </dt>
      <dt><em>收录：</em>
        <input name="shoulu" type="radio"  value="1" class="danxuan" <?php _danxuan(1,$row['shoulu'])?> />
        新闻源收录
        <input type="radio" name="shoulu"  value="2" class="danxuan" <?php _danxuan(2,$row['shoulu'])?> />
      百度收录 
        <input type="radio" name="shoulu"  value="3" class="danxuan" <?php _danxuan(3,$row['shoulu'])?> />
有可能收录 </dt>
-->
      <dt><em>微信编辑QQ：</em>
        <input name="qq" type="text" id="qq" value="<?php echo $row['qq']?>" size="50" />
      </dt>
      <dt><em>微信编辑电话：</em>
        <input name="tel" type="text" id="tel" value="<?php echo $row['tel']?>" size="50" />
      </dt>
      <dt><em>备注：</em>
        <input name="beizhu" type="text" id="beizhu" value="<?php echo $row['beizhu']?>" size="50" />
      </dt>
      
      <dt><em>是否隐藏：</em>
         <input name="hide" type="radio"  value="0" class="danxuan" <?php _danxuan(0,$row['hide'])?> />
        显示
        <input type="radio" name="hide"  value="1" class="danxuan" <?php _danxuan(1,$row['hide'])?> />
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