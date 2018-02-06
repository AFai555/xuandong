<?php
require 'session2.php';
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

$sql_seach="";
if ($_GET['mid']!='') {
	$sql_seach.=" AND mid={$_GET['mid']}";
}
if ($_GET['lianjie']!='') {
	$sql_seach.=" AND lianjie={$_GET['lianjie']}";
}
if ($_GET['shoulu']!='') {
	$sql_seach.=" AND shoulu={$_GET['shoulu']}";
}
if ($_GET['title']!='') {
	$sql_seach.=" AND title like '%{$_GET['title']}%'";
}
if ($_GET['money']!='') {
	if ($_GET['money']==1){
		$sql_seach.=" AND price BETWEEN 0 and 20";
	}elseif ($_GET['money']==2){
		$sql_seach.=" AND price BETWEEN 20 and 50";
	}elseif ($_GET['money']==3){
		$sql_seach.=" AND price BETWEEN 50 and 100";
	}elseif ($_GET['money']==4){
		$sql_seach.=" AND price>100";
	}
}


$sql_seach=$sql_seach." ORDER BY id DESC";
$sql_seach=" WHERE hide = 0".$sql_seach;


	$data[0][] = "媒体频道"; 
	$data[0][] = "分类"; 
	$data[0][] = "案例"; 
	$data[0][] = "会员价"; 
	$data[0][] = "链接"; 
	$data[0][] = "收录"; 
	$data[0][] = "备注"; 
	$i=0;

function lianjie_lx($str){
	if ($str==1){
		return '只可以带文本网址';
	}elseif ($str==2){
		return '可以加入超链接';
	}elseif ($str==3){
		return '不可以添加任何链接';
	}else{
		return '未定义';
	}
}

function shoulu_lx($str){
	if ($str==1){
		return '新闻源收录';
	}elseif ($str==2){
		return '网页收录';
	}elseif ($str==3){
		return '有可能收录';
	}else{
		return '未定义';
	}
}



$sql="SELECT * FROM meiti_case".$sql_seach;

$_result=_query($sql);
$i=1;
while (!!$row=_mysql_list($_result)) {
	
	$i++;
	$data[$i][] = $row['title']; 
	$data[$i][] = getMeiti($row['mid']); 
	$data[$i][] = $row['case_url']; 
	$data[$i][] = $row['price']; 
	$data[$i][] = lianjie_lx($row['lianjie']); 
	$data[$i][] = shoulu_lx($row['shoulu']); 
	$data[$i][] = $row['beizhu']; 
}









$excelFileName=$sheetTitle='data';


require_once 'Classes/PHPExcel.php'; 
require_once 'Classes/PHPExcel/Writer/Excel5.php';     // 用于其他低版本xls 
require_once 'Classes/PHPExcel/Writer/Excel2007.php'; // 用于 excel-2007 格式 
	 /* 实例化类 */
$objPHPExcel = new PHPExcel(); 
/* 设置输出的excel文件为2007兼容格式 */
$objWriter=new PHPExcel_Writer_Excel5($objPHPExcel);//非2007格式
/* 设置当前的sheet */
$objPHPExcel->setActiveSheetIndex(0);
$objActSheet = $objPHPExcel->getActiveSheet();
/*设置宽度*/
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);		
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
/* sheet标题 */
$objActSheet->setTitle($sheetTitle);
$i = 1;
foreach($data as $value)
{
	/* excel文件内容 */
	$j = 'A';
	foreach($value as $value2)
	{
		//$value2=iconv("gbk","utf-8",$value2);
		$objActSheet->setCellValue($j.$i,$value2);
		$j++;
	}
	$i++;
}
/* 生成到浏览器，提供下载 */ 
ob_end_clean();  //清空缓存			 
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");
header('Content-Disposition:attachment;filename="'.$excelFileName.date("Y-m-d-H-i-s",time()).'.xls"');
header("Content-Transfer-Encoding:binary"); 
$objWriter->save('php://output');













?>
