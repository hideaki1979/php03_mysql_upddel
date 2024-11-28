<?php
    // 書籍情報登録画面用PHP

    require_once("common/db.php");
    require_once("common/booksql.php");

    $pdo = getPdoConnection();  // DB接続
    $publishers = getPublisherAll($pdo);    // 出版社テーブル全件取得
    $message = "";
    session_start();    // セッション生成
    if(isset($_SESSION["message"])){
        $message = nl2br(htmlspecialchars($_SESSION["message"], ENT_QUOTES, "UTF-8"));
    }
    unset($_SESSION["message"]);   // セッション情報破棄
    // RAKUTEN BOOKS APIからのレスポンス情報を受け取る。
    
    $bookData = "";
    if(isset($_SESSION["jsonData"])) {
        $bookData = $_SESSION["jsonData"];  // セッションにあるRAKUTEN BOOKS APIからのレスポンス情報を格納
        // RAKUTEN BOOKS APIの発売日の設定値クリーニング
        $strDate = str_replace("頃", "",  $bookData["salesDate"]);
        $date = DateTime::createFromFormat("Y年m月d日", $strDate);
        $salesDate = $date->format('Y-m-d');
    } else {
        $salesDate = "";
        $bookData = ["publisherName" => ""];
    }
    unset($_SESSION["jsonData"]);   // セッション情報破棄

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
            <form class="registform" action="bookinsert.php" method="post">
                <p><?php echo $message; ?></p>
                <h2 class="screenname">書籍情報登録</h2>
                <div class="row regrow">
                    <label class="reglabel">ISBN：</label>
                    <input type="text" name="isbn" class="isbn" id="isbnno" 
                    value="<?= isset($bookData["isbn"]) ? htmlspecialchars($bookData["isbn"]) : '' ?>" required>
                    <input type="button" class="formbutton isbnbtn" id="isbnbtn" value="ISBN検索">
                </div>
                <div class="row regrow">
                    <label class="reglabel">書籍名：</label>
                    <input type="text" name="title" class="title" 
                    value="<?= isset($bookData["title"]) ? htmlspecialchars($bookData["title"]) : '' ?>" required>
                </div>
                <div class="row regrow">
                    <label class="reglabel">出版社：</label>
                    <select name="publisher" class="publisher">
                        <option value=""></option>
                        <?php foreach($publishers as $publisher): ?>
                            <?php if($bookData["publisherName"] == $publisher["publish_name"] ){ ?>
                                <option value=<?=$publisher["publish_cd"] ?> selected>
                                    <?=$publisher["publish_name"] ?>
                                </option>
                            <?php } else { ?>
                                <option value=<?=$publisher["publish_cd"] ?>>
                                <?=$publisher["publish_name"] ?>
                                </option>
                            <?php } ?>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="row regrow">
                    <label class="reglabel">著者名：</label>
                    <input type="text" name="author" class="author" 
                    value="<?= isset($bookData["author"]) ? htmlspecialchars($bookData["author"]) : '' ?>">
                </div>
                <div class="row regrow">
                    <label class="reglabel">値段：</label>
                    <input type="text" name="price" class="price" 
                    value="<?= isset($bookData["itemPrice"]) ? htmlspecialchars($bookData["itemPrice"]) : '' ?>">
                </div>
                <div class="row regrow">
                    <label class="reglabel">表紙URL：</label>
                    <input type="text" name="imageurl" class="imageurl" 
                    value="<?= isset($bookData["mediumImageUrl"]) ? htmlspecialchars($bookData["mediumImageUrl"]) : '' ?>">
                </div>
                <div class="row regrow">
                    <label class="reglabel">説明：</label>
                    <textarea name="caption" cols="60" rows="5" class="caption"><?= isset($bookData["itemCaption"]) ? htmlspecialchars($bookData["itemCaption"]) : '' ?></textarea>
                </div>
                <div class="row regrow">
                    <label class="reglabel">発売日：</label>
                    <input type="date" name="releasedate" class="releasedate" value="<?=$salesDate ?>">
                </div>
                <input type="submit" class="formbutton registbtn" value="登録">
            </form>
        </div>
    </div>
    <script>
        isbnbtn.addEventListener("click", function() {
            const isbnbtn = document.getElementById("isbnbtn");
            const isbnNo = document.getElementById("isbnno").value;
            location.href = `rakutenapi.php?isbn=${isbnNo}`;
        });
    </script>
</body>
</html>