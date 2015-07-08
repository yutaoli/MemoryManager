<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=GB2312">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'MemoryManagerDb.class.php';
        //数据库中获取数据
        $memory_manager_db = new MemoryManagerDb();

        $tablename = "table_book";
        $sql = "select book_id, book_name, book_desc, detail, author, pic_url, video_url from $tablename ";
        $row_arr = $memory_manager_db->execute_dql_get_assoc_array($sql);



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
