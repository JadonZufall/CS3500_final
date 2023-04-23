<?php
include("../inc/dbconn.php");
global $conn;

session_start();
if (!isset($_POST["user"], $_POST["pass"])) {
    exit("Please fill out both username and password fields");
}
$username = $_POST["user"];
$password = $_POST["pass"];
$stmt = $conn->prepare('SELECT * FROM users WHERE username=?');
if (!$stmt) {
    die("Error failed to prepare SQL statement in login.php POST request");
}
$stmt->bind_param("s", $username);
$stmt->execute();
mysqli_stmt_store_result($stmt);
mysqli_stmt_bind_result($stmt, $id, $username, $salt, $hash);
mysqli_stmt_fetch($stmt);
if (mysqli_stmt_num_rows($stmt) <= 0) {
    die("Error invalid username provided user does not exist in login.php POST request");
}

if (password_verify($password, $hash)) {
    // Validation successful.
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
	$_SESSION['name'] = $_POST['user'];
	$_SESSION['id'] = $id;
	header('Location: /');
}
else {
    echo "Error invalid password was provided in login.php POST request";
    die("Error invalid password was provided in login.hpp POST request");
}

