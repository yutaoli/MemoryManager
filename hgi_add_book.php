<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'BookService.class.php';

$bookService = new BookService();

//Check Valid
if (empty($_POST["bookname"])) {
    echo "��������booknameΪ��";
    exit();
}
if (empty($_POST["bookdesc"])) {
    echo "��������bookdescΪ��";
    exit();
}
if (empty($_POST["detail"])) {
    echo "��������detailΪ��";
    exit();
}
if (empty($_POST["author"])) {
    echo "��������authorΪ��";
    exit();
}
$bookname = $_POST["bookname"];
$bookdesc = $_POST["bookdesc"];
$detail = $_POST["detail"];
$author = $_POST["author"];
$picurl = $_POST["picurl"];
$videourl = $_POST["videourl"];


$res = $bookService->addBook($bookname, $bookdesc, $detail, $author, $picurl, $videourl);

if ((1 == $res) || (0 == $res)) {
    header("location: ok.php");
    exit();
}

header("location: error.php");
?>
