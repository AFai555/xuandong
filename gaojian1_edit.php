<?php
require 'session.php';

if ($_POST['pn_post']=='确定修改稿件'){
	$id=$_POST['id'];
	$PreviousUrl=$_POST['PreviousUrl'];
	$data['title']=$_POST['title'];
	$data['content']=$_POST['content'];
	
	if ($data['title']=='') ShowMsg('错误：稿件标题不能为空！','-1');
	if ($data['content']=='') ShowMsg('错误：稿件内容不能为空！','-1');
	
	_update('cart',$data,$id);
	ShowMsg('成功：稿件修改成功！',$PreviousUrl);
}

$row=_get_one('cart',$_GET['id']);
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
  <!-- <div class="weizhibox">当前位置：软文发布管理 &gt;&gt; 软文稿件修改</div> -->
<?php require 'user_top.php'?>
    <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#C9D3E9" class="xuqiu">
      <tr>
        <td width="120" height="40"><p class="mc">文章标题<em>*必填
</em></p></td>
        <td><p class="mc"><input name="title" type="text" value="<?php echo $row['title']?>" size="80" maxlength="20" style="height: 25px;" />
        （标题字数应小于20个汉字）</p></td>
      </tr>
      <tr>
        <td height="450"><p class="mc">文章正文<em>*必填</em></p></td>
        <td>
        <p class="mc"><textarea name="content" class="editor_content" id="content"><?php echo $row['content']?></textarea>
        </p>
        <p class="mc pt10">友情提示:1.禁止负面、违法、政治敏感内容！2.发布后不可修改或删除！3.最好不要带网址，带网址有可能被拒稿且带图片不超三张</p>        </td>
      </tr>
      <tr>
        <td height="270"><p class="mc">附言<em>*必填</em></p></td>
        <td><p class="mc">
          <textarea name="beizhu" cols="110" rows="6" id="beizhu"><?php echo $row['beizhu']?></textarea>
        </p>
            <p class="mc pt10"><em>提示必看：</em>亲们，为了减少沟通时间成本和不必要的纠纷，请在附言里注明以下几条说明<br />
              1、有些网站标题只能显示17个字，请提供一条17个字内的备用标题<br />
              2、有些网站不能带联系方式 如网址、 电话、QQ、二维码、微信号等，有要求的，请一定要注明，没注明的视为无要求，编辑可以自主删除或保留<br />
              3、有些网站编辑看稿是否给安排入口，如果有入口要求的，请一定要注明，没注明的视为无要求<br />
              4、没要求的，可填写无要求<br />
            </p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">网址强调<em>*必填</em></p></td>
        <td><p class="mc">
          <input name="wangzhi" type="radio" id="radio" value="1" <?php echo _danxuan(1,$row['wangzhi'])?> />
          稿件里网址不带都无所谓（推荐）
           <input type="radio" name="wangzhi" id="radio" value="2" <?php echo _danxuan(2,$row['wangzhi'])?> />
          稿件里网址一定要带上，否则不发
          <input type="radio" name="wangzhi" id="radio" value="3" <?php echo _danxuan(3,$row['wangzhi'])?> />
          稿件里关键字超链一定要带上，否则不发 
       </p></td>
      </tr>
      <tr>
        <td height="40"><p class="mc">截稿时间<em>*必填</em></p></td>
        <td><p class="mc">
          <input name="jiegao" type="radio" id="radio2" value="1" <?php echo _danxuan(1,$row['jiegao'])?> />
          因编辑原因当天未完成发布，隔天也可以等（推荐）
  <input type="radio" name="jiegao" id="radio2" value="2" <?php echo _danxuan(2,$row['jiegao'])?> />
        当天要完成发布，超时就撤消稿件 </p></td>
      </tr>
    </table>
    <div class="addSub"><input type="submit" name="pn_post" value="确定修改稿件" /></div>
  <!--main end-->
</div>
</form>
</body>
</html>
