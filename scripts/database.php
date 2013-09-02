<?php

$db = new mysqli('127.0.0.1', 'root', '');
$db_exists = $db->select_db('trackmypc');

if (! $db->connect_errno && ! $db_exists) {
    $db->query(" CREATE DATABASE trackmypc; ");
    $db->select_db('trackmypc');
    $db->query("
        CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50),
            password VARCHAR(50),
            latitude DOUBLE,
            longitude DOUBLE
        );
    ");
}

?>