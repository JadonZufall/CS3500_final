<?php
include("../inc/dbconn.php");
global $conn;

// Validate form submission die if validation fails
if (!isset($_POST["user"], $_POST["pass"])) {
    exit("Please fill out both username and password fields");
}
$username = $_POST["user"];
$password = $_POST["pass"];

// Validate string lengths
if (strlen($username) > 32) {
    exit("Invalid username length > 32 characters");
}
else if (strlen($password) < 6) {
    exit("Invalid password length < 6 characters");
}
else if (strlen($password) > 32) {
    exit("Invalid password length > 32 characters");
}

// Check if username is taken
$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
if ($stmt->num_rows > 0) {
    exit("Username has already been taken");
}
$stmt->close();

// Generate a salt I probably never actually use because lazy and writing code fast.
$salt = '_salt' . $username;
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, salt, hash) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $salt, $hash);
$result = $stmt->execute();
if ($result === FALSE) {
    // Query failure
    echo "Failed to insert value into table";
    die("Failed to create user account");
}
else {
    echo "Account successfully created.";
}
$stmt->close();
