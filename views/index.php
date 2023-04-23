<?php
session_start();
if ($_SESSION['loggedin']) {
    echo 'logged in as ' . $_SESSION['name'];
}
else {
    echo 'currently signed out';
}
require('inc/header.inc');
include('static/index.html');