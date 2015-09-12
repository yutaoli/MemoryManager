<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book
 *
 * @author yutaoli <yutaoli@athena.com>
 */
require_once 'TableBase.class.php';

class Book extends TableBase {

    //put your code here
    private $bookId;
    private $bookName;
    private $bookDesc;
    private $detail;
    private $author;
    private $pic_url;
    private $video_url;
    private $reserv1;
    private $reserv2;
    private $reserv3;
    private $reserv4;
    private $reserv5;
    private $version;

    public function getBookId() {
        return $this->bookId;
    }

    public function setBookId($bookId) {
        $this->bookId = $bookId;
    }

    public function getBookName() {
        return $this->bookName;
    }

    public function setBookName($bookName) {
        $this->bookName = $bookName;
    }

    public function getBookDesc() {
        return $this->bookDesc;
    }

    public function setBookDesc($bookDesc) {
        $this->bookDesc = $bookDesc;
    }

    public function getDetail() {
        return $this->detail;
    }

    public function setDetail($detail) {
        $this->detail = $detail;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getPic_url() {
        return $this->pic_url;
    }

    public function setPic_url($pic_url) {
        $this->pic_url = $pic_url;
    }

    public function getVideo_url() {
        return $this->video_url;
    }

    public function setVideo_url($video_url) {
        $this->video_url = $video_url;
    }

    public function getReserv1() {
        return $this->reserv1;
    }

    public function setReserv1($reserv1) {
        $this->reserv1 = $reserv1;
    }

    public function getReserv2() {
        return $this->reserv2;
    }

    public function setReserv2($reserv2) {
        $this->reserv2 = $reserv2;
    }

    public function getReserv3() {
        return $this->reserv3;
    }

    public function setReserv3($reserv3) {
        $this->reserv3 = $reserv3;
    }

    public function getReserv4() {
        return $this->reserv4;
    }

    public function setReserv4($reserv4) {
        $this->reserv4 = $reserv4;
    }

    public function getReserv5() {
        return $this->reserv5;
    }

    public function setReserv5($reserv5) {
        $this->reserv5 = $reserv5;
    }

    public function getVersion() {
        return $this->version;
    }

    public function setVersion($version) {
        $this->version = $version;
    }

}

class ListBookFenyePageReq extends FenyePageReq {
    
}

class ListBookFenyePageRsp extends FenyePageRsp {
    
}

class SearchBookFenyePageReq extends FenyePageReq {

    public $keyWord; //¹Ø¼ü´ÊËÑË÷ÓÃ

}

class SearchBookFenyePageRsp extends FenyePageRsp {
    
}

?>
