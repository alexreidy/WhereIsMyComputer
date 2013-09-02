<?php

require 'auth.php';

$latitude = clean($_POST['lat']);
$longitude = clean($_POST['lon']);

$db->query("
    UPDATE users SET latitude={$latitude}, longitude={$longitude}
    WHERE id={$id};
");

?>