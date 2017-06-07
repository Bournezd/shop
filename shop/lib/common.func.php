<?php
require_once '../include.php';


/**
 * 弹框
 * @param String $mes  弹框信息
 * @param String $url  跳转界面
 */
function alter($mes,$url)
{
    echo "<script>alert('{$mes}');</script>";
    echo "<script>window.location='{$url}';</script>";
}


/**
 * 分页首先处理的版块，设置分页信息
 * @param unknown $table
 * @return unknown
 */
function getAdminByPage($table){
    $sql = "select *  from {$table}";
    $rowTotal = getResultRow($sql);
    $pageSize = 2;
    global $page;
    @$page = $_REQUEST['page'] ? (int) $_REQUEST['page'] : $page = "1";
    $offSet = ($page - 1) * $pageSize;
    $sql1 = "select * from {$table} limit {$offSet},{$pageSize}";
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



