<?php 
    // 書籍情報登録用PHP
    require_once("common/db.php");
    require_once("common/booksql.php");

    $pdo = getPdoConnection();  // DB接続
    $message = bookUpdate($pdo, $_POST);    //書籍情報更新
?>