<?php 
    session_start();
    $_SESSION = array();
    if(isset($_COOKIE["remember"]))
        setcookie("remember", '', time() - 3600, '/');
    header("Location: ../index.php");
?>