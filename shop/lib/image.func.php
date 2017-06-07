<?php
/**
 * 大部分采用了命名后面加一是因为在Test文件夹中先实现了功能
 * 然后再去封装成了函数，为了区别和好区分的原则
 * 所以就在函数命名后面加了1
 */


/**
 * 创建一个验证码
 */
function verifyImage(){
//创建画布
$width=100;
$height=40;
$image=imagecreatetruecolor($width, $height);
$white=imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $white);
//创建验证码
$yzmcode='';
for($i=0;$i<4;$i++){
    $fontface="../fonts/simkai.ttf";
    $font=5;
    $x=(20*$i)+rand(10,15);
    $y=rand(20,30);
    $str='abcdefghijklmnopqrstuvwxyz0123456789';
    $content=substr($str, rand(0,strlen($str)-1),1);
    $yzmcode.=$content;
    $contentcolor=imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
    imagettftext($image,mt_rand(20,24), mt_rand(-60,60), $x, $y, $contentcolor, $fontface, $content);
}

$_SESSION['yzm']=$yzmcode;
//制造噪点和干扰线
for($i=0;$i<150;$i++){
    $pixcolor=imagecolorallocate($image,rand(0,120), rand(0,120), rand(0,120));
    imagesetpixel($image, rand(0,99), rand(0,39), $pixcolor);
}
for($i=0;$i<4;$i++){
    $linecolor=imagecolorallocate($image,rand(0,120), rand(0,120), rand(0,120));
    imageline($image, rand(0,99), rand(0,39), rand(0,99), rand(0,39), $linecolor);
}
//显示验证码出来
ob_clean();
header("Content-type:image/png");
imagepng($image);
imagedestroy($image);
}



/**
 * 生成缩略图
 * 参数分别为源文件的图片名字，目标图片的宽，高。
 * @param String $filename
 * @param number $des_wid
 * @param number $des_hig
 */
function resize1($filename,$des_wid=50,$des_hig=50){
    list($sou_wid,$sou_hig,$sou_type)=getimagesize($filename);
    $mime=image_type_to_mime_type($sou_type);

    $imagecreatefrom_gs=str_replace("/", "createfrom", $mime);
    $sou_img=$imagecreatefrom_gs($filename);
    $des_img=imagecreatetruecolor($des_wid,$des_hig);
    imagecopyresampled($des_img, $sou_img, 0,0,0,0, $des_wid, $des_hig, $sou_wid, $sou_hig);
    //输出图片
    header("Content-type:$mime");
    //imagejpeg()
    $image_gs=str_replace("/", "", $mime);
    $re=getUniName().".".getExt($filename);
    //$image_gs($des_img,"uploads/".getUniName().".".getExt($filename));
    $image_gs($des_img,"../uploads/".$re);
    imagedestroy($sou_img);
    imagedestroy($des_img);
    return $re;
}

/**
 * 添加文字水印
 * @param 文件路径  $filename
 * @param 水印文字  string $text
 */
 
function water1($filename,$text="zd"){
$fileInfo=getimagesize($filename);
$mime=$fileInfo['mime'];
//echo $mime."<br/>";
//images/jpeg
$createFun=str_replace("/", "createfrom", $mime);
$image=$createFun($filename);
//$image1=imagecreatefromjpeg($filename);
$color=imagecolorallocatealpha($image, 255,0,0,50);
$fontfile="../shop/fonts/simkai.ttf";
$outFun=str_replace("/",null, $mime);
imagettftext($image, 14,0,0,14, $color, $fontfile, $text);
header("Content-type:{$mime}");
$outFun($image,"../uploads/$filename");
imagedestroy($image);
//     header('content-type:image/jpeg');
//     imagejpeg($image);
//     imagedestroy($image);
}
    

/**
 * 添加图片水印
 * @param unknown $dstFile
 * @param string $srcFile
 * @param number $pct
 */
function waterPic1($dstFile,$srcFile="2.jpg",$pct=30){
    $srcFileInfo=getimagesize($srcFile);
    $src_w=$srcFileInfo[0];
    $src_h=$srcFileInfo[1];
    $dstFileInfo=getimagesize($dstFile);
    $srcMime=$srcFileInfo['mime'];
    $dstMime=$dstFileInfo['mime'];
    $createSrcFun=str_replace("/", "createfrom", $srcMime);
    $createDstFun=str_replace("/", "createfrom", $dstMime);
    $outDstFun=str_replace("/", null, $dstMime);
    $dst_im=$createDstFun($dstFile);
    $src_im=$createSrcFun($srcFile);
    imagecopymerge($dst_im, $src_im, 0,0,0,0, $src_w, $src_h,$pct);
    header("content-type:".$dstMime);
    $outDstFun($dst_im,$dstFile);
    imagedestroy($src_im);
    imagedestroy($dst_im);
}


?>