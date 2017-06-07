<?php 
require_once '../include.php';
// $sql="select * from user";
// $rows=FetchAll($sql);
//var_dump($rows);
$rows=getAdminByPage("user");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

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
                                <th width="20%">用户名称</th>
                                <th width="20%">用户邮箱</th>
                                <th width="20%">是否激活</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <?php 
                            foreach ($rows as $row){
                        ?>
                        <tbody>
                       
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td>
                                <input type="checkbox" id="c1" class="check">
                                <label for="c1" class="label">
                                <?php echo $row['id']?>
                                </label></td>
                                <td><?php echo $row['username']?></td>
                                <td><?php echo $row['email']?></td>
                                 <td>
                                 	<?php
                                 	if(@$rows['activeFlag']==0){
                                 	    echo "未激活";
                                 	}else{
                                 	    echo "已激活";
                                 	}
                                 	?>	
                                 </td>
                                <td align="center"><input type="button" value="修改" class="btn" onclick="editUser(<?php echo $row['id']?>)"><input type="button" value="删除" class="btn"  onclick="delUser(<?php echo $row['id']?>)"></td>
                            </tr>
                           
                        </tbody>
                        <?php 
                            }
                            
                            ?>
                    </table>
                  <?php  echo showPage($page, $pageTotal);  ?> 
                </div>
</body>
<script type="text/javascript">

	function addUser(){
		window.location="addUser.php";	
	}
	function editUser(id){
			window.location="editUser.php?id="+id;
	}
	function delUser(id){
			if(window.confirm("您确定要删除吗？删除之后不可以恢复哦！！！")){
				window.location="doAdminAction.php?act=delUser&id="+id;
			}
	}
</script>
</html>