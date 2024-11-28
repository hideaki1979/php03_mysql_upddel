<?php
    // RAKUTEN BOOKS API取得用PHP
    require_once("common/config.php");  // 共通定数用PHP
    require_once dirname(__FILE__) . '/autoload.php'; // RAKUTEN API SDK用PHP
    
    // 検索用ISBN番号セット
    $isbn = $_GET["isbn"];

    // RAKUTEN BOOKS API用クライアント生成
    $client = new RakutenRws_Client();
    $client ->setApplicationId(RAKUTEN_APP_ID);

    // RAKUTEN BOOKS API 実行（ISBN番号で検索）
    $response = $client ->execute('BooksTotalSearch', array(
        'isbnjan' => $isbn
    ));
    
    if($response->isOk()) {
        foreach($response as $item) {
            // print_r($item);
            $bookData = $item;
        }
    } else {
        echo 'Error:'.$response->getMessage();
    }

    // APIのレスポンスをセッション格納してregist.phpに渡す。
    session_start();    // セッションを作成
    $_SESSION["jsonData"] = $bookData;  // APIレスポンスをセッションに格納。

    header("Location: regist.php"); // 書籍情報登録処理に戻る。
    exit();

?>