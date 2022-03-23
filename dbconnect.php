<?php
try {
    $pdo = new PDO("mysql:dbname=tb231074db; host=localhost", "tb-231074", "rUrp8BEX63", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    $sql ="CREATE TABLE IF NOT EXISTS mydb(
    num INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(32) NOT NULL,
    mail TEXT NOT NULL,
    password TEXT NOT NULL
    );";
    $pdo -> query($sql);
}   catch (PDOException $e) {
    echo "データベース接続エラー　：".$e->getMessage();
}
?>
