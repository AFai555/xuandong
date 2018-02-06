<?php
//_alert_back是JS弹窗，用于警告及报错，并返回上一页
function _alert_back($_info) {
	echo "<script type='text/javascript'>alert('$_info');history.go(-1);</script>";
	exit();
}

//_alert_close是JS弹窗，用于警告及报错，并关闭窗口
function _alert_close($_info) {
	echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
	exit();
}

//_location是JS弹窗，用于提示正确操作，并跳转指定页面，如果提示内容为NULL，刚直接跳转
function _location($_info,$_url) {
	if (!empty($_info)) {
		echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
		exit();
	} else {
		header('Location:'.$_url);
	}
}

function _location2($_info,$_url) {
	if (!empty($_info)) {
		echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
		exit();
	} else {
		echo "<script type='text/javascript'>window.parent.frames.location.href='$_url';</script>";
		'';
	}
}


//转义字符串
function getcontent($con){
	if (get_magic_quotes_gpc()){
		return $con;
	}else{
		return addslashes($con);
	}
}

//返回当前时间
function _nowtime(){
	return date('Y-m-d H:i:s');
}

//限制字数长度
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

//限制字数长度2
function txtleft($str,$cutleng) {
$strleng = strlen($str);
if ($cutleng>$strleng) {
	return $str;
}else{
	$notchinanum = 0;
	for($i=0;$i<$cutleng;$i++) {
		if(ord(substr($str,$i,1))<=128) {
			$notchinanum++;
		}
	}
	if(($cutleng%2==1) && ($notchinanum%2==0)) {
		$cutleng++;
	}
	if(($cutleng%2==0) && ($notchinanum%2==1)) {
		$cutleng++;
	}
	return substr($str,0,$cutleng);
}
}

//判断是否是今天的新闻
function newsHot($data) {
	$enddate=time();
	$startdate=strtotime($data);
	$days=round(($enddate-$startdate)/3600/24) ;
	if ($days<1) {
		return '<span class="nnew">new</span>';
	}
}

//过滤URL
function urllink($string) {
	$url=$_SERVER["QUERY_STRING"];
	$url=parse_str($url,$_query);
	unset($_query[$string]);
	$url=http_build_query($_query);
	if ($url!='') $url=$url.'&';
	return '?'.$url;
}

// 格式化日期
function Formatdate($data) {
	return date('m-d',strtotime($data));
}
function Formatdate2($data) {
	return date('Y-m-d',strtotime($data));
}

// 进行过滤
function inject_check($sql_str) { 
   $check=eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str); 
   if($check){ 
       _alert_back('不得包含敏感字符！');
   }else{ 
       return strip_tags($sql_str); 
   } 
}

//高亮显示
function Online($str1,$str2) {
	if ($str1==$str2) {
	 echo 'class="online"';
	}
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

//分页函数
function _page($_sql,$_size) {
	//将里面的所有变量取出来，外部可以访问
	global $_page,$_pagesize,$_pagenum,$_pageabsolute,$_num;
	if (isset($_GET['page'])) {
		$_page = $_GET['page'];
		if (empty($_page) || $_page <= 0 || !is_numeric($_page)) {
			$_page = 1;
		} else {
			$_page = intval($_page);
		}
	} else {
		$_page = 1;
	}
	$_pagesize = $_size;
	$_num = mysql_num_rows(_query($_sql));
	if ($_num == 0) {
		$_pageabsolute = 1;
	} else {
		$_pageabsolute = ceil($_num / $_pagesize);
	}
	if ($_page > $_pageabsolute) {
		$_page = $_pageabsolute;
	}
	$_pagenum = ($_page - 1) * $_pagesize;
}

//清除缓存
function _sess($lx){
	if($lx){$_SESSION['admin']=1;}else{$_SESSION['admin']=0;}
}

//显示分页
function _pageshow($_type) {
	global $_page,$_pageabsolute,$_num;
	$url=$_SERVER["QUERY_STRING"];
	$url=parse_str($url,$_query);
	unset($_query['page']);
	$url=http_build_query($_query);
	if ($url!='') $url=$url.'&';
	if ($_type == 1) {
					echo '<a href="?'.$url.'page='.($_page-1).'">&lt;&lt;</a>';
				for ($i=0;$i<$_pageabsolute;$i++) {
						if ($_page == ($i+1)) {
							echo '<a href="?'.$url.'page='.($i+1).'" class="selected">'.($i+1).'</a>';
						} else {
							echo '<a href="?'.$url.'page='.($i+1).'">'.($i+1).'</a>';
						}
				}
					echo '<a href="?'.$url.'page='.($_page+1).'">&gt;&gt;</a>';
	} elseif ($_type == 2) {
				if ($_page == 1) {
					echo '<span>首页 </span>';
					echo '<span>上一页 </span>';
				} else {
					echo '<a href="?'.$url.'page=1">首页</a> ';
					echo '<a href="?'.$url.'page='.($_page-1).'">上一页</a> ';
				}
				if ($_page == $_pageabsolute) {
					echo '<span>下一页 </span>';
					echo '<span>尾页</span>';
				} else {
					echo '<a href="?'.$url.'page='.($_page+1).'">下一页</a> ';
					echo '<a href="?'.$url.'page='.$_pageabsolute.'">尾页</a> ';
				}
		echo '<span>页次：'.$_page.'/'.$_pageabsolute.'页 </span>';
		echo '<span>共'.$_num.'条记录 </span>';
	} elseif ($_type == 3) {
				if ($_page == 1) {
					echo '<span>首页 </span>';
					echo '<span>上一页 </span>';
				} else {
					echo '<a href="list-1.html">首页</a> ';
					echo '<a href="list-'.($_page-1).'.html">上一页</a> ';
				}
				if ($_page == $_pageabsolute) {
					echo '<span>下一页 </span>';
					echo '<span>尾页</span>';
				} else {
					echo '<a href="list-'.($_page+1).'.html">下一页</a> ';
					echo '<a href="list-'.$_pageabsolute.'.html">尾页</a> ';
				}
		echo '<span>页次：'.$_page.'/'.$_pageabsolute.'页 </span>';
		echo '<span>共'.$_num.'条记录 </span>';
	}
}

//弹出信息，并可以跳转页面
function ShowMsg($msg,$gourl,$gourllocty=0,$onlymsg=0,$limittime=0)
{
	$htmlhead  = "<html>\r\n<head>\r\n<title>系统提示信息</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n";
	$htmlhead .= "<base target='_self'/>\r\n<style>div{line-height:180%;}</style></head>\r\n<body leftmargin='0' topmargin='0'>\r\n<center>\r\n<script>\r\n";
	$htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";

	if($limittime==0)
	{
		$litime = 2000;
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
		$rmsg .= "document.write(\"<br /><div style='width:450px;padding:0px;border:1px solid #C3DAF2;'>";
		$rmsg .= "<div style='padding:6px;font-size:12px;border-bottom:1px solid #C3DAF2;background:#E0EFFF;'><b>系统提示信息！</b></div>\");\r\n";
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
	exit();
}
?>