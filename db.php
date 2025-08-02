<?php
$host = 'localhost';
$db_user = 'team12';
$db_pass = 'team12';
$db_name = 'waph_team12';

$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>