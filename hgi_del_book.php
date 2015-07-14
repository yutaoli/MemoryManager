<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'BookService.class.php';

//Check Valid
if (empty($_GET['bookid'])) {
    echo "²ÎÊý´íÎó£ºbookidÎª¿Õ";
    exit();
}


$bookService = new BookService();
$bookid = $_GET['bookid'];
$res = $bookService->delBook($bookid);
if ((0 == $res) || (1 == $res)) {
    header("location: ok.php");
    exit();
}

header("location: error.php");
?>
