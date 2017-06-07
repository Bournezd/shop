<?php
require_once '../include.php';

$act=$_REQUEST['act'];
@$id=$_REQUEST['id'];
if($act=="logout"){
    logout(); 
}elseif($act=="addAdmin"){
    addAdmin();
}elseif ($act=="editAdmin"){
    editAdmin($id);  
}elseif ($act=="delAdmin"){
    delAdmin($id);
}elseif($act=="addCate"){
    addCate();
}elseif($act=="editCate"){
    editCate($id);
}elseif($act=="delCate"){
    delCate($id);
}elseif($act=="addPro"){
    $mes=addPro();
}elseif($act=="editPro"){
    $mes=editPro($id);
}elseif ($act=="delPro"){
    $mes=delPro($id);
}elseif ($act=="addUser"){
    $mes=addUser();
}elseif($act=="editUser"){
    $mes=editUser($id);
}elseif ($act=="delUser"){
    $mes=delUser($id);
}elseif($act=="waterText"){
    $mes=dowaterText($id);
}elseif($act=="waterImg"){
    $mes=dowaterImg($id);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php
if($mes){
    echo $mes;
}
?>
</body>
</html>