<?php
   echo $_FILES["myfile"]['name'];
  if (copy($_FILES["myfile"]['tmp_name'],"sdfas.jpg")) {echo "上传成功";}
  else {echo "上传失败";}

?>