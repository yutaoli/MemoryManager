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
        <h1>�����鼮</h1>
        <hr/>
        <form action="hgi_add_book.php" method="post">
            <table>
                <tr><td>����</td><td><input type="text" name="bookname"/></td></tr>
                <tr><td>����</td><td><input type ="text" name="bookdesc"/></td></tr>
                <tr><td>����</td><td><input type ="text" name="detail"/></td></tr>
                <tr><td>����</td><td><input type ="text" name ="author"/></td></tr>
                <tr><td>ͼƬurl</td><td><input type="text" name="picurl"/></td></tr>
                <tr><td>��Ƶurl</td><td><input type="text" name="videourl"/></td></tr>
                <tr>
                    <td><input type="submit" name="submit" value="ȷ��"/></td>
                    <td><input type="reset" name="reset" value="������д"/></td>
                </tr>
            </table>


        </form>
    </body>
</html>
