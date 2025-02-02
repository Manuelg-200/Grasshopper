<?php 
    session_start(); 
    include '../utils/rememberLogin.php';
    if(isset($_SESSION["LoggedIn"])) {
        header("Location: ../index.php");
        exit;
    } 
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Grasshopper Login form</title>
        <link rel="stylesheet" type="text/css" href="../indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="loginStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php include("../header.php"); ?>
        <div class="LoginForm">
            <form action="login.php" method="post">
                <h1>Accedi</h1>
                <?php if (!empty($_SESSION["loginError"])) { ?>
                    <div class="input-error-login-box">
                        <p><?php echo $_SESSION["loginError"]; ?></p>
                    </div>
                <?php unset($_SESSION["loginError"]); } ?>
                <label for="email">Email:</label><br>
                <input type="email" name="email" class="input" id="email"><br>
                <label for="pass">Password:</label><br>
                <input type="password" name="pass" class="input" id="pass">
                <div class="rememberContainer">
                    <input type ="checkbox" name="remember" value="true" id="remember">
                    <label for="remember" class="rememberLabel">Ricordami</label>
                </div><br>
                <!-- to do -->
                <a href="" class="forgotPassword">Password dimenticata?</a><br>
                <div class="mainButtonContainer"><input type="submit" value="Accedi" class="mainButton" id="Submit"></input></div>
            </form>
            <div class="Separator"><span class="or">Oppure</span></div>
            <div class="AlternativeButtonContainer"><a href="RegistrationForm.php"><button class="AlternativeButton">Iscriviti</button></a></div>
        </div>
    </body>
</html>