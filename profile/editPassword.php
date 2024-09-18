<?php 
    session_start();

    function handleInputError($message) {
        $_SESSION["inputError"] = $message;
        header("Location: editPasswordForm.php");
        exit;
    }

    $oldPassword = $_POST["oldPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    // Check for existance of post method fields
    if(empty($oldPassword) || empty($newPassword) || empty($confirmPassword))
        handleInputError("Compila tutti i campi"); 
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Cambio Password</title>
        <link rel="stylesheet" type="text/css" href="../authentication/loginStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body class="LoginFormPage">
        <?php 
            // Recover email from session variable
            $email = $_SESSION["LoggedIn"];
            include("../utils/connect.php");
            if($DBerror) {
                header("Location: profileError.php");
                exit;
            }

            // Check if old password is correct
            $stmt = $conn->prepare("SELECT Password FROM userdata WHERE Email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if(!password_verify($oldPassword, $result->fetch_object()->Password))
                handleInputError("Vecchia password errata");
            // Check if new password and old password are the same
            if($newPassword == $oldPassword)
                handleInputError("La nuova password è uguale alla vecchia");

            // Change password
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE userdata SET Password = ? WHERE Email = ?");
            $stmt->bind_param('ss', $newPassword, $email);
            $stmt->execute();
            if($stmt->affected_rows == 0) {
                header("Location: profileError.php");
                exit;
            }
            $stmt->close();
            $conn->close();
        ?>
        <div class="LoginForm">
            <h1>Password cambiata con successo!</h1>
            <p>Sarai reindirizzato alla pagina del profilo tra 5 secondi</p>
            <meta http-equiv="refresh" content="5; url=show_profile.php">
        </div>
    </body>
</html>
