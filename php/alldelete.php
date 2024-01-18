<?php
$user = 'root';
$password = 'c0relynx';
$database = 'Shakir';
$servername = 'localhost:3306';
$mysqli = new mysqli($servername, $user, $password, $database);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["mode"] == "AllDelete") {
        $ids = $_POST["ids"];
        $query = ("UPDATE `reg` SET deleted=1 WHERE id IN ($ids)");
        $mysqli->query($query);
    }
}
?>