<?php 
    // 書籍情報登録用PHP
    require_once("common/db.php");
    require_once("common/booksql.php");

    $pdo = getPdoConnection();  // DB接続
    $message = bookDelete($pdo, $_GET);    //書籍情報削除
?>