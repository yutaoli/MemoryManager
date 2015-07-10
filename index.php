<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=GB2312">
        <title></title>
    </head>
    <body>
        <?php
        require_once "TableBase.class.php";
        require_once 'BookService.class.php';
        //数据库表中获取数据
        $bookService = new BookService();

        $fenyePageReq = new FenyePageReq();
        $fenyePageReq->displayPageCount = 10;
        $fenyePageReq->goUrl = 'index.php';
        if (!empty($_GET['nowPage'])) {
            $fenyePageReq->nowPage = $_GET['nowPage'];
        } else {
            $fenyePageReq->nowPage = 1;
        }
        $fenyePageReq->perPage = 10;

        $fenyePageRsp = new FenyePageRsp();
        $bookService->getFenyePage($fenyePageReq, $fenyePageRsp);
        $row_arr = $fenyePageRsp->res;



        //数据展示

        echo "<table border='1px' bordercolor='green' celspacing='0px' width='700px'> ";
        echo "<tr>";
        echo "<th>bookid</th><th>book_name</th><th>book_desc</th><th>detail</th><th>author</th>";
        echo "<th>pic_url</th><th>video_url</th>";
        echo "</tr>";


        for ($i = 0; $i < count($row_arr); $i++) {
            $row = $row_arr[$i];
            echo "<tr>";
            echo "<td>{$row['book_id']}</td><td>{$row['book_name']}</td><td>{$row['book_desc']}</td><td>{$row['detail']}</td><td>{$row['author']}</td>";
            echo "<td>{$row['pic_url']}</td><td>{$row['video_url']}</td>";
            echo "</tr>";
        }
        echo "</table>";

        //输出导航栏
        echo $fenyePageRsp->navigator;
        ?>
    </body>
</html>
