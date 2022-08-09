<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weather";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");




try {
  $dh = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password); 
}
catch(PDOException $e) {
    echo $e->getMessage();
}



?>