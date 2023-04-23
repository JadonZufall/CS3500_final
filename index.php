<?php
/* 
    Probably not the best way of doing this as putting it an array would be better
    and there are overall much better ways of handling static pages but I am trying to
    get this done quickly so it's basically just an if else block.
*/
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
if ($uri == '/' or $uri == '/index') {
    require('views/index.php');
}
else if ($uri == '/login') {
    require('views/login.php');
}
else if ($uri == '/signup') {
    require('views/signup.php');
}
else if ($uri == '/signout') {
    require('views/signout.php');
}
else if ($uri == '/comment') {
    require('views/comment.php');
}
else if ($uri == '/about') {
    require('views/about.php');
}
else if ($uri == '/catalog') {
    require('views/catalog.php');
}
else if ($uri == '/references') {
    require('views/references.php');
}
else if ($uri == '/sources') {
    require('views/sources.php');
}
else if ($uri == '/music') {
    require('views/music.php');
}
else if ($uri == '/awards') {
    require('views/awards.php');
}
else if ($uri == '/philanthropy') {
    require('views/philanthropy.php');
}
else if ($uri == '/trivia') {
    require('views/trivia.php');
}
else if ($uri == '/tourdates') {
    require('views/tourdates.php');
}
else if ($uri == '/activism') {
    require('views/activism.php');  
}
else if ($uri == '/taylorsversion') {
    require('views/taylorsversion.php');
}
else if ($uri == '/hardships') {
    require('views/hardships.php'); 
}
else if ($uri == '/genreswitch') {
    require('views/genreswitch.php');
}
else if ($uri == '/listen') {
    require('views/listen.php');
}
else if ($uri == '/acting') {
    require('views/acting.php');
}
else if ($uri == '/previoustours') {
    require('views/previoustours.php');
}
else if ($uri == '/quiz') {
    require('views/quiz.php');
}
else if ($uri == '/early_life') {
    require('views/early_life.php');
}
else if ($uri == '/career_beginnings') {
    require('views/career_beginnings.php');
}
else if ($uri == '/1989') {
    require('views/1989.php');
}
else if ($uri == '/present_day') {
    require('views/present_day.php');
}
else if ($uri == '/publications') {
    require('views/publications.php');
}
else if ($uri == '/merch') {
    require('views/merch.php');
}
else if ($uri == '/thankyou') {
    require('views/thankyou.php');
}
else {
    http_response_code(404);
    echo "404 Page not found";
}
