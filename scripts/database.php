<?php

$db = new mysqli('127.0.0.1', 'root', '');
$db_exists = $db->select_db('locatemypc');

if (! $db->connect_errno && ! $db_exists) {
    $db->query(" CREATE DATABASE locatemypc; ");
    $db->select_db('locatemypc');
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