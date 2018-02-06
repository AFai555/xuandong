<?php 



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" rel="stylesheet" type="text/css" />
<title>批量导入</title>
<script type="text/javascript"> 
function check(){  
 		//if(document.shuju.type.value==""){
			//alert("请选择类别");
			//document.shuju.type.focus();
			//return false;
		//}
        if(document.shuju.efile.value==""){
			alert("请选择要上传的excel文件");
			document.shuju.efile.focus();
			return false;
		}
		
}
</script>
<script language=javascript>
function downfile(str)
{
  window.location.href = "case_in/"+str;
}
</script>
</head>

<body>
<div class="menubox"><strong>当前位置：</strong>媒体 &gt; 案例管理 &gt; 批量导入</div>
<div class="mainbox">
 
 <table width="300" border="0" align="center"  style="margin-top: 50px;" cellpadding="0" cellspacing="1" bgcolor="#FF6600" height="180">
  <form enctype='multipart/form-data' action='?act=add' name="shuju" method='post' onSubmit="return check();">

  <tr>
    <td height="26" align="left" style="font-size:14px; font-weight:bold; background-color: rgb(224,239,255);">
    &nbsp;    Excel数据导入</td>
  </tr>
  <tr>
    <td valign="top" style="background-color: rgb(233,243,253);"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10"></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="10"></td>
        <td align="center">
          <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" >

            <tr>
              <td height="28" align="right" bgcolor="#FFFFFF">Excel：</td>
              <td bgcolor="#FFFFFF">
			  <input type='file' name='efile' size='15'>
			  </td>
              
            </tr>
          </table>
                
        </td>
        <td width="10"></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="20">
          <p style="padding-top:10px; padding-left:5px; color:#999;">
          请先下载模板，目前仅支持Excel2003版本以.xls后缀的文件，请不要随意修改模板格式。
          </p>
          </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FFFFEE"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" colspan="3" align="center" style="background-color: rgb(224,239,255);"><table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center"><input name="Submit" type="submit" class="button" onMouseOver="this.className='button-bor'" onMouseOut="this.className='button'" value="确认导入" >&nbsp;&nbsp;&nbsp;
               <input name="Submit2" type="button" class="button" onMouseOver="this.className='button-bor'" onMouseOut="this.className='button'" value="下载模板" onClick=Javascript:downfile('case_muban_in.xls')>
               </td>
              </tr>
        </table></td>
      </tr>
    </table></td>
  </tr></form>
</table>
 
 <?php
require 'session.php';


$act = !empty($_GET['act']) ? trim($_GET['act']) : '';
if($act=='add')
{	
		//$link = mysql_connect("localhost","root","Hog61w24f6nznv8u0knpj");
		//mysql_select_db("oldn_iucode",$link);
		//mysql_query("set names 'gbk'");
		function getnames($exname)
		{
    		$dir = "case_in/data/".date("Y-n-j",time()+3600*8)."/";
    		$i=1;
    		if(!is_dir($dir))
			{
       			mkdir($dir,0777);
    		}
    		while(true){
        		if(!is_file($dir.$i.".".$exname))
				{
					$name=$i.".".$exname;
					break;
     			}
     			$i++;
   			}
    		return $dir.$name;
		}
		
		if(!empty($_FILES['efile']['name']))
		{

			$exname=strtolower(substr($_FILES['efile']['name'],(strrpos($_FILES['efile']['name'],'.')+1)));
			$uploadfile = getnames($exname);//上传后文件所在的路径、、写入数据库
			@move_uploaded_file($_FILES['efile']['tmp_name'], $uploadfile);
			
		}
		
		
		
	require_once './case_in/reader.php';
    // ExcelFile($filename, $encoding);
    $data = new Spreadsheet_Excel_Reader();
    // Set output Encoding.
    $data->setOutputEncoding('utf-8');
    //”data.xls”是指要导入到mysql中的excel文件    
    $data->read($uploadfile);
    error_reporting(E_ALL ^ E_NOTICE);
	$ok = 0;
    for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) 
	{
		//$i=2的原因是excel有表头不需要导入
    //以下代码是将excel表数据【3个字段】插入到mysql中，根据你的excel表字段的多少，改写以下代码吧！
     $sql = "INSERT INTO meiti_case(id,title,link,case_url,mid,cb_price,price,lianjie,shoulu,beizhu,qq,tel,addtime,hide,isbao,diquid) VALUES(
									\"".$data->sheets[0]['cells'][$i][1]."\",
									\"".$data->sheets[0]['cells'][$i][2]."\",
									\"".$data->sheets[0]['cells'][$i][3]."\",
									\"".$data->sheets[0]['cells'][$i][4]."\",
									\"".$data->sheets[0]['cells'][$i][5]."\",
									\"".$data->sheets[0]['cells'][$i][6]."\",
									\"".$data->sheets[0]['cells'][$i][7]."\",
									\"".$data->sheets[0]['cells'][$i][8]."\",
									\"".$data->sheets[0]['cells'][$i][9]."\",
									\"".$data->sheets[0]['cells'][$i][10]."\",
									\"".$data->sheets[0]['cells'][$i][11]."\",
									\"".$data->sheets[0]['cells'][$i][12]."\",
									\"".$data->sheets[0]['cells'][$i][13]."\",
									\"".$data->sheets[0]['cells'][$i][14]."\",
									\"".$data->sheets[0]['cells'][$i][15]."\",
									\"".$data->sheets[0]['cells'][$i][16]."\"
									);";
									
		//$sqls = mb_convert_encoding($sql, "GBK", "GBK");    //我这里用的是urf8编码
		//	echo($sql);
		//mysql_query($sqls);
       // $_result=_query($sql);
	  // if ($_result=_query($sqls))
	  
	//  $row=_get_one('meiti',1);
	//  var_dump($row);
		if(_query($sql))
		{
			$ok = 1;
		}else
		{
			echo("<p>");echo('第 ');echo($i);echo(' 行发生异常；'); echo ($_result); echo ("</p>");
			echo ("\n");
		}
	}
	if($ok == '1')
	{
		//echo $sqls;
		echo("其余全部导入成功");exit();
		//ShowMsg('成功：导入成功','case_in.php');
	}else{
		echo("导入失败,请检查ID是否重复。");exit();
		//ShowMsg('成功：发生异常','case_in.php');
		}

}


@mysql_close($db->connect());
?>
 
</div>
</body>
</html>