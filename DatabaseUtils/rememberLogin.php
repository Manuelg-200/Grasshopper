<?php
// Cookie is composed of email and expiration date
    if(isset($_COOKIE["remember"])) {
        $cookie = explode('|', $_COOKIE["remember"]);
        $email = $cookie[0];
        $expiration = $cookie[1];
        if($expiration > date("Y-m-d H:i:s")) {
            $_SESSION["LoggedIn"] = $email;
            exit;
        }
    }