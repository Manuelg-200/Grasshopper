<?php 
    session_start();
    $_SESSION = array();
    $username = $_POST["user"];
    $email = $_POST["email"];
    $passwd = $_POST["passwd"];
    $passwdconfirm = $_POST["passwdconfirm"];

    // Insert user data into userdata table
    include '../DatabaseUtils/connect.php';
    $stmt = $conn->prepare("INSERT INTO userdata (Username, Password, Email) VALUES (?, ?, ?)");
    $hashed_passwd = password_hash($passwd, PASSWORD_DEFAULT);
    $username = trim($username);
    $stmt->bind_param("sss", $username, $hashed_passwd, $email);
    $stmt->execute();
    if($stmt->affected_rows == 0)
        $DBerror = true;
    $stmt->close();
    $conn->close();
?>
<!DOCTYPE html>
<html lang=it>
    <head>
        <title>Welcome page</title>
        <link rel="stylesheet" type="text/css" href="LoginStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body class="LoginFormPage">
        <div class="LoginForm">
            <?php if (empty($DBerror)) { ?>
                <h1>Benvenuto!</h1>
                <p>Sei stato registrato correttamente!</p>
                <p>Per accedere al sito clicca <a href="LoginForm.php">qui</a></p>               
            <?php } else { ?>
                <h1>Errore!</h1>
                <p>Si è verificato un errore durante la registrazione!</p>
                <p>Per favore riprova più tardi</p>
                <p>Sarai reindirizzato alla pagina iniziale tra 5 secondi</p>
                <meta http-equiv="refresh" content="5; url=index.php">
            <?php } ?>
        </div>
    </body>
</html>