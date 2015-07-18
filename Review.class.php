<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Review
 *
 * @author yutaoli <yutaoli@athena.com>
 */
require_once 'TableBase.class.php';

class Review extends TableBase {

    //put your code here
    private $user_id;
    private $book_id;
    private $last_review;
    private $times_reviewed;
    private $left_days_next_review;
    private $note;
    private $reserv1;
    private $reserv2;
    private $reserv3;
    private $reserv4;
    private $reserv5;
    private $version;

    public function getUser_id() {
        return $this->user_id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function getBook_id() {
        return $this->book_id;
    }

    public function setBook_id($book_id) {
        $this->book_id = $book_id;
    }

    public function getLast_review() {
        return $this->last_review;
    }

    public function setLast_review($last_review) {
        $this->last_review = $last_review;
    }

    public function getTimes_reviewed() {
        return $this->times_reviewed;
    }

    public function setTimes_reviewed($times_reviewed) {
        $this->times_reviewed = $times_reviewed;
    }

    public function getLeft_days_next_review() {
        return $this->left_days_next_review;
    }

    public function setLeft_days_next_review($left_days_next_review) {
        $this->left_days_next_review = $left_days_next_review;
    }

    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
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

class ReviewFenyePageReq extends FenyePageReq {

    public $user_id;

}

class ReviewFenyePageRsp extends FenyePageRsp {
    
}

?>
