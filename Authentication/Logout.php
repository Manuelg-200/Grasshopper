<?php 
session_start();
$_SESSION = array();
setcookie("remember", "", time() - 3600, "/");
header("Location: ../index.php");
?>