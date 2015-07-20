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

}

?>
