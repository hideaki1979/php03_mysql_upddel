<?php
//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}


//画面遷移（リダイレクト）関数: $file_name画面名、$message画面に表示するメッセージ、$idテーブルのID（クエリパラメータにIDを入れない場合は0を指定する）
function scrRedirect($file_name, $message, $id){
    session_start();
    $_SESSION["message"] = $message;
    if($id === 0){
        header("Location: $file_name");
        exit();
    } else {
        header("Location: $file_name?&id=".$id);
        exit();
    }
    
}
?>