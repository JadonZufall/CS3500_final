<?php
include_once("inc/dbconn.php");
global $conn;
$username = $_POST["user"];
if (strlen($username) > 32) {
    // Invalid username
}


$password = $_POST["pass"];

// Generate password hash as well as salt
$hash = password_hash($password, PASSWORD_DEFAULT);
$salt = random_bytes(64);
$sql = "INSERT INTO (username, hash, salt)";