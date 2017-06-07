<?php
require_once '../include.php';

/**
 * 添加分类
 * 
 * @return unknown
 */
function addPro()
{
    $arr = $_POST;
    $arr['pubTime'] = time();
    $upLoadFile = upLoadFile1("../uploads");
    if (is_array($upLoadFile) && $upLoadFile) {
        foreach ($upLoadFile as $key => $val) {
            echo $val['name'];
            $re1 = resize1("../uploads/" . $val['name'], 50, 50);
            $re2 = resize1("../uploads/" . $val['name'], 220, 220);
            $re3 = resize1("../uploads/" . $val['name'], 350, 350);
        }
    }
    $res = insert("pro", $arr);
    $pid = getInsertId();
    if ($res && $pid) {
        foreach ($upLoadFile as $upLoad) {
            $arr1['pId'] = $pid;
            $arr1['albumPath'] = $upLoad['name'];
            addAlbum($arr1);
        }
        // echo "111";
        alter("添加成功", "listPro.php");
    } else {
        if (file_exists("../uploads/" . $re1)) {
            unlink("../uploads/" . $re1);
        }
        if (file_exists("../uploads/" . $re2)) {
            unlink("../uploads/" . $re2);
        }
        if (file_exists("../uploads/" . $re3)) {
            unlink("../uploads/" . $re3);
        }
        alter("添加失败", "listPro.php");
        // echo "222";
    }
}

/**
 * 得到所有分类
 * 
 * @return unknown
 */
function getAllProByAdmin()
{
    $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from pro as p join cate c on p.cId=c.id";
    $row = FetchAll($sql);
    return $row;
}

/**
 * 产品分页
 * 因为公用的分页sql语句都是查询数据表的全部数据，所以这个需要关联查询就另外单独放在一个函数中
 * @param unknown $table            
 * @return unknown
 */
function getAdminByPage1($table,$where=null,$order=null)
{
    $sql = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from pro as p join cate c on p.cId=c.id {$where}";
    //echo $sql."<br />";
    $rowTotal = getResultRow($sql);
    $pageSize = 2;
    global $page;
    @$page = $_REQUEST['page'] ? (int) $_REQUEST['page'] : $page = "1";
    $offSet = ($page - 1) * $pageSize;
    $sql1 = "select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName from pro as p join cate c on p.cId=c.id {$where}{$order} limit {$offSet},{$pageSize}";
    //echo $sql1."<br />";
    global $pageTotal;
    $pageTotal = ceil($rowTotal / $pageSize);
    if ($page < 1 || $page == null || ! is_numeric($page)) {
        $page = 1;
    }
    if ($page > $pageTotal) {
        $page = $pageTotal;
    }
    global $rows;
    $rows = FetchAll($sql1);
    return $rows;
}

/**
 *根据商品id得到商品图片
 * @param int $id
 * @return array
 */
function getAllImgByProId($id){
	$sql="select a.albumPath from album a where pid={$id}";
	$rows=fetchAll($sql);
	return $rows;
}


/**
 * 根据id得到商品的详细信息
 * 两张表联合查询结果，分类表ID改为了名称
 * @param int $id
 * @return array
 */
function getProById($id){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from pro as p join cate c on p.cId=c.id where p.id={$id}";
    $row=fetchOne($sql);
    return $row;
}

/**
 * 
 * 编辑商品
 * @param unknown $id
 */
function editPro($id){
    $arr = $_POST;
    $upLoadFile = upLoadFile1("../uploads");
    if (is_array($upLoadFile) && $upLoadFile) {
        foreach ($upLoadFile as $key => $val) {
            echo $val['name'];
            $re1 = resize1("../uploads/" . $val['name'], 50, 50);
            $re2 = resize1("../uploads/" . $val['name'], 220, 220);
            $re3 = resize1("../uploads/" . $val['name'], 350, 350);
        }
    }
    $res = update("pro", $arr,"id={$id}");
    
    $pid = $id;
    if ($res && $pid) {
        foreach ($upLoadFile as $upLoad) {
            $arr1['pId'] = $pid;
            $arr1['albumPath'] = $upLoad['name'];
            addAlbum($arr1);
        }
        // echo "111";
        alter("编辑成功", "listPro.php");
    } else {
        if (file_exists("../uploads/" . $re1)) {
            unlink("../uploads/" . $re1);
        }
        if (file_exists("../uploads/" . $re2)) {
            unlink("../uploads/" . $re2);
        }
        if (file_exists("../uploads/" . $re3)) {
            unlink("../uploads/" . $re3);
        }
        alter("编辑失败", "listPro.php");
        // echo "222";
    }
  
}

/**
 * 删除产品
 * @param unknown $id
 */
function delPro($id){
    $sql=delete("pro","id=${id}");
//     if($sql){
//         echo "333";
//     }
    $proImg=getAllImgByProId($id);
    if($proImg && is_array($proImg)){
        foreach ($proImg as $pro){
            if(file_exists("uploads/".$pro['albumPath'])){
                unlink("uploads/".$pro['albumPath']);
            }
        }
    }
    $sql1=delete("album","pid={$id}");
//     if($sql1){
//         echo "222";
//     }
    if($sql && $sql1){
        
        alter("删除成功", "listPro.php");
    }else{
        //echo "111";
        alter("删除失败", "listPro.php");
    }   
}

/**
 * 根据cId分类表名称的ID值来查找产品
 * @param unknown $cid
 * @return unknown
 */
function checkProExist($cid){
    $sql="select * from pro where cId={$cid}";
    $rows=FetchAll($sql);
    return $rows;
}

/**
 * 得到所有的产品
 * @return array $rows
 */
function getAllPro(){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from pro as p join cate c on p.cId=c.id";
    $rows=FetchAll($sql);
    return $rows;
}
/**
 * 前台首页展示一个模块四个大图片的显示
 * @param unknown $cid
 * @return unknown
 */
function getProsByCid($cid){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from pro as p join cate c on p.cId=c.id where cId={$cid} limit 4";
    $rows=FetchAll($sql);
    return $rows;
    
}
/**
 * 
 * 得到前台页面展示下面四个小图片的显示
 * @param unknown $cid
 * @return unknown
 */
function getProsByCid1($cid){
    $sql="select p.id,p.pName,p.pSn,p.pNum,p.mPrice,p.iPrice,p.pDesc,p.pubTime,p.isShow,p.isHot,c.cName,p.cId from pro as p join cate c on p.cId=c.id where cId={$cid} limit 4,4";
    $rows=FetchAll($sql);
    return $rows;
    
}


/**
 *得到商品ID和商品名称
 * @return array
 */
function getProInfo(){
    $sql="select id,pName from pro order by id asc";
    $rows=fetchAll($sql);
    return $rows;
}




