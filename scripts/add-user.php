<?php

require 'auth.php';

$username = clean($_POST['username']);
$password = md5(clean($_POST['password']));

$db->query("
    INSERT INTO users (username, password)
    VALUES ('{$username}', '{$password}');
");

?>