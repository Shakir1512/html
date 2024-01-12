<?php
    $host = "10.10.10.10:3306";
    $username = "root";
    $password = "c0relynx";
    $dbname = "Shakir";

    $con = mysqli_connect($host, $username, $password, $dbname);
    if (!$con) {
        die("Connection failed! " . mysqli_connect_error());
    } else {
        echo "Connection Established Successfully";
    }
?>