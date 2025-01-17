<?php
    // 書籍情報一括登録画面用PHP
    session_start();    // セッションを作成
    $message = "";
    if(isset($_SESSION["message"])){
        $message = nl2br(htmlspecialchars($_SESSION["message"], ENT_QUOTES, "UTF-8"));
    } else {
        $message = "";
    }
    unset($_SESSION["message"]);   // セッション情報破棄    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include("inc/head.html") ?>
</head>
<body>
    <?php include("inc/header.html") ?>
    <div class="main">
        <div class="container">
            
            <form class="uploadform" action="bookbulkinsert.php" method="post" enctype="multipart/form-data">
                <p><?php echo $message; ?></p>
                <h2 class="uploadguide">※アップロードしたいファイル（CSV）を指定</h2>
                <input type="file" name="bookdata" accept="csv" required>
                <input type="submit" class="formbutton uploadbtn" value="アップロード">
            </form>
        </div>
    </div>
    
</body>
</html>