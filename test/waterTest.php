<?php
    $filename="1.jpg";
    water($filename);
    function water($filename,$text="zd"){
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
    $outFun($image);
    imagedestroy($image);
//     header('content-type:image/jpeg');
//     imagejpeg($image);
//     imagedestroy($image);

    }
    ?>
    
    