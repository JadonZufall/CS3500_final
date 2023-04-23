<?php 
/* 
    Registration form to be included in the body of the registration page all
    authentication is handled by the signup_post form this form is just for the
    actual web form that will be submitted.  Addiational validation is to be done
    using javascript likely.
*/
?>
<div class="container">
<h1>Register</h1>
<form action="forms/signup_post.php" method="post">
    <input type="text" name="user"></input><br>
    <input type="password" name="pass"></input><br>
    <input type="submit"><br>
</form>
</div>