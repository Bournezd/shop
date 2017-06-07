<?php
require_once '../shop/lib/string.func.php';
require_once 'upload.func.php';
header("Content-type:text/html; charset:utf-8");
$fileInfo=$_FILES['file'];
$mes=upLoadFile($fileInfo);
echo $mes;