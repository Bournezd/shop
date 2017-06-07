<?php
require_once '../include.php';
$username = $_POST['username'];
$username=addslashes($username);
$password = $_POST['password'];
$yzm = $_POST['yzm'];
$yzm1 = $_SESSION['yzm'];
$autoFlag=$_SESSION['autoFlag'];
//判断验证码是否正确
if ($yzm == $yzm1) {
    //判断账号密码是否可以匹配
    $sql = "select * from admin where username='{$username}' and password='{$password}'";
    $res = CheckAdmin($sql);
    //var_dump($res);
    if ($res) {
        if($autoFlag){
            //自动登录
            setcookie("adminid",$res['id'],time()+7*24*3600);
            setcookie("adminname",$res['username'],time()+7*24*3600);
        }
        $_SESSION['adminname'] = $res['username'];
        alter("成功登录","index.php");
    } else {
        alter("登录失败，请重新登录", "login.php");
    }
} else {
    alter("验证码错误，请重新登录", "login.php");
}