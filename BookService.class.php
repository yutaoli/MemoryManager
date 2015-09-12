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
require_once 'Book.class.php';

class BookService extends TableServiceBase {

//put your code here

    public function __construct() {
        parent::__construct();
        $this->tableName = "table_book";
        $this->dbName = new MemoryManagerDb();
    }

    public function addBook($bookname, $bookdesc, $detail, $author, $picurl, $videourl) {
        $sql = "insert into  {$this->tableName}(book_name, book_desc, detail, author, pic_url, video_url) values('$bookname', '$bookdesc', '$detail', '$author', '$picurl', '$videourl')";
        $res = $this->dbName->execute_dml($sql);
        return $res;
    }

    public function delBook($id) {
        $sql = "delete from {$this->tableName} where book_id = {$id}";
        $res = $this->dbName->execute_dml($sql);
        return $res;
    }

    public function modifyBook($bookid, $bookname, $bookdesc, $detail, $author, $picurl, $videourl) {
        $sql = "update {$this->tableName} set book_name='{$bookname}', book_desc = '{$bookdesc}', detail ='{$detail}', author='{$author}', pic_url='{$picurl}', video_url='{$videourl}' where book_id = {$bookid}";
        $res = $this->dbName->execute_dml($sql);
        return $res;
    }

    public function getBookById($id) {
        $sql = "select * from $this->tableName where book_id = $id";
        $res = $this->dbName->execute_dql_get_assoc_array($sql);

        if (count($res) != 1) {
            echo "getBookById error, count(res) = " . count($res) . ", id=" . $id;
            return -1;
        }

        $book = new Book();
        $book->setAuthor($res[0]['author']);
        $book->setBookDesc($res[0]['book_desc']);
        $book->setBookId($res[0]['book_id']);
        $book->setBookName($res[0]['book_name']);
        $book->setDetail($res[0]['detail']);
        $book->setPic_url($res[0]['pic_url']);
        $book->setVersion($res[0]['version']);
        $book->getVideo_url($res[0]['video_url']);
        return $book;
    }

    /**
     * ��ȡ���ݿ��ҳ����
     */
    public function listBookFenyePage(ListBookFenyePageReq $fenyePageReq, ListBookFenyePageRsp $fenyePageRsp) {

        //Check Valid 
        $sql1 = "select count(*) from {$this->tableName}";
        $res1 = $this->dbName->execute_dql_get_row_array($sql1);
        if (!isset($res1)) {
            //û������
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
        $res2 = $this->dbName->execute_dql_get_assoc_array($sql2);
        //��һҳ�±���1


        $navigator = "";
        //��һҳ
        if ($fenyePageReq->nowPage != 1) {
            $nowPage = $fenyePageReq->nowPage - 1;
            $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$nowPage}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}'>��һҳ</a>";
        }

        //$startPage �� $endPage
        if ($totalPage == 0) {
            $startPage = 0;
            $endPage = -1;
        } else {
            $middleNPage = floor($fenyePageReq->displayPageCount / 2) + 1;
            $startPage = 1 + $fenyePageReq->nowPage - $middleNPage;
            $endPage = $fenyePageReq->nowPage + $fenyePageReq->displayPageCount - $middleNPage;
            //��$startPage��1��$endPage��$totalPage�Ĵ�С��ϵ��4������
            if ($startPage < 1) {
                if ($endPage < $totalPage) {
                    $startPage = 1;
                    $endPage = min($totalPage, $fenyePageReq->displayPageCount);
                } else {
                    $startPage = 1;
                    $endPage = $totalPage;
                }
            } else {
                if ($endPage < $totalPage) {
                    
                } else {
                    $endPage = $totalPage;
                    $startPage = max(1, 1 + $endPage - $fenyePageReq->displayPageCount);
                }
            }
        }


