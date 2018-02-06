 //处理文件夹	 
	 $dir=date("Y");
	 $dir1=$dir-1;
	 $dir=$dir.'09';
	 $dir1=$dir1.'09';
	 	
	 $to=date("Ym");  
	 $year=date("Y");
	 $year=$year.'09';
	 if($to==$year)
	   { 
	     if(!file_exists($dir))
	      { mkdir($year); } 
		}
	 if(file_exists($dir))
	   {   
	      $dir=$dir.'/'; 
	      }
		  else 
		  {  $dir=$dir1.'/'; }
//处理上传 
  //处理可能发生的错误
  
  if ($_FILES['userfile']['error'] > 0)
  {
    echo 'Problem: ';
    switch ($_FILES['userfile']['error'])
    {
      case 1:  echo '文件大小超过了php.ini设定值';  break;
      case 2:  echo '文件大小超过了form隐藏域限定值';  break;
      case 3:  echo '文件被部分上载';  break;
      case 4:  echo '没有上载文件';  break;
    }
    exit;
  }
		  if (($_FILES['userfile']['type'] != 'application/msword') or ($_FILES['userfile']['type'] != 'application/pdf'))
		  {
			echo 'Problem: 文件格式不对或文件正在使用';
			exit;
		  }
	  
//设定上传保存路径
  $ext=substr($_FILES['userfile']['name'],strrpos($_FILES['userfile']['name'],"."));
  //echo $dir;
  $upfile = $dir.xialang.time().$ext;
  //echo $upfile;
//判断是否为上传文件
  if(is_uploaded_file($_FILES['userfile']['tmp_name'])) 
  {
	 //在执行了下面的上传之后，如果出错将提示
	 //否则就会完成上传
     if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile))
     {
        echo 'Problem: 无法上传到指定路径';
        exit;
     }
  } 
  else 
  {
    echo 'Problem: 不是上传的文件. Filename: ';
    echo $_FILES['userfile']['name'];
    exit;
  }