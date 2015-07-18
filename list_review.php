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
        require_once "Review.class.php";
        require_once 'ReviewService.class.php';

        // 'Asia/Shanghai' Ϊ�Ϻ�ʱ�� 
        ini_set('date.timezone', 'Asia/Shanghai');


        echo "<h1>��ϰ�б�</h1>";
        echo "<hr/>";


        echo "<br/><a href='search_review.php'>����</a>";


        //����չʾ��ÿ��д5��<th></th>
        echo "<table border='1px' bordercolor='green' celspacing='0px' width='700px'> ";
        echo "<tr>";
        echo "<th>���</th><th>user_id</th><th>book_id</th><th>book_name</th><th>left_days_next_review</th><th>last_review</th>";
        echo "<th>times_reviewed</th><th>note</th><th>ɾ��</th><th>�޸�</th>";
        echo "</tr>";

        //��ϰѭ�����ڣ����һ�θ�ϰ�ǵڶ��죬�����һ�죬�ڶ��θ�ϰ�ǵ�һ�θ�ϰ��7���������ơ���
        $review_cycle_array = array(1, 7, 15, 30, 60, 150, 300);

        function review_cmp($a, $b) {
            global $review_cycle_array;

            $time_stamp_now = time();
            $a_left_days_next_review = $review_cycle_array[$a['times_reviewed']] - ceil(($time_stamp_now - $a['last_review']) / 86400);
            $b_left_days_next_review = $review_cycle_array[$b['times_reviewed']] - ceil(($time_stamp_now - $b['last_review']) / 86400);
            if ($a_left_days_next_review == $b_left_days_next_review) {
                return 0;
            }

            return $a_left_days_next_review < $b_left_days_next_review ? -1 : 1;
        }

        //TODO�������û���¼�߼�
        $user_id = 1; //yutaoli
        //���ݿ���л�ȡ����
        $reviewService = new ReviewService();

        $fenyePageReq = new ReviewFenyePageReq();
        $fenyePageReq->user_id = $user_id;
        $fenyePageReq->displayPageCount = 10;
        $fenyePageReq->goUrl = 'list_review.php';
        if (!!isset($_GET['nowPage'])) {
            $fenyePageReq->nowPage = $_GET['nowPage'];
        } else {
            $fenyePageReq->nowPage = 1;
        }
        $fenyePageReq->perPage = 10;

        $fenyePageRsp = new ReviewFenyePageRsp();
        $reviewService->getReviewFenyePage($fenyePageReq, $fenyePageRsp);
        $row_arr = $fenyePageRsp->res;
        //�������´θ�ϰʱ����������
        usort($row_arr, 'review_cmp');

        $time_stamp_now = time();
        for ($i = 0; $i < count($row_arr); $i++) {
            $num = ($fenyePageReq->nowPage - 1) * $fenyePageReq->perPage + $i + 1;
            $row = $row_arr[$i];
            $date_last_review = date('Y-m-d H:i:s', $row['last_review']);
            $left_days_next_review = $review_cycle_array[$row['times_reviewed']] - ceil(($time_stamp_now - $row['last_review']) / 86400);
            echo "<tr>";
            if ($left_days_next_review >= 0) {
                echo "<td>{$num}</td><td>{$row['user_id']}</td><td>{$row['book_id']}</td><td>{$row['book_name']}</td><td>{$left_days_next_review}</td><td>{$date_last_review}</td>";
            } else {//��ϰ��ֹʱ�䵽��
                echo "<td>{$num}</td><td>{$row['user_id']}</td><td>{$row['book_id']}</td><td>{$row['book_name']}</td><td><font color='#FF0000' size=5>{$left_days_next_review}</font></td><td>{$date_last_review}</td>";
            }
            echo "<td>{$row['times_reviewed']}</td><td>{$row['note']}</td>";
            echo "<td><a onclick='return confirmDel(\"{$row['book_id']}\")' href='hgi_del_review.php?user_id={$row['user_id']}&book_id={$row['book_id']}'>ɾ��</a></td>";
            echo "<td><a  href='modify_review.php?user_id={$row['user_id']}&book_id={$row['book_id']}&book_name={$row['book_name']}'>�޸�</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        //���������
        echo $fenyePageRsp->navigator;
        ?>
    </body>
</html>
