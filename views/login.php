<body>
<?php
session_start();

if (isset($_SESSION['loggedin'])&& $_SESSION['loggedin']) {
    echo "Error, you are already logged in!";
    die("Error user already logged in");
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require('inc/header.inc');
    require('forms/login_get.php');
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('inc/header.inc');
    require('forms/login_post.php');
}
else {
    echo "Invalid Request Method";
    die("Invalid request method for login.php");
}
?>
</body>
