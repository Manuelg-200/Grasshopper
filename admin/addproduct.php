<?php
    session_start();

    function handleInputError($message) {
        $_SESSION["productError"] = $message;
        header("Location: addProductForm.php");
        exit;
    }

    // Check for existance of post method fields
    if(!isset($_POST["game"]) || !isset($_POST["stadium"]) || !isset($_POST["price"]) || !isset($_POST["date"]))
        handleInputError("Campi mancanti");

    $game = trim($_POST["game"]);
    $stadium = $_POST["stadium"];
    $price = $_POST["price"];
    $date = $_POST["date"];
    if(isset($_POST["uniquePiece"])) {
        $uniquePiece = 1;
        $weeklySells = NULL;
    } else {
        $uniquePiece = 0;
        $weeklySells = 0;    
    }
        

    // Optional fields
    if(isset($_POST["description"]))
        $description = $_POST["description"];
    else
        $description = NULL;
    if(isset($_POST["discount"]))
        $discount = $_POST["discount"]; 
    else
        $discount = NULL;
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Aggiunto Prodotto</title>
        <link rel="stylesheet" type="text/css" href="../authentication/loginStyle.css"/>
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
        
        // Add new product to db
        $stmt = $conn->prepare("INSERT INTO products (game, stadium, price, date, description, discount, weeklySells, uniquePiece) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        if(!$uniquePiece)
            $stmt->bind_param('ssdssdii', $game, $stadium, $price, $date, $description, $discount, $weeklySells, $uniquePiece);
        else
            $stmt->bind_param('ssdssdii', $game, $stadium, $price, $date, $description, $discount, $weeklySells, $uniquePiece);
        $stmt->execute();
        if($stmt->affected_rows == 1) { ?>
            <div class="LoginForm">
                <h1>Prodotto Aggiunto!</h1>
                <p>Il prodotto è stato aggiunto con successo</p>
                <p>Sarai reindirizzato alla pagina principale tra 5 secondi</p>
                <meta http-equiv="refresh" content="5; url=../index.php">
            </div>
        <?php } else { ?>
            <div class="LoginForm">
                <h1>Errore!</h1>
                <p>Impossibile aggiungere il prodotto</p>
                <p>Per favore riprova più tardi</p>
                <p>Sarai reindirizzato alla pagina principale tra 5 secondi</p>
                <meta http-equiv="refresh" content="5; url=../index.php">
            </div>
        <?php }
        $stmt->close();
        $conn->close(); ?>        
    </body>
</html>
