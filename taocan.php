<?php
require './include/conn.php';
$row=_get_one('taocan',$_GET['tid']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $row['title']?> --权威新闻媒体发布交易平台</title>
<meta name="keywords" content="软文发布平台,软文发布,专业软文代写,新闻软文发布网站,专业软文发布,新闻媒体推广,低价软文发布,专业软文发布渠道,媒体公关发稿" />
<meta name="description" content="中国最专业的新闻媒体发布网站，最权威的广告资源交易平台，提供优势广告资源，一直以'资源全、价格低、服务好'为宗旨服务于广大用户和营销企业" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="box" style="width:80%; margin:20px auto;">
    	<h1 class="title"><?php echo $row['title']?></h1>
        <div class="boxcon mb10"><?php echo $row['body']?></div>
    </div>
</body>
</html>
