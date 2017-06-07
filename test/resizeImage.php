<?php
    //图片大小为1920*1080
    $filename="1.jpg";
    //得到图片
    $sou_img=imagecreatefromjpeg($filename);
    list($source_wid,$source_hig)=getimagesize($filename);
    $scale=0.5;
    $des_wid=ceil($source_wid*$scale);
    $des_hig=ceil($source_hig*$scale);
    //建立画布
    $des_img=imagecreatetruecolor($des_wid, $des_hig);
    //重采样拷贝部分图像并调整大小
    imagecopyresampled($des_img, $sou_img, 0,0,0,0, $des_wid, $des_hig, $source_wid, $source_hig);
    header("Content-type:image/jpeg");
    imagejpeg($des_img,"uploads/".$filename);
    imagedestroy($sou_img);
    imagedestroy($des_img);
