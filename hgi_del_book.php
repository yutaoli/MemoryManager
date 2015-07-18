<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'BookService.class.php';

//Check Valid
if (!isset($_GET['bookid'])) {
    echo "²ÎÊý´íÎó£ºbookidÎª¿Õ";
    exit();
}


$bookService = new BookService();
$bookid = $_GET['bookid'];
$ret = $bookService->delBook($bookid);
if ((0 == $ret) || (1 == $ret)) {
    header("location: ok.php");
    exit();
}

header("location: error.php");
?>
