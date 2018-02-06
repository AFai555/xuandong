<?php 
require './include/conn.php';
require './include/encrypt.php';

function cart_case($pid){
	$row=_get_one('luntan_case',$pid);
	$t_html = '<a href="'.$row['link'].'" target="_blank">'.$row['title'].'</a> <a href="'.$row['case_url'].'" target="_blank">[案例]</a> ';
	return $t_html;
}

$gid=encrypt($_SERVER["QUERY_STRING"], 'D');

$row=_get_one('ltcart',$_GET['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="myadmin/style/style.css" rel="stylesheet" type="text/css" />
<title>查看稿件</title>
<script src="js/function.js" type="text/javascript"></script>
</head>

<body>
<div class="adminbox">
  <table width="760px" border=1 align="center" cellpadding=0 cellspacing=1 bordercolor=#c9d3e9 style="margin-top:20px;margin-bottom:20px;border-collapse:collapse;table-layout:fixed;">
    <tr>      
      <td align="center"><p class="see_con"><strong><?php echo $row['title']?></strong></p></td>
    </tr> 
      <td style="width:760px;overflow-x:hidden;overflow-y:hidden; word-wrap:break-word;">
     
      <table width="98%" border="0"  align="center" cellpadding=0 cellspacing=1 bordercolor=#c9d3e9 style="margin-top:20px;margin-bottom:20px;border-collapse:collapse;table-layout:fixed;">
  <tr>
    <td style="overflow-x:hidden;overflow-y:hidden; word-wrap:break-word;">
       <p class="see_con" ><?php echo $row['content']?></p>
    </td>
  </tr>
</table>

   
      </td>
    </tr>
  </table>
</div>
</body>
</html>
