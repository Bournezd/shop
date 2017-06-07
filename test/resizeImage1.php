<?php
//缩略图的制作
    //源图片
    $filename="1.jpg";
    $sou_img=imagecreatefromjpeg($filename);
    //getimagesize结果集有7个参数，前三个是宽，高，图片类型，
    list($sou_wid,$sou_hig,$sou_type)=getimagesize($filename);
    $mime=image_type_to_mime_type($sou_type);
    //$mime的格式为image/jpeg
    $imagecreatefrom_gs=str_replace("/", "createfrom", $mime);
    //创建目标画布
    $des_50_img=imagecreatetruecolor(50,50);
    $des_220_img=imagecreatetruecolor(220,220);
    $des_350_img=imagecreatetruecolor(350,350);
    $des_800_img=imagecreatetruecolor(800,800);
    //重采样拷贝部分图像并调整大小
    imagecopyresampled($des_50_img, $sou_img, 0,0,0,0, 50, 50, $sou_wid, $sou_hig);
    imagecopyresampled($des_220_img, $sou_img, 0,0,0,0, 220, 220, $sou_wid, $sou_hig);
    imagecopyresampled($des_350_img, $sou_img, 0,0,0,0, 350, 350, $sou_wid, $sou_hig);
    imagecopyresampled($des_800_img, $sou_img, 0,0,0,0, 800, 800, $sou_wid, $sou_hig);
    //输出图片
    header("Content-type:$mime");
    $image_gs=str_replace("/", "", $mime);
    //$image_gs=imagejpeg
    $image_gs($des_50_img,"uploads/img_50_".$filename);
    $image_gs($des_220_img,"uploads/img_220_".$filename);
    $image_gs($des_350_img,"uploads/img_350_".$filename);
    $image_gs($des_800_img,"uploads/img_800_".$filename);
    imagedestroy($sou_img);
    imagedestroy($des_50_img);
    imagedestroy($des_220_img);
    imagedestroy($des_350_img);
    imagedestroy($des_800_img);



