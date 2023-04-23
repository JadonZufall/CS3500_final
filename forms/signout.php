<?php
// Reset the users session validation
session_regenerate_id();
$_SESSION['loggedin'] = FALSE;
$_SESSION['name'] = '';
$_SESSION['id'] = -1;
echo "user has been logged out";