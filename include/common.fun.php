<?php
/*
  * 函数名: input
  * 功能: 格式话输入数据
*/
function input($val, $cmd=1){
    $val=addslashes($val);
    if ($cmd==1){
        return trim(htmlspecialchars($val));
    }elseif ($cmd==2){
        return trim($val);
    }elseif ($cmd==3){
        return htmlspecialchars($val);
    }else{
        return htmlspecialchars($val);
    }
}

//$Str为截取字符串，$Length为需要截取的长度 
function cutstr($Str,$Length) { 
$i = 0; 
$l = 0; 
$ll = strlen($Str); 
$f = true; 
while ($i <= $ll) { 
    if (ord($Str{$i}) < 0x80) { 
        $l++; $i++; 
    } else if (ord($Str{$i}) < 0xe0) { 
        $l++; $i += 2; 
    } else if (ord($Str{$i}) < 0xf0) { 
        $l += 2; $i += 3; 
    } else if (ord($Str{$i}) < 0xf8) { 
        $l += 1; $i += 4; 
    } else if (ord($Str{$i}) < 0xfc) { 
        $l += 1; $i += 5; 
    } else if (ord($Str{$i}) < 0xfe) { 
        $l += 1; $i += 6; 
    } 
    if (($l >= $Length - 1) && $f) { 
        $Str = substr($Str, 0, $i); 
        $f = false; 
    } 
    if (($l > $Length) && ($i < $ll)) { 
        $Str = $Str . '...'; break; //如果进行了截取，字符串末尾加省略符号“...” 
    } 
} 
return $Str; 
}

