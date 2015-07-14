<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=GB2312">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        require_once 'BookService.class.php';
        require_once 'Book.class.php';

        //Check Valid
        if (empty($_GET['book_id'])) {
            echo "参数错误：book_id为空";
            exit();
        }
        $bookid = $_GET['book_id'];
        $bookService = new BookService();
        $book = $bookService->getBookById($bookid);
        ?>
        <img src="./images/add_book.jpg"/>
        <h1>修改书籍</h1>
        <hr/>
        <form action="hgi_modify_book.php" method="post">
            <table>

                <input type="hidden" name="bookid" value="<?php echo $book->getBookId(); ?>"/>
                <tr><td>书名</td><td><input type="text" name="bookname" value="<?php echo $book->getBookName(); ?>"/></td></tr>
                <tr><td>描述</td><td><input type ="text" name="bookdesc" value="<?php echo $book->getBookDesc(); ?>"/></td></tr>
                <tr><td>详情</td><td><input type ="text" name="detail" value="<?php echo $book->getDetail(); ?>"/></td></tr>
                <tr><td>作者</td><td><input type ="text" name ="author" value="<?php echo $book->getAuthor(); ?>"/></td></tr>
                <tr><td>图片url</td><td><input type="text" name="picurl" value="<?php echo $book->getPic_url(); ?>"/></td></tr>
                <tr><td>视频url</td><td><input type="text" name="videourl" value="<?php echo $book->getVideo_url(); ?>"/></td></tr>
                <tr>
                    <td><input type="submit" name="submit" value="确定"/></td>
                    <td><input type="reset" name="reset" value="重新填写"/></td>
                </tr>
            </table>


        </form>
    </body>
</html>
