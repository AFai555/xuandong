<?php 
require 'session.php';

if ($_GET['act']=='add') {
	$data['title']=$_POST['title']	;
	$data['body']=$_POST['body']	;
	$data['px_id']=$_POST['px_id'];
	$data['hide']=$_POST['hide'];
	$data['lei']=$_POST['lei'];
	$data['addtime']=_nowtime();
	if ($data['title']=='') ShowMsg('错误：名称不能为空','-1');
	if (!is_numeric($data['px_id'])) ShowMsg('错误：排序ID只能是数字','-1');
	_insert('news',$data);
	ShowMsg('成功：新闻添加成功','news.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>添加新闻</title>
<script type="text/javascript" src="editor/kindeditor.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="editor/Alleditor.js"></script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>新闻 &gt; 新闻管理 &gt; 添加新闻</div>
<div class="mainbox">
  <form  name="add" method="post" action="?act=add">
    <dl>
      <dt><em>新闻标题：</em>
        <input name="title" type="text" id="title" value="" size="100" />
      </dt>
      <dt><em>页面内容：</em>
        <textarea name="body" class="editor_content"></textarea>
      </dt>
      <dt><em>排 序：</em>
        <input name="px_id" type="text" id="px_id" value="1" size="10" maxlength="3" />
        <span class="textinput">排序ID只能是数字</span>
        </dt>
        <dt><em>是否显示：</em>
         
        <input type="radio" name="hide"  value="1" class="danxuan" checked="checked"  />
       显示
         <input name="hide" type="radio"  value="0" class="danxuan"  />
        隐藏
        </dt>
         <dt><em>分类：</em>
         
        <input type="radio" name="lei"  value="1" class="danxuan" checked="checked"  />
       平台公告
         <input name="lei" type="radio"  value="2" class="danxuan"  />
        客户案例
         <input name="lei" type="radio"  value="3" class="danxuan"  />
        行业新闻
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