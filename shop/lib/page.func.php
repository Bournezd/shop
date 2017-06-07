    <?php
    /* 
    // 连接数据库
    require_once '../include.php';
    $sql = "select *  from admin";
    $rowTotal = getResultRow($sql);
    // echo "$rowTotal";
    $pageSize = 2;
    $pageTotal = ceil($rowTotal / $pageSize);
    // echo $pageTotal;
    @$page = $_REQUEST['page'] ? (int) $_REQUEST['page'] : $page = "1";
    // 设置请求时的页面为不正常的请求时处理
    if ($page < 1 || $page == null || ! is_numeric($page)) {
        $page = 1;
    }
    if ($page > $pageTotal) {
        $page = $pageTotal;
    }
    // 设置偏移量，传入$page为点击的页码数
    $offSet = ($page - 1) * $pageSize;
    $sql1 = "select * from admin limit {$offSet},{$pageSize}";
    // echo $sql1;
    $res = FetchAll($sql1);
    //print_r($res);
    foreach ($res as $row) {
        echo "用户名     {$row['username']}<br/>";
        echo "用户邮箱        {$row['email']}<hr/>";
    }
    echo  showPage($page, $pageTotal); 
    */
    function showPage($page,$pageTotal,$where=null){        
    $url = $_SERVER['PHP_SELF'];
    // 设置可操作的页码变化
    $where=($where==null)?null:"&".$where;
    $p = '';
    echo "总共{$pageTotal}页，当前为第{$page}页";
    $index = ($page == 1) ? "首页" : "<a href='{$url}?page=1{$where}'>首页</a>";
    $finallyPage = ($page == $pageTotal) ? "最后一页" : "<a href='{$url}?page={$pageTotal}{$where}'>最后一页</a>";
    $prev=$page-1;
    $last=$page+1;
    $prevPage = ($page == 1) ? "上一页" : "<a href='{$url}?page={$prev}{$where}'>上一页</a>";
    $lastPage = ($page == $pageTotal) ? "下一页" : "<a href='{$url}?page={$last}{$where}'>下一页</a>"; 
    for ($i = 1; $i <= $pageTotal; $i ++) {
        // 当前页无链接
        if ($page == $i) {
            $p .= "[{$i}]";
        } else {
            $p .= "<a href='{$url}?page={$i}'>[{$i}]</a>";
        }
    }
   // echo "$p<br/>";
    $str=$index.$prevPage.$p.$lastPage.$finallyPage;
   // echo $str;
   return $str;
    }
    
    
    
    
    
