<?php
include_once("inc/dbconn.php");
global $conn;
$username = _POST["user"];
$password = _POST["pass"];

// Check if username is taken
$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$result = $stmt->execute();
if ($result->num_rows > 0) {
   // Username is already taken. 
    echo "username has already been taken.";
    die("Username has already been taken.");
}

// Salt and hash password.
$salt = random_bytes(64);
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, salt, hash) VALUES (?, ?, ?)");
$stmt->bind_param("s", $username, $salt, $hash);
$result = $stmt->execute();
if ($result === FALSE) {
    // Query failure
    echo "Failed to insert value into table";
    die("Failed to create user account");
}
