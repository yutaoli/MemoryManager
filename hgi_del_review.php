<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'ReviewService.class.php';

//Check Valid
if (!isset($_GET['user_id'])) {
    echo "��������user_idΪ��";
    exit();
}
if (!isset($_GET['book_id'])) {
    echo "��������book_idΪ��";
    exit();
}


$reviewService = new ReviewService();
$user_id = $_GET['user_id'];
$book_id = $_GET['book_id'];
$ret = $reviewService->delReview($user_id, $book_id);
if ((0 == $ret) || (1 == $ret)) {
    header("location: ok.php");
    exit();
}

header("location: error.php");
?>