//弹出信息，并可以跳转页面
function ShowMsg($msg,$gourl,$gourllocty=0,$onlymsg=0,$limittime=0)
{
	$htmlhead  = "<html>\r\n<head>\r\n<title>系统提示信息</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n";
	$htmlhead .= "<base target='_self'/>\r\n<style>div{line-height:160%;}</style></head>\r\n<body leftmargin='0' topmargin='0'>\r\n<center>\r\n<script>\r\n";
	$htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";

	if($limittime==0)
	{
		$litime = 1000;
	}
	else
	{
		$litime = $limittime;
	}

	if($gourl=="-1")
	{
		if($limittime==0)
		{
			$litime = 5000;
		}
		$gourl = "javascript:history.go(-1);";
	}

	if($gourl==''||$onlymsg==1)
	{
		$msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");</script>";
	}
	else
	{
		if(!$gourllocty){
			$func = "      var pgo=0;
	      function JumpUrl(){
	        if(pgo==0){ location='$gourl'; pgo=1; }
	      }\r\n";
        }
        else{
			$func = "      var pgo=0;
	      function JumpUrl(){
	        if(pgo==0){ parent.location.href='$gourl'; pgo=1; }
	      }\r\n";
        }
		$rmsg = $func;
		$rmsg .= "document.write(\"<br /><div style='width:450px;padding:0px;border:1px solid #D1DDAA;'>";
		$rmsg .= "<div style='padding:6px;font-size:12px;border-bottom:1px solid #D1DDAA;background:#DBEEBD;'><b>系统提示信息！</b></div>\");\r\n";
		$rmsg .= "document.write(\"<div style='height:130px;font-size:10pt;background:#ffffff'><br />\");\r\n";
		$rmsg .= "document.write(\"".str_replace("\"","“",$msg)."\");\r\n";
		$rmsg .= "document.write(\"";
		if($onlymsg==0)
		{
			if($gourl!="javascript:;" && $gourl!="")
			{
				$rmsg .= "<br /><a href='{$gourl}'>如果你的浏览器没反应，请点击这里...</a>";
			}
			$rmsg .= "<br/></div>\");\r\n";
			if($gourl!="javascript:;" && $gourl!='')
			{
				$rmsg .= "setTimeout('JumpUrl()',$litime);";
			}
		}
		else
		{
			$rmsg .= "<br/><br/></div>\");\r\n";
		}
		$msg  = $htmlhead.$rmsg.$htmlfoot;
	}
	echo $msg;
}
//直接跳转页面
function ShowMsgGo($gourl)
{
	$msg = "<script>parent.location.href='$gourl';</script>";
	echo $msg;
}
//弹出信息，并可以跳转页面	英文版
function ShowMsgEn($msg,$gourl,$gourllocty=0,$onlymsg=0,$limittime=0)
{
	$htmlhead  = "<html>\r\n<head>\r\n<title>System Message</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n";
	$htmlhead .= "<base target='_self'/>\r\n<style>div{line-height:160%;}</style></head>\r\n<body leftmargin='0' topmargin='0'>\r\n<center>\r\n<script>\r\n";
	$htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";

	if($limittime==0)
	{
		$litime = 1000;
	}
	else
	{
		$litime = $limittime;
	}

	if($gourl=="-1")
	{
		if($limittime==0)
		{
			$litime = 5000;
		}
		$gourl = "javascript:history.go(-1);";
	}

	if($gourl==''||$onlymsg==1)
	{
		$msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");</script>";
	}
	else
	{
		if(!$gourllocty){
			$func = "      var pgo=0;
	      function JumpUrl(){
	        if(pgo==0){ location='$gourl'; pgo=1; }
	      }\r\n";
        }
        else{
			$func = "      var pgo=0;
	      function JumpUrl(){
	        if(pgo==0){ parent.location.href='$gourl'; pgo=1; }
	      }\r\n";
        }
		$rmsg = $func;
		$rmsg .= "document.write(\"<br /><div style='width:450px;padding:0px;border:1px solid #D1DDAA;'>";
		$rmsg .= "<div style='padding:6px;font-size:12px;border-bottom:1px solid #D1DDAA;background:#DBEEBD;'><b>System message！</b></div>\");\r\n";
		$rmsg .= "document.write(\"<div style='height:130px;font-size:10pt;background:#ffffff'><br />\");\r\n";
		$rmsg .= "document.write(\"".str_replace("\"","“",$msg)."\");\r\n";
		$rmsg .= "document.write(\"";
		if($onlymsg==0)
		{
			if($gourl!="javascript:;" && $gourl!="")
			{
				$rmsg .= "<br /><a href='{$gourl}'>If your browser is no response, please click here...</a>";
			}
			$rmsg .= "<br/></div>\");\r\n";
			if($gourl!="javascript:;" && $gourl!='')
			{
				$rmsg .= "setTimeout('JumpUrl()',$litime);";
			}
		}
		else
		{
			$rmsg .= "<br/><br/></div>\");\r\n";
		}
		$msg  = $htmlhead.$rmsg.$htmlfoot;
	}
	echo $msg;
}
//取IP
function GetIP()
{
	if(!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	}
	else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
		$cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else if(!empty($_SERVER["REMOTE_ADDR"]))
	{
		$cip = $_SERVER["REMOTE_ADDR"];
	}
	else
	{
		$cip = '';
	}
	preg_match("/[\d\.]{7,15}/", $cip, $cips);
	$cip = isset($cips[0]) ? $cips[0] : 'unknown';
	unset($cips);
	return $cip;
}

//返回格林威治标准时间
function MyDate($format = 'Y-m-d H:i:s')
{
	return date($format);
}

//UEditor编辑器
function GetUEditor($inputname = 'myueditor', $content = '')
{
	global $cfg_include;
	echo "<script language=\"javascript\" src=\"$cfg_include/UEditor/ueditor.config.js\"></script>
	<script language=\"javascript\" src=\"$cfg_include/UEditor/ueditor.all.js\"></script>
	<textarea name=\"$inputname\" id=\"$inputname\">$content</textarea>
	<script type=\"text/javascript\">
		var editor = new UE.ui.Editor();
		UE.getEditor('$inputname');
	</script>";
}

//取验证码
function GetCkVdValue()
{
	@session_start();
	return isset($_SESSION['dd_ckstr']) ? $_SESSION['dd_ckstr'] : '';
}
//php某些版本有Bug，不能在同一作用域中同时读session并改注销它，因此调用后需执行本函数
function ResetVdValue()
{
	@session_start();
	$_SESSION['dd_ckstr'] = '';
	$_SESSION['dd_ckstr_last'] = '';
}

