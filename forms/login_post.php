<?php
include("../inc/dbconn.php");
global $conn;


if (!isset($_POST["user"], $_POST["pass"])) {
    exit("Please fill out both username and password fields");
}
$password = $_POST["pass"];
$username = $_POST["user"];
$stmt = $conn->prepare('SELECT (id, user, hash, salt) FROM users WHERE user=?');
if (!$stmt) {
    echo "Error failed to prepare SQL statement in login.php POST request";
    die("Error failed to prepare SQL statement in login.php POST request");
}
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows <= 0) {
    echo "Error invalid username provided user does not exist in login.php POST request";
    die("Error invalid username provided user does not exist in login.php POST request");
}
$stmt->bind_result($db_id, $db_user, $db_hash, $db_salt);
if (password_verify($password, $db_hash)) {
    // Validation successful.
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
	$_SESSION['name'] = $_POST['username'];
	$_SESSION['id'] = $id;
	echo 'Welcome ' . $_SESSION['name'] . '!';
}
else {
    echo "Error invalid password was provided in login.php POST request";
    die("Error invalid password was provided in login.hpp POST request");
}

