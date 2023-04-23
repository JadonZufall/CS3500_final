<?php
/* 
    Include to connect to database from anywhere in the server I guess?
    Times like this I wish we could use django or something but I guess
    php is fun.
*/

// Database config
$servername = 'localhost';
$username = "server";
$password = "password";
$dbname = "taylor_swift";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "Error unable to connect to database";
    die("Database connection failed " . $conn->connect_error);
}

// Set global variable? might be doing this incorrectly.
$GLOBALS['conn'] = $conn;