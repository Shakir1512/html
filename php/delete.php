<?php
$user = 'root';
$password = 'c0relynx';
$database = 'Shakir';
$servername = 'localhost:3306';
$mysqli = new mysqli($servername, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') ' .
        $mysqli->connect_error);
}
if (isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'Delete') {
    $current_id = $_REQUEST['id'];
    $query = "UPDATE `reg` SET deleted=1 WHERE id=$current_id;";
    $mysqli->query($query);
}
?>