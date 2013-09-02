<?php

session_start();

require 'database.php';

$id = $_SESSION['user'];

function clean($str) {
    return mysql_real_escape_string(
        strip_tags($str)
    );
}

switch ($_POST['action']) {
    case 'ADD_USER':
        $username = clean($_POST['username']);
        $password = md5(clean($_POST['password']));

        $db->query("
            INSERT INTO users (username, password)
            VALUES ('{$username}', '{$password}');
        ");
        break;

    case 'SIGN_IN':
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
        break;

    case 'UPDATE_LOCATION':
        $latitude = clean($_POST['lat']);
        $longitude = clean($_POST['lon']);

        $db->query("
            UPDATE users SET latitude={$latitude},
            longitude={$longitude}
            WHERE id={$id};
        ");
        break;
}


?>