        for ($i = $startPage; $i <= $endPage; $i++) {
            if ($i != $fenyePageReq->nowPage) {
                $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$i}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}'>{$i}</a>";
            } else {
                $navigator .="  {$i}";
            }
        }

        //��һҳ
        if ($fenyePageReq->nowPage < $totalPage) {
            $nowPage = $fenyePageReq->nowPage + 1;
            $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$nowPage}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}'>��һҳ</a>";
        }
        $navigator .="  ��ǰ��{$fenyePageReq->nowPage}ҳ, ��{$totalPage}ҳ";

        //ָ����ת���ڼ�ҳ
        $navigator .= "<br/>";
        $navigator .= "<form action='{$fenyePageReq->goUrl}' method='get'>";
        $navigator .= "��ת����<input type='text' name='nowPage'/>";
        $navigator.="<input type='hidden' name='perPage' value='{$fenyePageReq->perPage}' />";
        $navigator.="<input type = 'hidden' name='displayPageCount' value='{$fenyePageReq->displayPageCount}' />";
        $navigator .= "<input type='submit' value='GO'/>";
        $navigator .= "</form>";

        //Set Rsp
        $fenyePageRsp->res = $res2;
        $fenyePageRsp->totalPage = $totalPage;
        $fenyePageRsp->navigator = $navigator;
    }

    /**
     * �ؼ���������ȡ���ݿ��ҳ����
     */
    public function searchBookFenyePage(SearchBookFenyePageReq $fenyePageReq, SearchBookFenyePageRsp $fenyePageRsp) {
        //book�б�������"book_name"
        //Check Valid 
        $sql1 = "select count(*) from {$this->tableName} where book_name like binary '%{$fenyePageReq->keyWord}%' ";
        $res1 = $this->dbName->execute_dql_get_row_array($sql1);
        if (!isset($res1)) {
            //û������
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

        $sql2 = "select  * from {$this->tableName} where book_name like binary '%{$fenyePageReq->keyWord}%' limit {$startPos}, {$num}";
        $res2 = $this->dbName->execute_dql_get_assoc_array($sql2);

        //��һҳ�±���1
        echo "totalpage[{$totalPage}], totalRecord[{$totalRecord}], num[{$fenyePageReq->perPage}]";

        $navigator = "";
        //��һҳ
        if ($fenyePageReq->nowPage != 1) {
            $nowPage = $fenyePageReq->nowPage - 1;
            $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$nowPage}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}&keyWord={$fenyePageReq->keyWord}'>��һҳ</a>";
        }

        //$startPage �� $endPage
        if ($totalPage == 0) {
            $startPage = 0;
            $endPage = -1;
        } else {
            $middleNPage = floor($fenyePageReq->displayPageCount / 2) + 1;
            $startPage = 1 + $fenyePageReq->nowPage - $middleNPage;
            $endPage = $fenyePageReq->nowPage + $fenyePageReq->displayPageCount - $middleNPage;
            //��$startPage��1��$endPage��$totalPage�Ĵ�С��ϵ��4������
            if ($startPage < 1) {
                if ($endPage < $totalPage) {
                    $startPage = 1;
                    $endPage = min($totalPage, $fenyePageReq->displayPageCount);
                } else {
                    $startPage = 1;
                    $endPage = $totalPage;
                }
            } else {
                if ($endPage < $totalPage) {
                    
                } else {
                    $endPage = $totalPage;
                    $startPage = max(1, 1 + $endPage - $fenyePageReq->displayPageCount);
                }
            }
        }

        for ($i = $startPage; $i <= $endPage; $i++) {
            if ($i != $fenyePageReq->nowPage) {
                $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$i}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}&keyWord={$fenyePageReq->keyWord}'>{$i}</a>";
            } else {
                $navigator .="  {$i}";
            }
        }

        //��һҳ
        if ($fenyePageReq->nowPage < $totalPage) {
            $nowPage = $fenyePageReq->nowPage + 1;
            $navigator .="  <a href='{$fenyePageReq->goUrl}?nowPage={$nowPage}&perPage={$fenyePageReq->perPage}&displayPageCount={$fenyePageReq->displayPageCount}&keyWord={$fenyePageReq->keyWord}'>��һҳ</a>";
        }
        $navigator .="  ��ǰ��{$fenyePageReq->nowPage}ҳ, ��{$totalPage}ҳ";

        //ָ����ת���ڼ�ҳ
        $navigator .= "<br/>";
        $navigator .= "<form action='{$fenyePageReq->goUrl}' method='get'>";
        $navigator .= "��ת����<input type='text' name='nowPage'/>";
        $navigator.="<input type='hidden' name='perPage' value='{$fenyePageReq->perPage}' />";
        $navigator.="<input type = 'hidden' name='displayPageCount' value='{$fenyePageReq->displayPageCount}' />";
        $navigator.="<input type = 'hidden' name='keyWord' value='{$fenyePageReq->keyWord}' />";
        $navigator .= "<input type='submit' value='GO'/>";
        $navigator .= "</form>";

        //Set Rsp
        $fenyePageRsp->res = $res2;
        $fenyePageRsp->totalPage = $totalPage;
        $fenyePageRsp->navigator = $navigator;
    }

    /**
     * ��ȡ��ҳ���ݣ�ʵ��listBookFenyePage()��searchBookFenyePage()�����߼�
     */
    public function getFenyePage(FenyePageReq $fenyePageReq, FenyePageRsp $fenyePageRsp) {
        
    }

}

?>
