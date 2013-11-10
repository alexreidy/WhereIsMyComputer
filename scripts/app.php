<?php

session_set_cookie_params(604800); // one week
session_start();

require 'database.php';

if (isset($_SESSION['user']))
    $id = $_SESSION['user'];

function clean($db, $str) {
    return mysqli_real_escape_string(
        $db, strip_tags($str)
    );
}

function get_from_user($db, $id, $column) {
    $result = $db->query("SELECT * FROM users WHERE id={$id};");
    if ($result) {
        $row = $result->fetch_array();
        return $row[$column];
    }
}

switch ($_POST['action']) {
    case 'ADD_USER':
        $username = clean($db, $_POST['username']);
        $password = md5(clean($db, $_POST['password']));

        $result = $db->query("
            INSERT INTO users (username, password)
            VALUES ('{$username}', '{$password}');
        ");

        if ($result) echo("OK");
        else echo("ERROR");
        break;

    case 'SIGN_IN':
        if (isset($id)) die("ERROR");

        $username = clean($db, $_POST['username']);
        $password = md5(clean($db, $_POST['password']));

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
        if (isset($id)) unset($_SESSION['user']);
        break;

    case 'CHECK_SESSION':
        if (isset($id) && $id > 0)
            echo("SET");
        break;

    case 'LATITUDE':
        if (isset($id)) echo(get_from_user($db, $id, 'latitude'));
        break;

    case 'LONGITUDE':
        if (isset($id)) echo(get_from_user($db, $id, 'longitude'));
        break;

    case 'UPDATE_LOCATION':
        $latitude = clean($db, $_POST['lat']);
        $longitude = clean($db, $_POST['lon']);

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