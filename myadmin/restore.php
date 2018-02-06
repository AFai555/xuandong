<form id="form1" name="form1" method="post" action=""> 
【数据库SQL文件】：<input id="sqlFile" name="sqlFile" type="file" /> 
<input id="submit" name="submit" type="submit" value="还原" /> 
</form> 
<?php 
// 我的数据库信息都存放到config.php文件中，所以加载此文件，如果你的不是存放到该文件中，注释此行即可； 
require_once((dirname(__FILE__).'/../../include/config.php')); 
if ( isset ( $_POST['sqlFile'] ) ) 
{ 
$file_name = $_POST['sqlFile']; //要导入的SQL文件名 
$dbhost = "localhost"; //数据库主机名 
$dbuser = "$a0205075444"; //数据库用户名 
$dbpass = "$d6cc88ea"; //数据库密码 
$dbname = "$a0205075444"; //数据库名 

set_time_limit(0); //设置超时时间为0，表示一直执行。当php在safe mode模式下无效，此时可能会导致导入超时，此时需要分段导入 
$fp = @fopen($file_name, "r") or die("不能打开SQL文件 $file_name");//打开文件 
mysql_connect($dbhost, $dbuser, $dbpass) or die("不能连接数据库 $dbhost");//连接数据库 
mysql_select_db($dbname) or die ("不能打开数据库 $dbname");//打开数据库 

echo "<p>正在清空数据库,请稍等....<br>"; 
$result = mysql_query("SHOW tables"); 
while ($currow=mysql_fetch_array($result)) 
{ 
mysql_query("drop TABLE IF EXISTS $currow[0]"); 
echo "清空数据表【".$currow[0]."】成功！<br>"; 
} 
echo "<br>恭喜你清理MYSQL成功<br>"; 

echo "正在执行导入数据库操作<br>"; 
// 导入数据库的MySQL命令 
exec("mysql -u$cfg_dbuser -p$cfg_dbpwd $cfg_dbname < ".$file_name); 
echo "<br>导入完成！"; 
mysql_close(); 
} 
?> 