<?php

session_start();

require 'database.php';

if (isset($_SESSION['user']))
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

        $result = $db->query("
            INSERT INTO users (username, password)
            VALUES ('{$username}', '{$password}');
        ");

        if ($result) echo("OK");
        else echo("ERROR");
        break;

    case 'SIGN_IN':
        if (isset($_SESSION['user'])) die("ERROR");

        $username = clean($_POST['username']);
        $password = md5(clean($_POST['password']));

        $result = $db->query("
            SELECT * FROM users
            WHERE username='{$username}'
            AND password='{$password}';
        ");

        if ($result) {
            $row = $result->fetch_array();
            $id = $row['id'];
            if ($id) {
                $_SESSION['user'] = $id;
                echo("OK");
                break;
            }
        }
        echo("ERROR");
        break;

    case 'SIGN_OUT':
        if (isset($_SESSION['user']))
            unset($_SESSION['user']);
        break;

    case 'CHECK_SESSION':
        if (isset($id) && $id > 0)
            echo("SET");
        break;

    case 'UPDATE_LOCATION':
        $latitude = clean($_POST['lat']);
        $longitude = clean($_POST['lon']);

        if (isset($id)) {
            $db->query("
                UPDATE users SET latitude={$latitude},
                longitude={$longitude}
                WHERE id={$id};
            ");
            echo("OK");
        }
        echo("ERROR");
        break;
}


?>