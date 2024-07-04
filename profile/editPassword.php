<?php 
    session_start();
    $_SESSION = array();

    function handleInputError($message) {
        $_SESSION["loginError"] = $message;
        header("Location: LoginForm.php");
        exit;
    }

    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    if(empty($oldPassword) || empty($newPassword) || empty($confirmPassword))
        handleInputError("Compila tutti i campi");

