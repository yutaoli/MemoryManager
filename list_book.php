<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=GB2312">
        <title></title>

        <script  type="text/javascript">
            function confirmDel( val)
            {
                return window.confirm("真的要删除《"+val+"》?");
            }
        </script>
    </head>
    <body>
        <?php
        require_once "TableBase.class.php";
        require_once 'BookService.class.php';

        echo "<h1>书籍列表</h1>";
        echo "<hr/>";


        echo "<a href='add_book.php'>新增书籍</a>";
        echo "<br/><a href='search_book.php'>查找</a>";
        echo "<br/><a href='login.php'>登录</a>";
        echo "<br/><a href='register.php'>注册</a>";

        //数据展示，每行写5个<th></th>
        echo "<table border='1px' bordercolor='green' celspacing='0px' width='700px'> ";
        echo "<tr>";
        echo "<th>编号</th><th>bookid</th><th>book_name</th><th>book_desc</th><th>detail</th>";
        echo "<th>author</th><th>pic_url</th><th>video_url</th><th>加入review</th><th>删除</th>";
        echo "<th>修改</th>";
        echo "</tr>";


        //TODO：增加用户登录逻辑
        $user_id = 1; //yutaoli
        //数据库表中获取数据
        $bookService = new BookService();

        $fenyePageReq = new FenyePageReq();
        $fenyePageReq->displayPageCount = 10;
        $fenyePageReq->goUrl = 'list_book.php';
        if (!!isset($_GET['nowPage'])) {
            $fenyePageReq->nowPage = $_GET['nowPage'];
        } else {
            $fenyePageReq->nowPage = 1;
        }
        $fenyePageReq->perPage = 10;

        $fenyePageRsp = new FenyePageRsp();
        $bookService->getFenyePage($fenyePageReq, $fenyePageRsp);
        $row_arr = $fenyePageRsp->res;

        for ($i = 0; $i < count($row_arr); $i++) {
            $num = ($fenyePageReq->nowPage - 1) * $fenyePageReq->perPage + $i + 1;
            $row = $row_arr[$i];

            echo "<tr>";
            echo "<td>{$num}</td><td>{$row['book_id']}</td><td>{$row['book_name']}</td><td>{$row['book_desc']}</td><td>{$row['detail']}</td>";
            echo "<td>{$row['author']}</td><td>{$row['pic_url']}</td><td>{$row['video_url']}</td>";

            //加入review，用POST提交
            echo "<td>";
            echo "<form action='hgi_add_review.php' method='post' name='form_hgi_add_review{$num}'>";
            echo "<input type='hidden' name='user_id' value={$user_id} />";
            echo "<input type='hidden' name='book_id' value={$row['book_id']} />";
            echo "<a href='javascript:document.form_hgi_add_review{$num}.submit()'>加入review</a>";
            echo "</form>";
            echo "</td>";

            echo "<td><a onclick='return confirmDel(\"{$row['book_name']}\")' href='hgi_del_book.php?bookid={$row['book_id']}'>删除</a></td>";
            echo "<td><a  href='modify_book.php?book_id={$row['book_id']}'>修改</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        //输出导航栏
        echo $fenyePageRsp->navigator;
        ?>
    </body>
</html>
