<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'ReviewService.class.php';



//Check Valid
if (!isset($_POST['user_id'])) {
    echo "参数错误：user_id为空";
    exit();
}
if (!isset($_POST["book_id"])) {
    echo "参数错误：book_id为空";
    exit();
}

if (!isset($_POST["last_review"])) {
    echo "参数错误：last_review为空";
    exit();
}
if (!isset($_POST["times_reviewed"])) {
    echo "参数错误：times_reviewed为空";
    exit();
}
if (!isset($_POST["note"])) {
    echo "参数错误：note为空";
    exit();
}

$review = new Review();
$user_id = $_POST['user_id'];
$book_id = $_POST['book_id'];
$last_review = $_POST['last_review'];
$times_reviewed = $_POST['times_reviewed'];
$note = $_POST['note'];
$review->setBook_id($book_id);
$review->setLast_review($last_review);
$review->setNote($note);
$review->setTimes_reviewed($times_reviewed);
$review->setUser_id($user_id);

$reviewService = new ReviewService();
$ret = $reviewService->modifyReview($review);
if ((1 == $ret) || (0 == $ret)) {
    header("location: ok.php");
    exit();
}

header("location: error.php");
?>
