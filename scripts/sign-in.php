<?php

require 'auth.php';

if (isset($_SESSION['user'])) die();

$username = clean($_POST['username']);
$password = md5(clean($_POST['password']));

$result = $db->query("
    SELECT * FROM users
    WHERE username='{$username}' AND password='{$password}';
");

if ($result) {
    $row = $result->fetch_array();
    $_SESSION['user'] = $row['id'];
    echo($_SESSION['user']);
}

?>