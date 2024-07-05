<?php 
    session_start();
    $_SESSION = array();

    function handleInputError($message) {
        $_SESSION["loginError"] = $message;
        header("Location: LoginForm.php");
        exit;
    }

    // Check for existance of post method fields
    $userOrEmail = $_POST["user"];
    $passwd = $_POST["passwd"];
    if (empty($userOrEmail) || empty($passwd))
        handleInputError("Username o password non inseriti"); ?>
<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Login page</title>
        <link rel="stylesheet" type="text/css" href="LoginStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body class="LoginFormPage">
        <?php // Check for user existance in database
        include '../DatabaseUtils/connect.php';
        if($DBerror) { ?>
            <div class="LoginForm">
                <h1>Errore!</h1>
                <p>Impossibile connettersi al server</p>
                <p>Per favore riprova più tardi</p>
                <p>Sarai reindirizzato alla pagina iniziale<br> tra 5 secondi</p>
                <meta http-equiv="refresh" content="5; url=../index.php">
            </div> 
        <?php exit; }
        $userOrEmail = trim($userOrEmail);
        $stmt = $conn->prepare("SELECT Username, Password FROM userdata WHERE Username = ? OR Email = ?");
        $stmt->bind_param('ss', $userOrEmail, $userOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();

        if($result->num_rows == 1) { // User exists
            $row = $result->fetch_object();
            if(password_verify($passwd, $row->Password)) { // Password is correct ?>
                <div class="LoginForm">
                    <h1>Bentornato!</h1>
                    <p>Sei stato riconosciuto come <?php echo $row->Username; ?></p>
                    <p>Sarai reindirizzato alla pagina principale tra 5 secondi</p>
                </div>
          <?php } else // Password is incorrect
                handleInputError("Username o password errati");
           if(isset($_POST["remember"])) {
                    $expiration = time() + (365 * 24 * 60 * 60);
                    $expirationString = date("Y-m-d H:i:s", $expiration);
                    setcookie("user", $row->Username . '|' . $expirationString, $expiration, "/"); // cookie expires in 1 year
          } else
                    setcookie("user", $row->Username . '|' . 0, 0, "/"); // cookie expires when browser is closed ?>
                <meta http-equiv="refresh" content="5; url=../index.php">
          <?php exit;
        }
         // User doesn't exist or password is incorrect
        handleInputError("Username o password errati");
    ?>
        
    