<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "cpsc471";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>

