 //�����ļ���	 
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
//�����ϴ� 
  //������ܷ����Ĵ���
  
  if ($_FILES['userfile']['error'] > 0)
  {
    echo 'Problem: ';
    switch ($_FILES['userfile']['error'])
    {
      case 1:  echo '�ļ���С������php.ini�趨ֵ';  break;
      case 2:  echo '�ļ���С������form�������޶�ֵ';  break;
      case 3:  echo '�ļ�����������';  break;
      case 4:  echo 'û�������ļ�';  break;
    }
    exit;
  }
		  if (($_FILES['userfile']['type'] != 'application/msword') or ($_FILES['userfile']['type'] != 'application/pdf'))
		  {
			echo 'Problem: �ļ���ʽ���Ի��ļ�����ʹ��';
			exit;
		  }
	  
//�趨�ϴ�����·��
  $ext=substr($_FILES['userfile']['name'],strrpos($_FILES['userfile']['name'],"."));
  //echo $dir;
  $upfile = $dir.xialang.time().$ext;
  //echo $upfile;
//�ж��Ƿ�Ϊ�ϴ��ļ�
  if(is_uploaded_file($_FILES['userfile']['tmp_name'])) 
  {
	 //��ִ����������ϴ�֮�����������ʾ
	 //����ͻ�����ϴ�
     if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile))
     {
        echo 'Problem: �޷��ϴ���ָ��·��';
        exit;
     }
  } 
  else 
  {
    echo 'Problem: �����ϴ����ļ�. Filename: ';
    echo $_FILES['userfile']['name'];
    exit;
  }