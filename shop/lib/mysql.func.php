<?php
require_once '../include.php';
$link =mysqli_connect(DB_HOST, DB_USER, DB_PSD) or die("数据库连接失败" . mysqli_connect_errno().":".mysqli_connect_error());
/**
 * 数据库连接操作
 * DB_HOST, DB_USER, DB_PSD
 * @return unknown
 */

function connect()
{
    global $link;
    mysqli_query($link, DB_CHARSET);
    mysqli_select_db($link, DB_DBNAME) or die("指定打开数据库失败".mysql_errno().":".mysql_error());
    return $link;
}
/**
 * 完成数据库的插入操作
 * @param 表名   $table
 * @param 数组   $array
 */
function insert($table,$array)
{   
    global $link;
    mysqli_query($link, "set names utf8");
    $key=join(",",array_keys($array));
    $value="'".join("','", array_values($array))."'";
    $sql="insert into {$table}($key) values({$value})";
    //insert into user(userid,username) values('1',"zd");
    mysqli_query($link,$sql);
    return mysqli_insert_id($link);
}



//update user set username="1" where username="2";
function update($table,$array,$where=null)
{
    
    global $link;
    mysqli_query($link, "set names utf8");
    $ziduan='';
    foreach($array as $key=>$val){
        if($ziduan==null){
            $sep="";
        }else{
            $sep=",";
        }
    $ziduan.=$sep.$key."='".$val."'";
    }
    $sql="update {$table} set {$ziduan}"." ". ($where==null?null:"where"." ". $where);
    //echo $sql;
    $res=mysqli_query($link,$sql);
    //var_dump($res);
    return mysqli_affected_rows($link);
}
/**
 * 删除记录
 * @param unknown $table
 * @param string $where
 */
function delete($table ,$where=null)
{   
    
    global $link;
    mysqli_query($link, "set names utf8");
    $sql="delete from {$table}"." ".($where==null?null:"where"." ".$where);
    mysqli_query($link, $sql);
    return mysqli_affected_rows($link);
}

/**
 * 查询一条结果的记录
 * @param unknown $sql
 */
function FetchOne($sql)
{   
    
    global  $link;
    mysqli_query($link, "set names utf8");
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);
    return $row;
}

/**
 * 得到结果集中所有的记录
 * @param unknown $sql
 */
function FetchAll($sql)
{   
    
    global  $link;
    mysqli_query($link, "set names utf8");
    $result=mysqli_query($link,$sql);
    while(@$row=mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return @$rows;
}

/**
 * 得打结果集中的条数
 * @param unknown $sql
 */
function getResultRow($sql)
{
    
    global $link;
    mysqli_query($link, "set names utf8");
    $result=mysqli_query($link, $sql);
    $rows=mysqli_num_rows($result);
    return $rows;
}

/**
 * 得到上一步记录的ID号
 */
function getInsertId(){
    global $link;
    return mysqli_insert_id($link);
}



?>



    