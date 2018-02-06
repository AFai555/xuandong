<?php require 'session.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $config_title?>-<?php echo $config_name?></title>
<meta name="description" content="<?php echo $config_dis?>">
<meta name="keywords" content="<?php echo $config_title?>">
</head>

<frameset rows="79,*" cols="*" frameborder="no" border="0" framespacing="0">
    <frame src="top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />
    <frameset cols="160,*" frameborder="no" border="0" framespacing="0" id="frame">
        <frame src="left.php" name="leftFrame" scrolling="auto" noresize="noresize" id="leftFrame" />
        <frame src="main.php" name="mainFrame" id="mainFrame" />
    </frameset>
</frameset>
<noframes><body>
</body></noframes>
</html>
