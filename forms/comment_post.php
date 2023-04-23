<?php
include("../inc/dbconn.php");
global $conn;
session_start();
if (!$_SESSION['loggedin']) {
    // Redirect to login page
    header('Location: /login');
}

if (strlen($_POST['data']) > 500) {
    exit("Invalid form data is too long!");
}

$stmt = $conn->prepare("INSERT INTO comments (posterID, commentText) VALUES (?, ?)");
$stmt->bind_param("is", $_SESSION['id'], $_POST['data']);
$stmt->execute();
header('Location: /comment');

