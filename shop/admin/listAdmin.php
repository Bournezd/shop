<?php 
require_once '../include.php';
$rows=getAdminByPage("admin");
/*
 * 分页制作
 * 把下面的直接封装成了一个函数
$sql = "select *  from admin";
$rowTotal = getResultRow($sql);
$pageSize = 5;
@$page = $_REQUEST['page'] ? (int) $_REQUEST['page'] : $page = "1";
$offSet = ($page - 1) * $pageSize;
$sql1 = "select * from admin limit {$offSet},{$pageSize}";
$pageTotal = ceil($rowTotal / $pageSize);
if ($page < 1 || $page == null || ! is_numeric($page)) {
    $page = 1;
}
if ($page > $pageTotal) {
    $page = $pageTotal;
}
$rows = FetchAll($sql1);
*/

if(!$rows){
    echo alter("没有管理员，请添加管理员", "addAdmin.php");
    exit();
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>管理员列表页</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>
<script type="text/javascript">

	function addAdmin(){
		window.location="addAdmin.php";	
	}
	function editAdmin(id){
			window.location="editAdmin.php?id="+id;
	}
    function delAdmin(id){
			if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
				window.location="doAdminAction.php?act=delAdmin&id="+id;
			} 
	}
</script>
<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addAdmin()">
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">编号</th>
                                <th width="25%">管理员名称</th>
                                <th width="30%">管理员邮箱</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <?php 
                                $i=1;
                                 foreach ($rows as $row){
                                   //上面这行的效果：    或者采用这行foreach ($rows as $row):与下面endforeach对应也可以 
                                   //foreach ($rows as $row):
                                ?>
                                <td>
                                <input type="checkbox" id="c1" class="check">
                                <label for="c1" class="label">
           
                                </label>
                                <?php echo $i; ?>
                                </td>
                                
                                <td><?php echo $row['username']?></td>
                                <td><?php echo $row['email']?></td>
                                <td align="center">
                                <input type="button" value="修改" class="btn" onclick="editAdmin(<?php echo $row['id'];?>)">
                                
                                <input type="button" value="删除" class="btn"  onclick="delAdmin(<?php echo $row['id'];?>)">
                                </td>
                               
                            </tr>
                           
                            
                            <?php 
                            $i++;
                           // endforeach;
                                 }
                            ?>
                             <tr >
                                <td colspan="4">
                                    <?php echo showPage($page, $pageTotal)?>
                                </td>
                            </tr>
                            
                           <!-- 原来的静态界面的编写 -->
<!--                             <tr> -->
                                <!--这里的id和for里面的c1 需要循环出来-->
<!--                                 <td> -->
<!--                                 <input type="checkbox" id="c1" class="check"> -->
<!--                                 <label for="c1" class="label"></label> -->
<!--                                 </td> -->
<!--                                 <td></td> -->
<!--                                 <td></td> -->
<!--                                 <td></td> -->
<!--                             </tr> -->
                        
                          
                        </tbody>
                    </table>
                </div>
</body>

</html>