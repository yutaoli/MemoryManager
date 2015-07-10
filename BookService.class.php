<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookService
 *
 * @author yutaoli <yutaoli@athena.com>
 */
require_once "TableServiceBase.class.php";
require_once "MemoryManagerDb.class.php";

class BookService extends TableServiceBase {

//put your code here

    private $tableName;
    private $memoryManagerDb;

    public function __construct() {
        parent::__construct();
        $this->tableName = "table_book";
        $this->memoryManagerDb = new MemoryManagerDb();
    }

    public function getFenyePage(FenyePageReq $fenyePageReq, FenyePageRsp $fenyePageRsp) {
        //Check Valid 
        $sql1 = "select count(*) from {$this->tableName}";
        $res1 = $this->memoryManagerDb->execute_dql_get_row_array($sql1);
        if (empty($res1)) {
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

        $sql2 = "select  * from {$this->tableName} limit {$startPos}, {$num}";
        $res2 = $this->memoryManagerDb->execute_dql_get_assoc_array($sql2);
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
            $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$i}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}'>{$i}</a>";
        }

        //下一页
        if ($fenyePageReq->nowPage != $totalPage) {
            $nowPage = $fenyePageReq->nowPage + 1;
            $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$nowPage}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}'>下一页</a>";
        }
        $navigator .="  当前第{$fenyePageReq->nowPage}页, 共{$totalPage}页</a>";

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
