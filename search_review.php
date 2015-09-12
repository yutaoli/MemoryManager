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
        require_once "Review.class.php";
        require_once 'ReviewService.class.php';

        // 'Asia/Shanghai' Ϊ�Ϻ�ʱ�� 
        ini_set('date.timezone', 'Asia/Shanghai');


        //TODO�������û���¼�߼�
        $user_id = 1; //yutaoli
        //checkinput
        $reviewService = new ReviewService();

        $fenyePageReq = new SearchReviewFenyePageReq();
        $fenyePageReq->user_id = $user_id;
        $fenyePageReq->perPage = 10;
        if (!!isset($_GET['nowPage'])) {
            $fenyePageReq->nowPage = $_GET['nowPage'];
        } else {
            $fenyePageReq->nowPage = 1;
        }
        $fenyePageReq->displayPageCount = 10;
        $fenyePageReq->goUrl = 'search_review.php';
        if (isset($_GET['keyWord']) && $_GET['keyWord'] != "") {
            $fenyePageReq->keyWord = urldecode($_GET['keyWord']);
           // echo "keyWord[{$fenyePageReq->keyWord}]";
        } else {
            echo "param error, keyWord empty.";
            exit();
        }


        //process
        echo "<h1>��ϰ�б�</h1>";
        echo "<hr/>";

        //������
        echo "<div id = 'search-field'>";
        echo "<form action='search_review.php' method='get' >";
        echo "<input type = 'text' name='keyWord'/>";
        echo "<button type = 'submit'>������</button>";
        echo "</form>";
        echo "</div>";


        //����չʾ��ÿ��д5��<th></th>
        echo "<table border='1px' bordercolor='green' celspacing='0px' width='700px'> ";
        echo "<tr>";
        echo "<th>���</th><th>user_id</th><th>book_id</th><th>book_name</th><th>left_days_next_review</th><th>last_review</th>";
        echo "<th>times_reviewed</th><th>note</th><th>�Ѹ�ϰ</th><th>ɾ��</th><th>�޸�</th>";
        echo "</tr>";



        $fenyePageRsp = new SearchReviewFenyePageRsp();
        $reviewService->searchReviewFenyePage($fenyePageReq, $fenyePageRsp);
        $row_arr = $fenyePageRsp->res;


        $time_stamp_now = time();
        for ($i = 0; $i < count($row_arr); $i++) {
            $num = ($fenyePageReq->nowPage - 1) * $fenyePageReq->perPage + $i + 1;
            $row = $row_arr[$i];
            $date_last_review = date('Y-m-d H:i:s', $row['last_review']);
            //�԰���Ϊ��λ�����˽��ȸУ��������ھ��븴ϰ��ʱ��Ҫ��ȷ�����죬���ȥ��1.2�죬����Ϊ��1�죻��ȥ��1.5�죬����Ϊ��1.5�죻��ȥ��1.6�죬����Ϊ��1.5�죻��ȥ��2�죬����2�졣
            //��f(1.2)=1, f(1.5)=1.5, f(1.6)=1.5, f(2)=2������f(x)=floor(2*x)/2;
            $left_days_next_review = ReviewService::$review_cycle_array[$row['times_reviewed']] - floor(2 * ($time_stamp_now - $row['last_review']) / 86400) / 2;
            echo "<tr>";
            if ($left_days_next_review > 0) {
                echo "<td>{$num}</td><td>{$row['user_id']}</td><td>{$row['book_id']}</td><td>{$row['book_name']}</td><td>{$left_days_next_review}</td><td>{$date_last_review}</td>";
            } else {//��ϰ��ֹʱ�䵽��
                echo "<td>{$num}</td><td>{$row['user_id']}</td><td>{$row['book_id']}</td><td>{$row['book_name']}</td><td><font color='#FF0000' size=5>{$left_days_next_review}</font></td><td>{$date_last_review}</td>";
            }
            echo "<td>{$row['times_reviewed']}</td><td>{$row['note']}</td>";

            //�Ѹ�ϰ����POST�ύ
            $next_times_reviewed = $row['times_reviewed'] + 1;
            echo "<td>";
            echo "<form action='hgi_modify_review.php' method='post' name='form_hgi_modify_review{$num}'>";
            echo "<input type='hidden' name='user_id' value='{$row['user_id']}' />";
            echo "<input type='hidden' name='book_id' value='{$row['book_id']}' />";
            echo "<input type='hidden' name='last_review' value='{$time_stamp_now}'  />";
            echo "<input type='hidden' name='times_reviewed' value='{$next_times_reviewed}' />";
            echo "<input type='hidden' name='note' value='{$row['note']}' />";
            echo "<a href='javascript:document.form_hgi_modify_review{$num}.submit()'>�Ѹ�ϰ</a>";
            echo "</form>";
            echo "</td>";

            echo "<td><a onclick='return confirmDel(\"{$row['book_name']}\")' href='hgi_del_review.php?user_id={$row['user_id']}&book_id={$row['book_id']}'>ɾ��</a></td>";
            echo "<td><a  href='modify_review.php?user_id={$row['user_id']}&book_id={$row['book_id']}&book_name={$row['book_name']}'>�޸�</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        //���������
        echo $fenyePageRsp->navigator;
        ?>
    </body>
</html>
