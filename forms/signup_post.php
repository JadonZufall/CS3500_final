<?php
include_once("inc/dbconn.php");
global $conn;

// Validate form submission die if validation fails
$username = _POST["user"];
$password = _POST["pass"];

if (!isset($_POST["user"], $_POST["pass"])) {
    exit("Please fill out both username and password fields");
}
if (strlen($username) > 32) {
    echo "Error invalid form submission signup.php POST";
    die("Invalid form submission signup.php POST");
}

if (strlen($password) < 6) {
    echo "Error invalid form submission signup.php POST";
    die("Invalid form submission signup.php POST");
}
if (strlen($password) > 32) {
    echo "Error invalid form submission signup.php POST";
    die("Invalid form submission signup.php POST");
}

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
else {
    echo "Account successfully created.";
}
