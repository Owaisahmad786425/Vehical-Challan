<?php
session_start();
if ($_COOKIE['uname']) {
    setcookie("uname", '', time()-3600, "/");
}
$newURL = "/irlts/home.php";
header('Location: '.$newURL);
?>
