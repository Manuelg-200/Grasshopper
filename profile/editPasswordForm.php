<?php 
    session_start();
    $_SESSION = array();
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Change password</title>
        <link rel="stylesheet" type="text/css" href="../indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="../Authentication/LoginStyle.css"/>
    </head>
    <body class="LoginFormPage">
        <?php include("../header.php"); ?>
        <div class="LoginForm">
            <form method ="post" action="editPassword.php">
                <h1>Cambia password</h1>
                <label for="oldPassword">Vecchia password:</label><br>
                <input type="password" id="oldPassword" name="oldPassword" class="input"><br>
                <div class="input-error-message"><p></p></div> <!-- Useless div to mantain the structure of the form -->

                <label for="newPassword">Nuova password:</label><br>
                <input type="password" id="newPassword" name="newPassword" class="input"><br>
                <div class="input-error-message">
                    <p id="newPasswordError"></p>
                </div>

                <label for="confirmPassword">Conferma password:</label><br>
                <input type="password" id="confirmPassword" name="confirmPassword" class="input"><br>
                <div class="input-error-message">
                    <p id="confirmPasswordError"></p>
                </div>

                <div class="mainButtonContainer"><input id="submit" type="submit" value="Cambia password" class="mainButton"></input></div>  
            </form>
            <a href="profile.php"><button class="deleteButton">Annulla</button></a>
        </div>
        <script src="editPasswordForm_errorMessage.js"></script>
    </body>
</html>