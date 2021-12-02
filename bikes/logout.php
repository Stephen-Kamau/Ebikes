<?php
session_start();

session_unset();
session_destroy();
$_SESSION['done'] = "Successfully logout";
// array_push($_SESSION['errors'] , "Logged out well");
header("location:index.php");


 ?>
