<?php session_start(); ?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Grasshopper Sign Up form</title>
        <link rel="stylesheet" type="text/css" href="../indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="LoginStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php include("../header.php"); ?>
        <div class="LoginForm" id="LoginForm">
            <form method="post" action="SignUp.php">
                <h1>Registrati</h1>
                <?php if (!empty($_SESSION["takenUsername"])) { ?>
                    <div class="input-error-login-box">
                        <p><?php echo $_SESSION["takenUsername"]; ?></p>
                    </div>
                <?php unset($_SESSION["takenUsername"]); } ?>

                <!-- Series of ifs to check if the user has already inserted incorrect data; -->
                <label for="user">Username:</label><br>
                <input type="text" id="Username" name="user" class="input"><br>
                <div class="input-error-message">
                    <p id="UsernameError"></p>
                </div>

                <label for="email">Email:</label><br>
                <input type="email" id="Email" name="email" class="input"><br>
                <div class="input-error-message">
                    <p id="EmailError"></p>
                </div>

                <label for="passwd">Password:</label><br>
                <input type="password" id="Password" name="passwd" class="input"><br>
                <div class="input-error-message">
                    <p id="PasswordError"></p>
                </div>

                <label for="passwdconfirm">Conferma Password:</label><br>
                <input type="password" id="passwdconfirm" name="passwdconfirm" class="input"><br>
                <div class="input-error-message">
                    <p id="passwdconfirmError"></p>
                </div>

                <div class="mainButtonContainer"><input id="submit" type="submit" value="Registrati" class="mainButton"></input></div>
            </form>
            <div class="Separator"><span class="or">Hai già un account?</span></div>
            <div class="AlternativeButtonContainer"><a href="LoginForm.php"><button class="AlternativeButton">Accedi</button></a></div>
        </div>
        <script src="SignUpForm_errorMessage.js"></script>
    </body>
</html>

<?php unset($_SESSION["user"]); unset($_SESSION["email"]); unset($_SESSION["passwd"]); unset($_SESSION["passwdconfirm"]); ?>