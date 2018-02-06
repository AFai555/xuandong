<?php
require 'session.php';
function write_file($txt,$filename){
	$re=true;
	if(!$fp=@fopen($filename,"w"))$re=false;
	if(!@fwrite($fp,$txt))$re=false;
	@fclose($fp);
	return $re;
}
function dbbak_file($filename,$p){
	$file=$filename.$p.'.php';
	if(file_exists($file)){
		$GLOBALS["rfiles"]=array_merge($GLOBALS["rfiles"],array($file));
		$p=$p+1;dbbak_file($filename,$p);
	}
}
if ($_GET['act']=='bak'){
	$filesize=trim($_POST['filesize']);
	$tables=$_POST['tables'];
	if ($filesize<=0){
		ShowMsg('错误：未填写分卷文件大小！','-1');
	}
	if (count($tables)<=0){
		ShowMsg('错误：请选择需要备份的数据表！','-1');
	}
	
	set_time_limit(99999999);
	ob_implicit_flush(1);
	ob_end_flush();
	ini_set('memory_limit',-1);
	
	
	$sql="<?php die();?>";
	$p=1;$dir='dbbak/'.date("Y-m-d-H-i-s",time());
	$filename=$dir;
	foreach($tables as $t){
		$_result=_query('show create table '.$t);
		$c=_mysql_list($_result);
		$sql.='DROP TABLE IF EXISTS `'.$t."`\r\n".preg_replace("/\n/","",$c['Create Table'])."\r\n";
	}
	foreach($tables as $t){
		$_result=_query('select * from '.$t);
		while (!!$v=_mysql_list($_result)) {
			$tt='';
			$sql.= 'INSERT INTO `'.$t.'` VALUES(';
			foreach($v as $f){$tt.= "'".mysql_real_escape_string($f)."'".",";}
			$sql.= rtrim($tt,',').')'."\r\n";
			if(strlen($sql)>=$filesize*1024){
				if($p==1){$filename.=".php";}else{$filename.="_v".$p.".php";}
				if(write_file($sql,$filename)){
					echo '<div class="flush">生成数据表卷：'.$filename.'</div>';
				}else{set_time_limit(30);ShowMsg("提示：写入备份文件-".$filename."-失败",'-1');}
				$p++;
				$filename=$dir;
				$sql="<?php die();?>";
			}
		}
	}
	if($sql!="<?php die();?>"){
		if($p==1){$filename.=".php";}else{$filename.="_v".$p.".php";}
		if(write_file($sql,$filename))
		echo '<div class="flush">生成数据表卷：'.$filename.'</div>';
	}
	set_time_limit(30);

	ShowMsg('提示：数据备份全部完成！','-1');
}elseif ($_GET['act']=='restore'){
	
	$serverfile=$_POST['serverfile'];
	if (empty($serverfile)){
		ShowMsg('错误：请选择需要恢复的备份！','-1');
	}
	
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link href="source/admin/template/style/admin.css" rel="stylesheet" type="text/css" />';
	set_time_limit(99999999);
	ob_implicit_flush(1);
	ob_end_flush();
	ini_set('memory_limit',-1);
	$filename='dbbak/'.$serverfile;
	$volnum=explode(".ph",$serverfile);
	$rfiles=array($filename);
	dbbak_file('dbbak/'.$volnum[0].'_v',2);
	foreach($rfiles as $v){
		foreach(file($v) as $rsql){
			$sql=str_replace('<?php die();?>','',$rsql);
			$rgo=_query($sql);
			if(!$rgo){echo '<div class="flush">'.$v."导入失败".$rgo."</div>";}
		}
		echo '<div class="flush">'.$v."导入完成</div>";
	}
	set_time_limit(30);
	ShowMsg('提示：数据还原全部完成！','-1');
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据备份</title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.scrollFollow.js"></script>

<script type="text/javascript">
$(function(){
	$("#restore").click(function(){
		if(confirm('恢复数据将覆盖现有数据！确定恢复数据吗？')){
			$("#formrestore").submit();
			click_go();
		}
	});
});
function click_go(){
	$("#tishibox").show();
}
</script>


</head>

<body>
<div class="main">
  <div class="weizhibox">当前位置：数据备份</div>

    <div class="add_buzhuo">
    	<a href="#" class="online">数据恢复</a>
    </div>
    <div class="meitiBox">
    	<ul>
		<div>选择备份文件：:</div>
		<div class="clear mb10"></div>
		
		<form action="?act=restore" method="post" id="formrestore">
    <select name="serverfile"><option value="">请选择</option>
        <?php
		$handle=opendir('dbbak');
        while(false!==($file=readdir($handle))) { 
			if(preg_match("/^[0-9]{4,4}([0-9a-z-]+)(\.php)$/",$file)){echo "<option value='$file'>".str_replace('.php','',$file)."</option>";}
        }
		closedir($handle);
		?>
        </select>
		
		<input id="restore" type="button" class="btnbig" value="立即恢复" />
    </form>
		
		
        </ul>
        
  </div>
  
    <div class="add_buzhuo">
    	<a href="#" class="online">数据备份</a>
    </div>
    <div class="meitiBox">
	    
		
		<form name="form1" method="post" action="?act=bak">
    	<ul>
		<div>选择要备份的表:</div>
		<div class="clear mb10"></div>
<?php
$_result=_query('show table status from `'.DB_NAME.'`');
while (!!$row=_mysql_list($_result)) {
?>
        	<li><input name="tables[]" type="checkbox" value="<?php echo $row['Name']; ?>" checked="checked" /><?php echo $row['Name']?></li>
<?php }?>
<div class="clear mb10"></div>
    <div>分卷大小：<input name="filesize" type="text" value="1024" size="10"> K</div>
    <div><input type="submit" value="立即备份" onclick="click_go();" class="sub" /></div>

</form>
        </ul>
        
  </div>
  
  
  
  
  
  <div class="tishibox" style="display:none;">
  <strong>正在进行数据库操作，请稍后...</strong>
  </div>
  
  
  
  
  
  
  
  
  
  
</div>
</body>
</html>
