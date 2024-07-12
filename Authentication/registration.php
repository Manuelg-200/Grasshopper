<?php 
    session_start();
    
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $passwd = $_POST["pass"];
    $passwdconfirm = $_POST["confirm"];

    include '../DatabaseUtils/connect.php';

    // Check if the email is already taken
    $checkStmt = $conn->prepare("SELECT Email FROM userdata WHERE Email = ?");
    $checkStmt->bind_param('s', $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $checkStmt->close();
    if($checkResult->num_rows > 0) {
        $conn->close();
        $_SESSION["takenEmail"] = true;
        header("Location: SignUpForm.php");
        exit;
    }

    // Insert user data into userdata table
    $stmt = $conn->prepare("INSERT INTO userdata (Name, Surname, Email, Password) VALUES (?, ?, ?, ?)");
    $hashed_passwd = password_hash($passwd, PASSWORD_DEFAULT);
    $firstname = ucfirst(strtolower(trim($firstname)));
    $lastname = ucfirst(strtolower(trim($lastname)));
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $hashed_passwd);
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