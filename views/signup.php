<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    require('inc/header.inc');
    require('forms/signup_get.php');
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('inc/header.inc');
    require('forms/signup_post.php');
}
else {
    echo "Invalid Request Method";
    die("Invalid request method for signup.php");
}
