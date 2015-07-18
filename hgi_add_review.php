<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Review.class.php';
require_once 'ReviewService.class.php';



//Check Valid
$user_id = $_POST['user_id'];
echo $user_id;

if (!isset($user_id)) {
    echo "��������user_idΪ��";
    exit();
} elseif
 (!is_numeric($user_id)) {
    echo "��������user_idΪ������";
    exit();
} elseif ($user_id <= 0) {
    echo "��������user_id<=0";
    exit();
}


$book_id = $_POST['book_id'];
if (!isset($book_id)) {
    echo "��������book_idΪ��";
    exit();
} elseif (!is_numeric($book_id)) {
    echo "��������book_idΪ������";
    exit();
} elseif ($book_id <= 0) {
    echo "��������book_id<=0";
    exit();
}

//Process
$review = new Review();
$review->setUser_id($user_id);
$review->setBook_id($book_id);
$review->setLast_review(time());

$reviewService = new ReviewService();
$ret = $reviewService->addReview($review);
if ($ret < 0) {
    header("location: error.php");
    exit();
} elseif (0 == $ret) {
    header("location: ok.php");
}
?>
