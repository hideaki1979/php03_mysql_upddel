<?php
    // 書籍情報変更画面用PHP
    require_once("common/db.php");
    require_once("common/booksql.php");

    $pdo = getPdoConnection();  // DB接続
    $publishers = getPublisherAll($pdo);    // 出版社テーブル全件取得
    $book = getBookKey($pdo, $_GET["id"]);
    $message = "";
    session_start();
    if(isset($_SESSION["message"])){
        $message = nl2br(htmlspecialchars($_SESSION["message"], ENT_QUOTES, "UTF-8"));
    }
    unset($_SESSION["message"]);
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
            <form class="registform" action="bookupdate.php" method="post">
                <p><?php echo $message; ?></p>
                <h2 class="screenname">書籍情報変更</h2>
                <div class="row regrow">
                    <label class="reglabel">書籍名：</label>
                    <input type="text" name="title" class="title" value="<?=$book["title"] ?>" required>
                </div>
                <div class="row regrow">
                    <label class="reglabel">出版社：</label>
                    <select name="publisher" class="publisher">
                        <option value=""></option>
                        <?php foreach($publishers as $publisher): ?>
                            <?php if($book["publisher"] == $publisher["publish_cd"] ){ ?>
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
                    <input type="text" name="author" class="author" value="<?=$book["author"] ?>">
                </div>
                <div class="row regrow">
                    <label class="reglabel">値段：</label>
                    <input type="text" name="price" class="price" value="<?=$book["price"] ?>">
                </div>
                <div class="row regrow">
                    <label class="reglabel">表紙URL：</label>
                    <input type="text" name="imageurl" class="imageurl" value="<?=$book["imageurl"] ?>">
                </div>
                <div class="row regrow">
                    <label class="reglabel">説明：</label>
                    <textarea name="caption" cols="60" rows="5" class="caption"><?=$book["caption"] ?></textarea>
                </div>
                <div class="row regrow">
                    <label class="reglabel">発売日：</label>
                    <input type="date" name="releasedate" class="releasedate" value="<?=$book["releasedate"] ?>">
                </div>
                <input type="submit" class="formbutton update" value="更新">
                <input type="hidden" name="id" value="<?=$book["id"] ?>">
            </form>
        </div>
    </div>
</body>
</html>