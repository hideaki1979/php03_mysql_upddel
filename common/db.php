<?php
    // DB接続用PHP
    function getPdoConnection() {
        $pdo = null;

        $DB_NAME = "gs_db_php02";
        $DB_HOST = "localhost";
        $DB_CHARSET = "utf8";
        $DB_USER = "root";
        $DB_PASSWORD = "";
        
        //DB接続
        try {
            //Password:MAMP='root',XAMPP=''
            $pdo = new PDO('mysql:dbname='.$DB_NAME.';charset='.$DB_CHARSET.';host='.$DB_HOST, $DB_USER, $DB_PASSWORD);
        } catch (PDOException $e) {
            exit('DBConnectError:'.$e->getMessage());
        }
        return $pdo;
    }
?>