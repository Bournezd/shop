<?php 
require_once '../include.php';

/**
 * 添加分类
 */
function addCate(){
    $array=$_POST;
    $sql=insert("cate", $array);
    if($sql){
        alter("添加分类成功", "listCate.php");
    }else{
        alter("添加分类失败", "listCate.php");
    }
}
/**
 * 根据ID的名字来得到一条分类数据
 * @param unknown $id
 */
function getRowById($id){
    global $link;
    $sql="select id,cName from cate where id={$id}";
    $row=FetchOne($sql);
    return $row;
  
}

/**
 * 修改分类
 * @param unknown $id
 */
function editCate($id){
    $array=$_POST;
    $res=update("cate", $array,"id={$id}");
    if($res){
        //echo "111";
        alter("修改成功", "listCate.php");
    }else{
        //echo "222";
        alter("修改失败", "listCate.php");
    }
}

/**
 * 删除分类信息
 * @param unknown $id
 */

function delCate($id)
{
    $check1 = checkProExist($id);
    // var_dump($check1);exit();
    if (! $check1) {
        $res = delete("cate", "id={$id}");
        if ($res) {
            // echo "111";
            alter("删除成功", "listCate.php");
        } else {
            // echo "222";
            alter("删除失败", "listCate.php");
        }
    } else {
        alter("请先删除分类下的产品才可以删除该分类", "listCate.php");
    }
}

/**
 * 得到所有的分类信息
 * @return unknown
 */
function getAllCate(){
    $sql="select id,cName from cate";
    $res=FetchAll($sql);
    return $res;
}






