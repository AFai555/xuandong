<?php
    $imgfile = $_GET['imgfile'];
    $path = './uploads/files/'.$imgfile;
    $imgsize = filesize($path);
    header("content-type:application/octet-stream");
    header("content-disposition:attachment;filename={$imgfile}");
    header("content-length:{$imgsize}");
    readfile($path);
