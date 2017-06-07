<?php
require_once '../include.php';
/**
 * 添加照片
 */
function addAlbum($arr){
    insert("album", $arr);
}

/**
 * 得到所有的图片
 * @return unknown
 */
function getAllAlbum(){
    $sql="select * from album";
    $rows=FetchAll($sql);
    return $rows;
    
    
}


/**
 * 前台界面根据产品的ID来获取图片
 * @param unknown $id
 */
function getProImgById($id){
    $sql="select albumPath from album where pid={$id} limit 1";
    $rows=FetchOne($sql);
    return  $rows;
    
}

/**
 * 得到缩略图的时候是传一个源图片的时候得到三张缩略图
 * getProImgById($id)是拿到一张图片，而这个函数是取全部的图片
 * @param unknown $id
 * @return unknown
 */

function getProsImgById($id){
    $sql="select albumPath from album where pid={$id}";
    $rows=FetchAll($sql);
    return $rows;
    
}

/**
 * 添加水印，默认文字是“zd”
 * @param unknown $id
 */
function dowaterText($id){
    $rows = getProsImgById($id);
    foreach ($rows as $row){
    $filename = "../uploads/" . $row['albumPath'];
    water1($filename);
    }
    alter("操作成功", "listProImages.php");
}





