<?php

/**
 * 获取单一字符串
 * @return string
 */
function getUniName(){
    return md5(uniqid(microtime(true),true));
}

/**
 * 获取文件的扩展名
 * @param unknown $filename
 * @return string
 */
function getExt($filename){
    $str1=explode(".", $filename);
    $str2=end($str1);
    $res=strtolower($str2);
    return $res;
}



?>