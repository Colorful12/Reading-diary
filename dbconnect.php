<?php
try {
    $pdo = new PDO(セキュリティの関係で削除しています);
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
