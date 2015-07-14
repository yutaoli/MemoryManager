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
        ?>
        <img src="./images/add_book.jpg"/>
        <h1>新增书籍</h1>
        <hr/>
        <form action="hgi_add_book.php" method="post">
            <table>
                <tr><td>书名</td><td><input type="text" name="bookname"/></td></tr>
                <tr><td>描述</td><td><input type ="text" name="bookdesc"/></td></tr>
                <tr><td>详情</td><td><input type ="text" name="detail"/></td></tr>
                <tr><td>作者</td><td><input type ="text" name ="author"/></td></tr>
                <tr><td>图片url</td><td><input type="text" name="picurl"/></td></tr>
                <tr><td>视频url</td><td><input type="text" name="videourl"/></td></tr>
                <tr>
                    <td><input type="submit" name="submit" value="确定"/></td>
                    <td><input type="reset" name="reset" value="重新填写"/></td>
                </tr>
            </table>


        </form>
    </body>
</html>
