
<?php
require 'session2.php';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=demo.xls');
header('Pragma: no-cache');
header('Expires: 0');
$sql="SELECT * FROM meiti_case";
$_result=_query($sql);
$title = array('1', '2', '3', '4', '5', '6');
echo iconv('utf-8', 'gbk', implode("\t", $title)), "\n";
foreach ($_result as $value) {
	echo iconv('utf-8', 'gbk', implode("\t", $value)), "\n";
}
?>