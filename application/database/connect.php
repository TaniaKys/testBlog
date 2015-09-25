<?php

$mysqli = new mysqli(HOST, USER, PASSWORD);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$mysqli->query("CREATE DATABASE IF NOT EXISTS ".DB);
$mysqli->select_db(DB);
$mysqli->query("CREATE TABLE IF NOT EXISTS posts (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, title VARCHAR(255), text_preview VARCHAR(255), main_text LONGTEXT, date VARCHAR(255), image LONGTEXT)");
$mysqli->query("SET NAMES 'utf8'");
?>
