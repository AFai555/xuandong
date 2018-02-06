<?php
//判断

require 'include/conn.php';
if ($_SESSION['userid']) {
	if ($_GET['act']=='gj'){
		header("Location:gaojian_list.php");
	}elseif ($_GET['act']=='dx'){
		header("Location:daixie_add.php");
	}elseif ($_GET['act']=='wb'){
		header("Location:weibo_list.php");
	}elseif ($_GET['act']=='lt'){
		header("Location:luntan_list.php");
	}elseif ($_GET['act']=='wx'){
		header("Location:weixin_list.php");
	}elseif ($_GET['act']=='cz'){
		header("Location:alipay.php");
	}elseif ($_GET['act']=='s7'){
		header("Location:seetz7.php");
	}elseif ($_GET['act']=='s8'){
		header("Location:seetz8.php");
	}elseif ($_GET['act']=='cw'){
		header("Location:caiwu.php");
	}elseif ($_GET['act']=='add'){
		header("Location:gaojian_add.php");
	}elseif($_GET['act']=='tj'){
			header("Location:/myadmin/case_ad.php");
	}	else{
		$row=_get_one('member',$_SESSION['userid']);
		if ($row['nickname']!='' && $row['tel']!='' && $row['qq']!='' && $row['mail']!=''){
			header("Location:gaojian_admin.php");
		}else{
			header("Location:user_edit.php");
		}
	}
}else{
	if ($_GET['act']=='wb'){
		header("Location:weibo_list.php");
	}elseif ($_GET['act']=='wx'){
		header("Location:weixin_list.php");
	}elseif ($_GET['act']=='lt'){
		header("Location:luntan_list.php");
	}elseif($_GET['act']=='gj'){
			header("Location:gaojian_list.php");
	}elseif($_GET['act']=='tj'){
			header("Location:myadmin/case_ad.php");
	}
}
?>