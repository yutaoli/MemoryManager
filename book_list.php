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
                return window.confirm("���Ҫɾ����"+val+"��?");
            }
        </script>
    </head>
    <body>
        <?php
        require_once "TableBase.class.php";
        require_once 'BookService.class.php';

        //TODO�������û���¼�߼�
        $userid = 1; //yutaoli
        //���ݿ���л�ȡ����
        $bookService = new BookService();

        $fenyePageReq = new FenyePageReq();
        $fenyePageReq->displayPageCount = 10;
        $fenyePageReq->goUrl = 'book_list.php';
        if (!empty($_GET['nowPage'])) {
            $fenyePageReq->nowPage = $_GET['nowPage'];
        } else {
            $fenyePageReq->nowPage = 1;
        }
        $fenyePageReq->perPage = 10;

        $fenyePageRsp = new FenyePageRsp();
        $bookService->getFenyePage($fenyePageReq, $fenyePageRsp);
        $row_arr = $fenyePageRsp->res;


        echo "<a href='add_book.php'>�����鼮</a>";
        echo "<br/><a href='search_book.php'>����</a>";
        echo "<br/><a href='login.php'>��¼</a>";
        echo "<br/><a href='register.php'>ע��</a>";

        //����չʾ

        echo "<table border='1px' bordercolor='green' celspacing='0px' width='700px'> ";
        echo "<tr>";
        echo "<th>bookid</th><th>book_name</th><th>book_desc</th><th>detail</th><th>author</th>";
        echo "<th>pic_url</th><th>video_url</th><th>����review</th><th>ɾ��</th><th>�޸�</th>";
        echo "</tr>";


        for ($i = 0; $i < count($row_arr); $i++) {
            $row = $row_arr[$i];
            echo "<tr>";
            echo "<td>{$row['book_id']}</td><td>{$row['book_name']}</td><td>{$row['book_desc']}</td><td>{$row['detail']}</td><td>{$row['author']}</td>";
            echo "<td>{$row['pic_url']}</td><td>{$row['video_url']}</td>";
            echo "<td><a href='hgi_add_review.php?userid={$userid}&bookid={$row['book_id']}'>����review</a></td>";
            echo "<td><a onclick='return confirmDel(\"{$row['book_name']}\")' href='hgi_del_book.php?bookid={$row['book_id']}'>ɾ��</a></td>";
            echo "<td><a  href='modify_book.php?book_id={$row['book_id']}'>�޸�</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        //���������
        echo $fenyePageRsp->navigator;
        ?>
    </body>
</html>
