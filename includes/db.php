<?php
$servername = "WWW";
$username = "root";
$password = "";
$dbname = "zoo_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
