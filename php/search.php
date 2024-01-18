<?php
$user = 'root';
$password = 'c0relynx';
$database = 'Shakir';
$servername = 'localhost:3306';
$mysqli = new mysqli($servername, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_REQUEST['keyword'];
    $WHERE = "";
    if ($query != null) {
        $raw_results = "SELECT * FROM reg WHERE deleted=0 AND (`first_name` LIKE '%" . $query . "%') OR (`last_name` LIKE '%" . $query . "%') OR (`email` LIKE '%" . $query . "%') OR (`phone_number` LIKE '%" . $query . "%');";
        $result = $mysqli->query($raw_results);
    }
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>". $rows['image'] ."</td>";                           
        echo "<td>". $rows['first_name'] ."</td>";                       
        echo "<td>".$rows['last_name']."</td>";
    }
}
?>