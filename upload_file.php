<?php
   echo $_FILES["myfile"]['name'];
  if (copy($_FILES["myfile"]['tmp_name'],"sdfas.jpg")) {echo "�ϴ��ɹ�";}
  else {echo "�ϴ�ʧ��";}

?>