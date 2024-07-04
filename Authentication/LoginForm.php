<?php session_start(); ?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Tarsogno FC Login form</title>
        <link rel="stylesheet" type="text/css" href="../indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="LoginStyle.css"/>
        <link rel="stylesheet" type="text/css" href="../profile/profileStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php include("../header.php"); ?>
        <div class="LoginForm">
            <form method="post" action="Login.php">
                <h1>Accedi</h1>
                <?php if (!empty($_SESSION["loginError"])) { ?>
                    <div class="input-error-login-box">
                        <p><?php echo $_SESSION["loginError"]; ?></p>
                    </div>
                <?php unset($_SESSION["loginError"]); } ?>
                <label for="user">Username o email:</label><br>
                <input type="text" id="user" name="user" class="input"><br>
                <label for="passwd">Password:</label><br>
                <input type="password" id="passwd" name="passwd" class="input">
                <div class="rememberContainer">
                    <input type ="checkbox" id="remember" name="remember" value="remember">
                    <label for="remember" class="rememberLabel">Ricordami</label>
                </div><br>
                <!-- to do -->
                <a href="" class="forgotPassword">Password dimenticata?</a><br>
                <div class="mainButtonContainer"><input type="submit" value="Accedi" class="mainButton"></input></div>
            </form>
            <div class="Separator"><span class="or">Oppure</span></div>
            <div class="AlternativeButtonContainer"><a href="SignUpForm.php"><button class="AlternativeButton">Iscriviti</button></a></div>
        </div>
    </body>
</html>