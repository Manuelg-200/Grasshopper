<?php 
    session_start();

    include 'DatabaseUtils/connect.php';
    if($DBerror) {
        header("Location: profileError.php");
        exit;
    }

    $email = $_SESSION["LoggedIn"];
    // Delete session variables and remember me cookie
    $_SESSION = array();
    if(isset($_COOKIE["remember"]))
        setcookie("remember", '', time() - 3600, '/');

    // Delete user from database
    $stmt = $conn->prepare("DELETE FROM userdata WHERE Email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    if($stmt->affected_rows == 0) {
        $stmt->close();
        $conn->close();
        header("Location: profileError.php");
        exit;
    }
    $stmt->close();
    $conn->close();
?>
<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Profilo cancellato con successo</title>
        <link rel="stylesheet" type="text/css" href="profileStyle.css"/>
        <link rel="stylesheet" type="text/css" href="indexStyle.css"/>
    </head>
    <body>
        <div class="ErrorContainer">
            <h1>Profilo eliminato con successo.</h1>
            <p>Ci dispiace che tu abbia deciso di lasciarci.</p>
            <p>Sarai reindirizzato alla pagina iniziale tra 5 secondi</p>
            <meta http-equiv="refresh" content="5; url=index.php">
        </div>
    </body>
</html>
