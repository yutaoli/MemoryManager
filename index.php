<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=GB2312">
        <title></title>
    </head>
    <body>
        <?php
        //数据库中获取数据
        $dbname = 'memorymanager';
        $tablename = 'table_book';
        $host = 'localhost:3306';
        $username = 'root';
        $password = '1990610';

        $conn = mysql_connect($host, $username, $password) or die("mysql_connect error:" . mysql_errno());
        mysql_select_db($dbname, $conn) or die("mysql_select_db error:" . mysql_errno());

        $sql = "select book_id, book_name, book_desc, detail, author, pic_url, video_url from $tablename ";
        $res = mysql_query($sql, $conn) or die("execute_dql_get_array {$sql} error:" . mysql_error());
        //$res=>$arr
        $row_arr = array();
        $i = 0;
        while ($row = mysql_fetch_assoc($res)) {
            $row_arr[$i++] = $row;
        }
        //释放资源
        mysql_free_result($res);
        if (!empty($conn)) {
            mysql_close($conn);
        }



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
        ?>
    </body>
</html>
