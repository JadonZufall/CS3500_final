<?php
$servername = 'localhost';
$username = "server";
$password = "password";
$dbname = "taylor_swift";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "Error unable to connect to database";
    die("Database connection failed " . $conn->connect_error);
}

$GLOBALS['conn'] = conn;