//检查邮件地址
function checkemeil($Cemail)
{
	
	if(strpos($Cemail ,'@') > -1 && strpos($Cemail ,'.') > -1){
		return true;
	}
	else{
		return false;
	}
	
	
/*
//	$arr=array("ac","cc","jp","com\.uk","com","cn","net","org","edu","gov","mil","ac\.cn","com\.cn","edu\.cn","net\.cn","org\.cn");
//	$str=implode("|",$arr);
//	$red="/^[\w\-\.]+@[\w\-]+(\.(".$str."))+$/";

	$red="/^[\w\-\.]+@[\w\-]+(\.)+[a-z]{2,6}+$/";
	if(preg_match($red,strtolower($Cemail)))
		return true;
	else
		return false;
*/
}
function isValidDomain($domainName) //检测域名
{ 
	$str="^(http|https)://([a-zA-Z0-9\.]+)?([a-zA-Z0-9-]+)(.com|.net|.org|.cc|.us|.org.uk|.co.uk)([a-zA-Z0-9:;&#@=_~%\?\/\.\+\-]+)?$";
	return ereg($str, $domainName); 
	//return ereg("^(http|https)://(www.)?.+.(com|net|org)$", $domainName); 
}
//检查中国电话号码
function checkphone($Cphone)
{
	$red="/^[0-9]{3,4}[-]?[0-9]{7,8}$/";  //固话
	$reds='/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|188[0-9]{8}$|189[0-9]{8}$/'; //手机
	if(preg_match($red,$Cphone) || preg_match($reds,$Cphone))
		return true;
	else
		return false;
}
//检查中国身份证
function checkitycard($itycard)
{
	$red="/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$/"; //15位
	$reds="/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/"; //18位
	if(preg_match($red,$itycard) || preg_match($reds,$itycard))
		return true;
	else
		return false;
}
//检查中文姓名
function checkusername($username)
{
	//$red="/^[".chr(0xa1)."-".chr(0xff)."]+$/"; //GB2312
	$red="/^[\x{4e00}-\x{9fa5}]{2,5}+$/u";  //utf-8
	if(preg_match($red,$username))
		return true;
	else
		return false;
}
//检查数字
function get_num($strnum){
	$red="/^[0-9]+$/";  //utf-8
	if(preg_match($red,$strnum))
		return true;
	else
		return false;
}
//检查数字ID,分页数
function get_CkNum($strnum){
	$red="/^[0-9]+$/";  //utf-8
	if(preg_match($red,$strnum))
		return $strnum;
	else
		return "0";
}
//计算在当前日期上加减N点后的日期
function addtiandata($addtian, $jiajian = false)
{
	$year = MyDate("Y");
	$month = MyDate("m");
	$day = MyDate("d");
	$date_s = mktime(0,0,0,$month,$day,$year);
	$day_s = (3600*24)*$addtian;
	if($jiajian) 
	 $daste = date("Y-m-d",$date_s-$day_s);
	else 
	 $daste = date("Y-m-d",$date_s+$day_s);
	return $daste;
}

//-----------------------------
function SpHtml2Text($str)
{
	$str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU","",$str);
	$str = preg_replace("/<br(.*)>/isU"," \n ",$str);
	$alltext = "";
	$start = 1;
	for($i=0;$i<strlen($str);$i++)
	{
		if($start==0 && $str[$i]==">")
		{
			$start = 1;
		}
		else if($start==1)
		{
			if($str[$i]=="<")
			{
				$start = 0;
				$alltext .= " ";
			}
			else if(ord($str[$i])>31)
			{
				$alltext .= $str[$i];
			}
		}
	}
	$alltext = str_replace("　"," ",$alltext);
	$alltext = preg_replace("/&([^;&]*)(;|&)/","",$alltext);
	$alltext = preg_replace("/[ ]+/s"," ",$alltext);
	return $alltext;
}
//HTML转文本
function Html2Text($str,$r=0)
{
	if($r==0)
	{
		return SpHtml2Text($str);
	}
	else
	{
		$str = SpHtml2Text(stripslashes($str));
		return addslashes($str);
	}
}

//文本转HTML
function Text2Html($txt)
{
	$txt = str_replace("  ","　",$txt);
	$txt = str_replace("<","&lt;",$txt);
	$txt = str_replace(">","&gt;",$txt);
	$txt = preg_replace("/[\r\n]{1,}/isU","<br/>\r\n",$txt);
	return $txt;
}

