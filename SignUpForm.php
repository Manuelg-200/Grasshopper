<?php 
    session_start(); 
    include 'DatabaseUtils/rememberLogin.php';
    if(isset($_SESSION["LoggedIn"])) {
        header("Location: index.php");
        exit;
    } 
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Grasshopper Sign Up form</title>
        <link rel="stylesheet" type="text/css" href="styles/indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="styles/loginStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div class="LoginForm" id="LoginForm">
            <form action="registration.php" method="post">
                <h1>Registrati</h1>
                <?php if (!empty($_SESSION["takenEmail"])) { ?>
                    <div class="input-error-login-box">
                        <p>Email già in uso</p>
                    </div>
                <?php unset($_SESSION["takenEmail"]); } ?>

                <label for="firstname">Nome:</label><br>
                <input type="text" name ="firstname" id="Firstname" class="input"><br>
                <div class="input-error-message">
                    <p id="FirstnameError"></p>
                </div>

                <label for="lastname">Cognome:</label><br>
                <input type="text" name="lastname" id="Lastname" class="input"><br>
                <div class="input-error-message">
                    <p id="LastnameError"></p>
                </div>

                <label for="email">Email:</label><br>
                <input type="email" name="email" id="Email" class="input"><br>
                <div class="input-error-message">
                    <p id="EmailError"></p>
                </div>

                <label for="pass">Password:</label><br>
                <input type="password" name="pass" id="Password" class="input"><br>
                <div class="input-error-message">
                    <p id="PasswordError"></p>
                </div>

                <label for="confirm">Conferma Password:</label><br>
                <input type="password" name="confirm" id="PasswdConfirm" class="input"><br>
                <div class="input-error-message">
                    <p id="PasswdConfirmError"></p>
                </div>

                <div class="mainButtonContainer"><input type="submit" name="submit" value="Registrati" id="Submit" class="mainButton"></input></div>
            </form>
            <div class="Separator"><span class="or">Hai già un account?</span></div>
            <div class="AlternativeButtonContainer"><a href="LoginForm.php"><button class="AlternativeButton">Accedi</button></a></div>
        </div>
        <script src="scripts/SignUpForm_errorMessage.js"></script>
    </body>
</html>

<?php unset($_SESSION["user"]); unset($_SESSION["email"]); unset($_SESSION["passwd"]); unset($_SESSION["passwdconfirm"]); ?>