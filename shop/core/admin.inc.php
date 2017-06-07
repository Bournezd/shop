<?php
require_once '../include.php';

/**
 * 按照给定的SQL语句来查找是否可以验证到这条数据
 * @param unknown $sql
 */
function CheckAdmin($sql)
{
    $res=FetchOne($sql);
    return $res;
}
/**
 * 注销登录
 */
function logout(){
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    if(isset($_COOKIE['adminId'])){
		setcookie("adminId","",time()-1);
	}
	if(isset($_COOKIE['adminName'])){
		setcookie("adminName","",time()-1);
	}
    session_destroy();
    header("location:login.php");
} 
/**
 * 添加管理员
 */
function addAdmin(){
    global $link;
    $arr=$_POST;
    var_dump($arr) ;
    $admin_insert=insert("admin",$arr);
    if ($admin_insert){
        echo alter("添加成功", "addAdmin.php");
       //echo "c";
    }else {
       echo alter("添加失败", "addAdmin.php");
        //echo mysqli_error($link);
    }
}

/**
 * 得到所有管理员的列表操作
 */
function getAllAdmin(){
    $sql="select id,username,email from admin ";
    $rows=FetchAll($sql);
    return $rows;
}

/**
 * 分页处理
 * 移动至公共类中了
 */
// function getAdminByPage(){
//     $sql = "select *  from admin";
//     $rowTotal = getResultRow($sql);
//     $pageSize = 5;
//     global $page;
//     @$page = $_REQUEST['page'] ? (int) $_REQUEST['page'] : $page = "1";
//     $offSet = ($page - 1) * $pageSize;
//     $sql1 = "select * from admin limit {$offSet},{$pageSize}";
//     global $pageTotal;
//     $pageTotal = ceil($rowTotal / $pageSize);
//     if ($page < 1 || $page == null || ! is_numeric($page)) {
//         $page = 1;
//     }
//     if ($page > $pageTotal) {
//         $page = $pageTotal;
//     }
//     global $rows;
//     $rows = FetchAll($sql1);
// }
/**
 * 修改管理员数
 * @param 传参数是用户的ID $id
 */
function editAdmin($id){
    $arr=$_POST;
    //var_dump($arr);
    //echo $id;
    if(update("admin", $arr,"id={$id}")){
        //echo "111";
       alter("编辑成功", "listAdmin.php");
    }else{
       alter("编辑失败","listAdmin.php");
    } 
}
/**
 * 删除管理员
 * @param unknown $id
 */

function delAdmin($id){
    if(delete("admin","id={$id}")){
        //echo "111";
        alter("删除成功", "listAdmin.php");
    }else {
        alter("删除失败", "listAdmin.php");
    }
}

/**
 * 增加用户
 */
function addUser(){
    $arr=$_POST;
    //var_dump($arr);
    $arr['password']=md5($_POST['password']);
    $arr['regTime']=time();
    $uploadFile=upLoadFile1("../uploads");
    
    //print_r($uploadFile);
    if($uploadFile&&is_array($uploadFile)){
        $arr['face']=$uploadFile[0]['name'];
    }else{
        return "添加失败";
    }
    //	print_r($arr);exit;
    if(insert("user", $arr)){
        $mes="添加成功!";
    }else{
        $filename="../uploads/".$uploadFile[0]['name'];
        if(file_exists($filename)){
            unlink($filename);
        }
        $mes="添加失败!";
    }
    return $mes;
}

/**
 * 删除用户
 * @param int $id
 * @return array
 */
function delUser($id){
    
    $sql="select face from user where id={$id}";
    $rows=FetchOne($sql);
    $face=$rows['face'];
    if(file_exists("../uploads/".$face)){
        unlink("../uploads/.$face");
    }
    if($sql){
        alter("删除成功", "listUser.php");
        //echo "111";
    }else{
        alter("删除失败", "listUser.php");
    }
    return $rows;    
}

/**
 * 编辑用户
 * @param int $id
 */
function editUser($id){
    $arr=$_POST;
    $rows=update("user", $arr,"id={$id}");    
    if($rows){
        alter("更新成功", "listUser.php");
    }else {
        alter("更新失败", "listUser.php");
    }    
}





