<?php

$db_name = 'whereismycomputer';
$db = new mysqli('127.0.0.1', 'root', '');
$db_exists = $db->select_db($db_name);

if (! $db->connect_errno && ! $db_exists) {
    $db->query("CREATE DATABASE ". $db_name .";");
    $db->select_db($db_name);
    $db->query("
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) UNIQUE,
            password VARCHAR(50),
            latitude DOUBLE,
            longitude DOUBLE
        );
    ");
}

?>