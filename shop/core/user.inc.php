<?php 

require_once '../include.php';
/**
 * 注册
 * @return string
 */
function reg(){
	$arr=$_POST;
	//var_dump($arr);
	$arr['password']=md5($_POST['password']);
	$arr['regTime']=time();
	$uploadFile=upLoadFile1();
	
	//print_r($uploadFile);
	if($uploadFile&&is_array($uploadFile)){
		$arr['face']=$uploadFile[0]['name'];
	}else{
		return "注册失败";
	}
//	print_r($arr);exit;
	if(insert("user", $arr)){
		$mes="注册成功!<br/>3秒钟后跳转到登陆页面!<meta http-equiv='refresh' content='3;url=login.php'/>";
	}else{
		$filename="uploads/".$uploadFile[0]['name'];
		if(file_exists($filename)){
			unlink($filename);
		}
		$mes="注册失败!<br/><a href='reg.php'>重新注册</a>|<a href='index.php'>查看首页</a>";
	}
	return $mes;
}

/**
 * 登录
 * @return string
 */
function login(){
    global $link;
	$username=$_POST['username'];
	//addslashes():使用反斜线引用特殊字符来防止SQL注入
	//$username=addslashes($username);
	$username=mysqli_escape_string($link,$username);
	$password=md5($_POST['password']);
	$sql="select * from user where username='{$username}' and password='{$password}'";
	//$resNum=getResultNum($sql);
	$row=fetchOne($sql);
	//echo $resNum;
	if($row){
		$_SESSION['loginFlag']=$row['id'];
		$_SESSION['username']=$row['username'];
		$mes="登陆成功！<br/>3秒钟后跳转到首页<meta http-equiv='refresh' content='3;url=index.php'/>";
	}else{
		$mes="登陆失败！<a href='login.php'>重新登陆</a>";
	}
	return $mes;
}

/**
 * 退出
 */
function userOut(){
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}

	session_destroy();
	header("location:index.php");
}




