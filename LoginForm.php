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
        <title>Grasshopper Login form</title>
        <link rel="stylesheet" type="text/css" href="styles/indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="styles/loginStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div class="LoginForm">
            <form action="login.php" method="post">
                <h1>Accedi</h1>
                <?php if (!empty($_SESSION["loginError"])) { ?>
                    <div class="input-error-login-box">
                        <p><?php echo $_SESSION["loginError"]; ?></p>
                    </div>
                <?php unset($_SESSION["loginError"]); } ?>
                <label for="email">Email:</label><br>
                <input type="email" name="email" class="input"><br>
                <label for="pass">Password:</label><br>
                <input type="password" name="pass" class="input">
                <div class="rememberContainer">
                    <input type ="checkbox" name="remember" id="Remember" value="true">
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