<?php
    header("content-type:text/html;charset=utf-8");
    $dirname = "uploads/files";
    function listdir($dirname) {
        $ds = opendir($dirname);
        while ($file = readdir($ds)) {
            $path = $dirname.'/'.$file;
            if ($file != '.' && $file != '..'){
                if (is_dir($path)) {
                    listdir($path);
                } else {
                    echo "<tr>";
                    echo "<td><img src='$path'></td>";
                    echo "<td><a href='download.php?imgfile=$file'>Download</a></td>";
                    echo "</tr>";
                }
            }
        }
    } 
    echo "<h2>图片下载|<a href='index_uploads.php'>图片上传</a></h2>";
    echo "<table width='700px' border='1px'>";
    listdir($dirname);
    echo "</table>";