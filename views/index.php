<?php
session_start();
if ($_SESSION['loggedin']) {
    echo '<div class="container auththing">';
    echo 'logged in as ' . $_SESSION['name'] . ' ';
    echo '<a href="/signout">signout</a>';
    echo '</div>';
}
else {
    echo '<div class="container auththing">';
    echo 'currently signed out ';
    echo '<a href="/login">login</a> | <a href="/signup">signup</a>';
    echo '</div>';
}
require('inc/header.inc');
include('static/index.html');