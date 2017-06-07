<!-- 
单个文件的功能上传
-->


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
require_once '../shop/lib/string.func.php';
$filename=$_FILES['file']['name'];
$type=$_FILES['file']['type'];
$tmp_name=$_FILES['file']['tmp_name'];
$error=$_FILES['file']['error'];
$size=$_FILES['file']['size'];

if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $error . "<br />";
} else {
    echo "Upload: " . $filename . "<br />";
    echo "Type: " . $type . "<br />";
    echo "Size: " . ($size / 1024) . " Kb<br />";
    echo "Stored in: " . $tmp_name;
}
$err = '';
$ext=getExt($filename);
$filename=getUniName().".".$ext;
$path="uploads";
$destination="$path/".$filename;
//判断路径是否存在
if(!file_exists($path)){
    mkdir("uploads");
}
$imgFlag=true;
//判断上传是否为真正的图片格式，getimagesize可检验如果是图片类型返回一个数组，如果不是则返回一个Boolean（FALSE）
if($imgFlag){
    $im=getimagesize($tmp_name);
    if(!$im){
       exit("不是真正的图片类型"); 
    }
}

$arrayExt=array("jpg","png","gif","pneg","wbmp");
//限定文件的格式
if(!in_array($ext,$arrayExt )){
    exit("文件上传格式错误");
}
if($size>1048576){
    exit("上传文件过大");
}
if ($err == UPLOAD_ERR_OK) {
    //判断文件是不是通过 HTTP POST 文件方式上传的文件
    if(is_uploaded_file($tmp_name)){   
        
        if(move_uploaded_file($tmp_name, $destination)){
            echo "文件上传成功";
        }else{
            echo "文件上传失败";
        }
    }
} else {
    switch ($err) {
        case 1:
            //UPLOAD_ERR_CANT_WRITE
            $mes = "文件不可写";
            break;
        case 2:
            //UPLOAD_ERR_EXTENSION
            $mes = "文件扩展文件中断文件上传";
            break;
        case 3:
            //UPLOAD_ERR_FORM_SIZE
            $mes = "超过了表单设置的文件大小";
            break;
        case 4:
            //UPLOAD_ERR_INI_SIZE
            $mes = "超所了配置文件设置的文件大小";
            break;
        case 5:
            //UPLOAD_ERR_NO_FILE
            $mes = "没有文件上传";
            break;
        case 6:
            //UPLOAD_ERR_NO_TMP_DIR
            $mes = "没有找到临时目录";
            break;
        case 7:
            //UPLOAD_ERR_PARTIAL
            $mes = "部分文件被上传";
            break;
    }
    echo $mes;
}






