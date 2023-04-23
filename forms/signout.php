<?php
// Reset the users session validation
session_start();
if (!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = FALSE;
}
if (!$_SESSION['loggedin']) {
    // Redirect to home page
    header('Location: /');
}
else {
    // Signout and redirect to home page
    session_regenerate_id();
    $_SESSION['loggedin'] = FALSE;
    $_SESSION['name'] = '';
    $_SESSION['id'] = -1;
    header('Location: /');
}
