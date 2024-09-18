<?php 
    session_start();
    include '../utils/rememberLogin.php';
    if(!isset($_SESSION["LoggedIn"]) && $_SESSION["Admin"] == 0) {
        header("Location: ../index.php");
        exit;
    }

    include '../utils/connect.php';
    // Get stadiums from DB
    if(!$DBerror) {
        $stmt = $conn->prepare("SELECT name FROM stadiums ORDER BY name");
        $stmt->execute();
        $stadiums = $stmt->get_result();
        $stadiumsArray = array();
        while($row = $stadiums->fetch_assoc()) {
            array_push($stadiumsArray, $row);
        }
        $stmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Grasshopper Aggiungi Prodotto</title>
        <link rel="stylesheet" type="text/css" href="../indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="../authentication/loginStyle.css"/>
    </head>
    <body>
        <?php include("../header.php"); ?>
        <div class="LoginForm">
            <?php if($DBerror) { ?>
                <h1>Errore!</h1>
                <p>Impossibile connettersi al server</p>
                <p>Per favore riprova più tardi</p>
                <p>Sarai reindirizzato alla pagina iniziale<br> tra 5 secondi</p>
                <meta http-equiv="refresh" content="5; url=../index.php">
            <?php exit; } ?>
            <form action="addproduct.php" method="post">
                <h1>Aggiungi Prodotto</h1>
                <?php if (!empty($_SESSION["productError"])) { ?>
                    <div class="input-error-login-box">
                        <p><?php echo $_SESSION["productError"]; ?></p>
                    </div>
                <?php unset($_SESSION["productError"]); } ?>
                <label for="game">Partita:</label><br>
                <input type="text" name="game" id="game" class="input"><br>
                <label for="stadium">Stadio:</label><br>
                <select name="stadium" id="stadium" class="input">
                    <option value="" disabled selected>Seleziona uno stadio</option>
                    <?php foreach($stadiumsArray as $stadium) { ?>
                        <option value="<?php echo $stadium["name"]; ?>"><?php echo $stadium["name"]; ?></option>
                    <?php } ?>
                </select><br>
                <label for="Price">Prezzo:</label><br>
                <input type="number" name="price" id="Price" class="input"><br>
                <label for="date">Data:</label><br>
                <input type="date" name="date" id="date" class="input"><br>
                <label for="uniquePiece">Pezzo Unico:</label>
                <input type="checkbox" name="uniquePiece" id="uniquePiece" class="UniquePieceCheck"><br>
                <div class="Separator"><span class="or">Campi condizionali</span></div>
                <label for="Description">Descrizione:</label><br>
                <textarea name="description" id="Description" class="input"></textarea><br>
                <label for="discount">Sconto:</label><br>
                <input type="number" name="discount" max="100" min="0" id="discount" class="input"><br>
                <div class="mainButtonContainer"><input type="submit" value="Conferma" class="mainButton"></input></div>
            </form>
        </div>
    </body>
</html>