//查找字符串
function findstr($str, $substr){
	$m = strlen($str);
	$n = strlen($substr );
	if($m < $n) return false ;
	for($i=0; $i <=($m-$n+1); $i ++){
	        $sub = substr( $str, $i, $n);
	        if ( strcmp($sub, $substr) == 0) return true;
	}
	return false ;
}

//生成游客EMIAL帐户
function randEmil($lennum){
	if(!$lennum) $lennum = 5;
	$randEmil="";
	$UserIp=GetIP();
	$UserIp=str_replace(array(" ","-",":","."),"",$UserIp);
	$ABCstr="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$UserIplen=strlen($UserIp);
	for($t=2;$t<=$UserIplen;$t++)
	{
		$UserIpABC = substr($UserIp,$t,1);
		$randEmil.=substr($ABCstr,$UserIpABC,1);
	}
	for($i=0;$i<=$lennum;$i++)
	{
		$randEmil .= substr($ABCstr,rand(0,25),1);
	}
	return $randEmil;
}

//随机生成大写字母字符串带时间
function rand_str_time($lennum){
	$RandAstr="";
	$thistimes=Date("Y-m-d H:i:s");
	$thistimes=str_replace(array(" ","-",":"),"",$thistimes);
	$ABCstr="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$thistimelen=strlen($thistimes);
	$npnum=$lennum-$thistimelen-4;
	for($i=0;$i<=3;$i++)
	{
		$RandAstr .= substr($ABCstr,rand(0,25),1);
	}
	for($t=2;$t<=$thistimelen;$t++)
	{
		$thistimeABC=substr($thistimes,$t,1);
		$RandAstr.=substr($ABCstr,$thistimeABC,1);
	}
	for($j=0;$j<=$npnum;$j++)
	{
		$RandAstr .= substr($ABCstr,rand(0,25),1);
	}
	return $RandAstr;
}

//随机生成大写字母字符串ss
function randid($lennum, $randstr){
	$rand_str = '';
	$str_len = strlen($randstr) - 1;
	for($i = 0;$i < $lennum;$i++)
	{
		$rand_str .= substr($randstr,rand(0,$str_len),1);
	}
	return $rand_str;
}

//获取网址中的域名
function get_domain($url){
	$pattern = "/[w-] .(com|net|org|gov|cc|biz|info|cn)(.(cn|hk))*/";
	preg_match($pattern, $url, $matches);
	if(count($matches) > 0) {
	return $matches[0];
	}else{
	$rs = parse_url($url);
	$main_url = $rs["host"];
	if(!strcmp(long2ip(sprintf("%u",ip2long($main_url))),$main_url)) {
	return $main_url;
	}else{
	$arr = explode(".",$main_url);
	$count=count($arr);
	$endArr = array("com","net","org","3322");//com.cn net.cn 等情况
	if (in_array($arr[$count-2],$endArr)){
	$domain = $arr[$count-3].".".$arr[$count-2].".".$arr[$count-1];
	}else{
	$domain = $arr[$count-2].".".$arr[$count-1];
	}
	return $domain;
	}// end if(!strcmp...)
	}// end if(count...)
}// end function
//处理文件名

function getLevel($lev){
	$Levelstr = "";
	if($lev < 2){
		//┌ ├└
		$Levelstr = "";
	}
	else{
		for($i=1;$i<$lev;$i++){
			$Levelstr .=  "&nbsp;";
		}
		$Levelstr .= "├&nbsp;";
	}
	return $Levelstr;
}

//判断是否国内浏览
/*
function iplimit($ip){
	$iplimit = site_exe::site_iplimit();
	$china_ip = $iplimit->setup();
    //echo $iplimit->msg;
	if(preg_match("/zh-CN/i", $_SERVER['HTTP_ACCEPT_LANGUAGE']) || $china_ip) {
		$ipok = 'no';
	}
}
*/

//取出给定日期里面的年月日
function get_date_time($datetime){
    $times = strtotime($datetime);
    $Y = date("Y", $times);
    $M = date("m", $times);
    $D = date("d", $times);
    return array('Y' => $Y, 'M' => $M, 'D' => $D);
}

//分隔字符串
function get_str_explode($str, $separator){
	$row = explode($separator, $str);
	$base = array();
	for($i = 0;$i < count($row);$i++){
		if($row[$i]) $base[] = $row[$i];
	}
	unset($row);
    return $base;
}
?>