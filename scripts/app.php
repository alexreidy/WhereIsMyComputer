<?php

// add an ifset(flag) so errors don't show when people load x.php directly.

session_start();

$authorized = true;
$script = 'database.php';
require $script;

$id = $_SESSION['user'];

function clean($str) {
    return mysql_real_escape_string(
        strip_tags($str)
    );
}

switch ($_POST['action']) {
    case 'ADD_USER':
        $script = 'add-user.php';
        break;

    case 'SIGN_IN':
        $script = 'sign-in.php';
        break;

    case 'UPDATE_LOCATION':
        $script = 'update.php';
        break;
}

require $script;

?>