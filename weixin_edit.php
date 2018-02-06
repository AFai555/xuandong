<?php
require 'session.php';

if ($_POST['pn_post']=='确定修改稿件'){
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['title']=$_POST['title'];
	$data['content']=$_POST['content'];
	$data['beizhu']=$_POST['beizhu'];
	$data['wangzhi']=$_POST['wangzhi'];
	$data['jiegao']=$_POST['jiegao'];
	
	if ($data['title']=='') ShowMsg('错误：稿件标题不能为空！','-1');
	if ($data['content']=='') ShowMsg('错误：稿件内容不能为空！','-1');
	
	_update('wxcart',$data,$id);
	ShowMsg('成功：稿件修改成功！',$PreviousUrl);
}

$row=_get_one('wxcart',$_GET['id']);
if ($row['uid']!=$_SESSION['userid'] || $row['zt']!=1) ShowMsg('错误：您无权修改这个稿件！','-1');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻软文自助发布平台</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./myadmin/editor/kindeditor.js"></script>
<script type="text/javascript" src="./myadmin/editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="./myadmin/editor/Alleditor.js"></script>
</head>

<body>
<form action="" method="post">
<input name="id" type="hidden" id="id" value="<?php echo $row['id']?>" />
<input name="PreviousUrl" type="hidden" id="PreviousUrl" value="<?php echo $_SERVER['HTTP_REFERER']?>" />
<div class="main">
  <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 软文稿件修改</div>
<?php require 'user_top.php'?>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td width="120" height="40"><p class="mc">活动标题<em>*必填
</em></p></td>
        <td><p class="mc"><input name="title" type="text" value="<?php echo $row['title']?>" size="80" maxlength="28" />
        （标题字数应小于28个汉字）</p></td>
      </tr>
      
      <tr>
        <td height="450"><p class="mc">活动内容<em>*必填</em></p></td>
        <td>
        <p class="mc"><textarea name="content" class="editor_content" id="content"><?php echo $row['content']?></textarea>
        </p>
        <p class="mc pt10">友情提示<br />
          1、活动标题请直接编辑在内容中(仅支持一张图片且图片不能大于2M，建议尺寸：700像素 * 300像素)<br />
2、此处理内容编辑框可填写稿件转发链接提交</p>        </td>
      </tr>
       <tr>
        <td height="40"><p class="mc">阅读原文链接</p></td>
        <td><p class="mc"><textarea name="yuanwen" cols="110" rows="1" id="beizhu"><?php echo $row['jiegao']?></textarea></p></td>
      </tr>
      <tr>
        <td height="160"><p class="mc">附言<em>*必填</em></p></td>
        <td><p class="mc">
          <textarea name="beizhu" cols="110" rows="6" id="beizhu"><?php echo $row['beizhu']?></textarea>
        </p>
            <p class="mc pt10"><em>提示必看：</em>有什么特殊要求的，可以在此处说明。            </p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">完成时间<em>*必填</em></p></td>
        <td><p class="mc">
        <input name="wangzhi" type="radio" id="radio" value="1" <?php echo _danxuan(1,$row['wangzhi'])?> />
          一天内完成
           <input type="radio" name="wangzhi" id="radio" value="2" <?php echo _danxuan(2,$row['wangzhi'])?> />
          两天内完成（推荐）
          <input type="radio" name="wangzhi" id="radio" value="3" <?php echo _danxuan(3,$row['wangzhi'])?> />
          三天内完成 ）
          <input type="radio" name="wangzhi" id="radio" value="4" <?php echo _danxuan(4,$row['wangzhi'])?> />
         一周内天内完成发 
       </p></td>
      </tr>
     
    </table>
    <div class="addSub"><input type="submit" name="pn_post" value="确定修改稿件" /></div>
  <!--main end-->
</div>
</form>
</body>
</html>
