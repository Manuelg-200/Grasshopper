<?php
    session_start();
    if(!isset($_SESSION["LoggedIn"]) && $_SESSION["Admin"] == 0) {
        header("Location: ../index.php");
        exit;
    }
    if(!isset($_GET["game"])) {
        header("Location: ../index.php");
        exit;
    }

    $game = $_GET["game"];
    include '../utils/connect.php';
    if(!$DBerror) {
        $stmt = $conn->prepare("DELETE FROM products WHERE game = ?");
        $stmt->bind_param('s', $game);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        if($conn->affected_rows == 0) {
            $DBerror = true;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Elimina Prodotto</title>
        <link rel="stylesheet" type="text/css" href="../authentication/loginStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body class="LoginFormPage">
        <?php if($DBerror) { ?>
            <div class="LoginForm">
                <h1>Errore!</h1>
                <p>Impossibile connettersi al server</p>
                <p>Per favore riprova più tardi</p>
                <p>Sarai reindirizzato alla pagina iniziale<br> tra 5 secondi</p>
                <meta http-equiv="refresh" content="5; url=../index.php">
            </div>
        <?php exit; 
        } ?>
        <div class="LoginForm">
            <h1>Prodotto eliminato</h1>
            <p>Il prodotto è stato rimosso con successo</p>
            <p>Sarai reindirizzato alla pagina principale tra 5 secondi</p>
        </div>
        <meta http-equiv="refresh" content="5; url=../index.php">
    </body>
</html>
