<?php
//var_dump($_FILES);
require_once '../shop/lib/string.func.php';
require_once 'upload.func.php';
header("Content-type:text/html; charset:utf-8");
foreach ($_FILES as $val){
    upLoadFile($val);
}

