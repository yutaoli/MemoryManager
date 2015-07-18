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
        require_once 'ReviewService.class.php';
        require_once 'Review.class.php';

        //Check Valid
        if (!isset($_GET['user_id'])) {
            echo "��������user_idΪ��";
            exit();
        }
        $user_id = $_GET['user_id'];
        if (!isset($_GET['book_id'])) {
            echo "��������book_idΪ��";
            exit();
        }
        $book_id = $_GET['book_id'];
        if (!isset($_GET['book_name'])) {
            echo "��������book_nameΪ��";
            exit();
        }
        $book_name = $_GET['book_name'];

        $reviewService = new ReviewService();
        $review = $reviewService->getReviewById($user_id, $book_id);
        ?>
        <img src="./images/add_book.jpg"/>
        <h1>�޸ĸ�ϰ��¼</h1>
        <hr/>
        <form action="hgi_modify_review.php" method="post">
            <table>

                <input type ="hidden" name ="user_id" value='<?php echo $review->getUser_id(); ?>'  />
                <input type="hidden" name="book_id" value='<?php echo $review->getBook_id(); ?>'  />
                <tr><td>book_name</td><td><input type="text" name="book_name" value="<?php echo $book_name; ?>" readonly="readonly"/></td></tr>      
                <tr><td>left_days_next_review</td><td><input type="text" name="left_days_next_review" value="<?php echo $review->getLeft_days_next_review(); ?>" readonly="readonly"/></td></tr>
                <tr><td>last_review</td><td><input type ="text" name="last_review" value="<?php echo $review->getLast_review(); ?>"/></td></tr>
                <tr><td>times_reviewed</td><td><input type ="text" name="times_reviewed" value="<?php echo $review->getTimes_reviewed(); ?>"/></td></tr>
                <tr><td>note</td><td><input type ="text" name ="note" value="<?php echo $review->getNote(); ?>"/></td></tr>
                <tr>
                    <td><input type="submit" name="submit" value="ȷ��"/></td>
                    <td><input type="reset" name="reset" value="������д"/></td>
                </tr>
            </table>


        </form>
    </body>
</html>
