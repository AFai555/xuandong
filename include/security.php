<?php
//防注入

//$bad_str = "and|select|update|'|delete|insert|*";
$bad_str = "select|insert|update|delete|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile";
$bad_Array = explode("|",$bad_str);

/** 过滤Get参数 **/ 
foreach($bad_Array as $bad_a){ 
	foreach ($_GET as $key => $g){
		if (substr_count(@strtolower($g),$bad_a) > 0){
			$_GET[$key] = '';
		}
	}
}

/** 过滤Post参数 **/ 
foreach ($bad_Array as $bad_a){
	foreach ($_POST as $key => $p){
		if (substr_count(@strtolower($p),$bad_a) > 0){
			$_POST[$key] = '';
		}
	}
}

/** 过滤REQUEST参数 **/ 
foreach ($bad_Array as $bad_a){
	foreach ($_REQUEST as $key => $r){
		if (substr_count(@strtolower($r),$bad_a) > 0){
			$_REQUEST[$key] = '';
		}
	}
}

/** 过滤Cookies参数 **/ 
foreach ($bad_Array as $bad_a){
	foreach ($_COOKIE as $key => $co){
		if (substr_count(@strtolower($co),$bad_a) > 0){
			$_COOKIE[$key] = '';
		}
	}
}


?>