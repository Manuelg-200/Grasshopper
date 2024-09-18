<?php 
    session_start();

    function handleInputError($message) {
        $_SESSION["loginError"] = $message;
        header("Location: LoginForm.php");
        exit;
    }

    // Check for existance of post method fields and check email validity
    $email = $_POST["email"];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        handleInputError("Email non valida");
    $password = $_POST["pass"];
    if (empty($email) || empty($password))
        handleInputError("Email o password non inseriti"); ?>
<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Pagina Login</title>
        <link rel="stylesheet" type="text/css" href="loginStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body class="LoginFormPage">
        <?php
        include '../utils/connect.php';
        if($DBerror) { ?>
            <div class="LoginForm">
                <h1>Errore!</h1>
                <p>Impossibile connettersi al server</p>
                <p>Per favore riprova più tardi</p>
                <p>Sarai reindirizzato alla pagina iniziale<br> tra 5 secondi</p>
                <meta http-equiv="refresh" content="5; url=../index.php">
            </div> 
        <?php exit; }

        // Get user data from DB
        $email = trim($email);
        $stmt = $conn->prepare("SELECT Name, Surname, AdminRole, Password FROM userdata WHERE Email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();

        if($result->num_rows == 1) { // User exists
            $row = $result->fetch_object();
            if(password_verify($password, $row->Password)) { // Password is correct ?>
                <div class="LoginForm">
                    <h1>Bentornato!</h1>
                    <p>Sei stato riconosciuto come <?php echo "$row->Name $row->Surname"; ?></p>
                    <p>Sarai reindirizzato alla pagina principale tra 5 secondi</p>
                </div>
            <?php } else // Password is incorrect
                handleInputError("Email o password errati");
            if((isset($_POST["remember"]))) {
                $expiration = time() + (365 * 24 * 60 * 60);
                $expirationString = date("Y-m-d H:i:s", $expiration);
                setcookie("remember", $email . '|' . $expirationString, $expiration, "/"); // cookie expires in 1 year
            } else
                $_SESSION["LoggedIn"] = $email; 
            if($row->AdminRole)
                $_SESSION["Admin"] = true; ?>
            <meta http-equiv="refresh" content="5; url=../index.php">
          <?php exit;
        }
         // User doesn't exist
        handleInputError("Email o password errati");
    ?>
        
    