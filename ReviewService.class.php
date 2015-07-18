<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReviewService
 *
 * @author yutaoli <yutaoli@athena.com>
 */
require_once 'TableServiceBase.class.php';
require_once 'MemoryManagerDb.class.php';
require_once 'Review.class.php';

class ReviewService extends TableServiceBase {

    //put your code here


    public function __construct() {
        parent::__construct();
        $this->tableName = "table_book_review";
        $this->dbName = new MemoryManagerDb();
    }

    /**
     * 
     * @param Review $review
     * @return type $res：-1：失败，0：成功
     */
    public function addReview(Review $review) {
        $sql = "insert into  {$this->tableName}(user_id, book_id, last_review) values('{$review->getUser_id()}', '{$review->getBook_id()}', '{$review->getLast_review()}')";
        $res = $this->dbName->execute_dml($sql);
        return $res;
    }

    /**
     * 
     * @param type $user_id
     * @param type $book_id
     * @return type $res，-1：失败，0：成功，1：没有行受到影响，如要删除$user_id, $book_id对不存在
     */
    public function delReview($user_id, $book_id) {
        $sql = "delete from {$this->tableName} where user_id = '{$user_id}' and book_id = '{$book_id}'";
        $res = $this->dbName->execute_dml($sql);
        return $res;
    }

    /**
     * 
     * @param Review $review
     * @return type $res：-1：失败，0：成功，1：成功，没有行被修改
     */
    public function modifyReview(Review $review) {
        $sql = "update $this->tableName set  last_review='{$review->getLast_review()}', times_reviewed='{$review->getTimes_reviewed()}',  note = '{$review->getNote()}' where user_id = {$review->getUser_id()} and book_id = {$review->getBook_id()}";
        $res = $this->dbName->execute_dml($sql);
        return $res;
    }

    /**
     * 
     * @param type $user_id
     * @param type $book_id
     * @return \Review ：一条复习记录
     */
    public function getReviewById($user_id, $book_id) {
        $sql = "select user_id, book_id, last_review, times_reviewed, left_days_next_review, note from {$this->tableName} where user_id = {$user_id} and book_id={$book_id}";
        $res = $this->dbName->execute_dql_get_assoc_array($sql);

        if (count($res) != 1) {
            echo "getReviewById error, count(res) = " . count($res) . ", user_id=" . $user_id . ", book_id=" . $book_id;
            return -1;
        }

        $review = new Review();
        $review->setBook_id($res[0]['book_id']);
        $review->setLast_review($res[0]['last_review']);
        $review->setLeft_days_next_review($res[0]['left_days_next_review']);
        $review->setNote($res[0]['note']);
        $review->setTimes_reviewed($res[0]['times_reviewed']);
        $review->setUser_id($res[0]['user_id']);

        return $review;
    }

    /**
     * 获取数据库分页数据
     */
    public function getReviewFenyePage(ReviewFenyePageReq $fenyePageReq, ReviewFenyePageRsp $fenyePageRsp) {
        //Check Valid 
        $sql1 = "select count(*) from {$this->tableName} where user_id = {$fenyePageReq->user_id}";
        $res1 = $this->dbName->execute_dql_get_row_array($sql1);
        if (!isset($res1)) {
            //没有数据
            return;
        }

        $totalRecord = $res1[0][0];
        $totalPage = ceil($totalRecord / $fenyePageReq->perPage);
        echo "totalpage[{$totalPage}], totalRecord[{$totalRecord}], num[{$fenyePageReq->perPage}]";

        if ($fenyePageReq->nowPage < 1 || $fenyePageReq->nowPage > $totalPage) {
            $fenyePageReq->nowPage = 1;
        }
        if ($fenyePageReq->displayPageCount < 1 || $fenyePageReq->displayPageCount > 10) {
            $fenyePageReq->displayPageCount = 10;
        }
        if ($fenyePageReq->perPage < 1 || $fenyePageReq->perPage > 100) {
            $fenyePageReq->perPage = 100;
        }



        //Get Req
        $startPos = ($fenyePageReq->nowPage - 1) * $fenyePageReq->perPage;
        $num = $fenyePageReq->perPage;

        $sql2 = "select user_id, A.book_id, last_review, times_reviewed, left_days_next_review, note, book_desc, book_name, detail, author, pic_url, video_url from " .
                "(select  * from {$this->tableName} where user_id = {$fenyePageReq->user_id} limit {$startPos}, {$num}) A,  table_book B " .
                "where A.book_id = B.book_id";
        $res2 = $this->dbName->execute_dql_get_assoc_array($sql2);
        //第一页下标是1


        $navigator = "";
        //上一页
        if ($fenyePageReq->nowPage != 1) {
            $nowPage = $fenyePageReq->nowPage - 1;
            $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$nowPage}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}'>上一页</a>";
        }

        //$startPage 到 $endPage
        $middleNPage = floor($fenyePageReq->displayPageCount / 2) + 1;
        $startPage = 1 + $fenyePageReq->nowPage - $middleNPage;
        $endPage = $fenyePageReq->nowPage + $fenyePageReq->displayPageCount - $middleNPage;
        if ($startPage >= 1) {
            $endPage = min($endPage, $totalPage);
            $startPage = min($startPage, 1 + $totalPage - $fenyePageReq->displayPageCount);
        } else {
            $endPage = min($fenyePageReq->displayPageCount, $totalPage);
            $startPage = 1;
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            if ($i != $fenyePageReq->nowPage) {
                $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$i}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}'>{$i}</a>";
            } else {
                $navigator .="  {$i}";
            }
        }

        //下一页
        if ($fenyePageReq->nowPage != $totalPage) {
            $nowPage = $fenyePageReq->nowPage + 1;
            $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$nowPage}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}'>下一页</a>";
        }
        $navigator .="  当前第{$fenyePageReq->nowPage}页, 共{$totalPage}页";

        //指定跳转到第几页
        $navigator .= "<br/>";
        $navigator .= "<form action='{$fenyePageReq->goUrl}' method='get'>";
        $navigator .= "跳转到：<input type='text' name='nowPage'/>";
        $navigator .= "<input type='submit' value='GO'/>";
        $navigator .= "</form>";

        //Set Rsp
        $fenyePageRsp->res = $res2;
        $fenyePageRsp->totalPage = $totalPage;
        $fenyePageRsp->navigator = $navigator;
    }

}

?>
