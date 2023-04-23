<?php
include("../inc/dbconn.php");
global $conn;
session_start();
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
// Spoiler I dont use the salt (Probably insecure but it broke something if I have time ill fix it later)
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

$stmt = $conn->prepare("SELECT userID FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $id);
mysqli_stmt_fetch($stmt);
session_regenerate_id();
$_SESSION['loggedin'] = TRUE;
$_SESSION['name'] = $username;
$_SESSION['id'] = $id;
header('Location: /');