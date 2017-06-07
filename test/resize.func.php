<?php
//下面一行代码原本放在test目录下面的
require_once '../shop/lib/string.func.php';
//require_once '../include.php';
//缩略图的制作,测试代码
 $filename="1.jpg";
 resize($filename);
 resize($filename,220,220);
/**
 * 生成缩略图
 * 参数分别为源文件的图片名字，目标图片的宽，高。
 * @param String $filename
 * @param number $des_wid
 * @param number $des_hig
 */
function resize($filename,$des_wid=50,$des_hig=50){
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
    $image_gs($des_img,"uploads/".$re);
    imagedestroy($sou_img);
    imagedestroy($des_img);
    return $re;
}


