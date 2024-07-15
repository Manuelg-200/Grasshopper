<?php 
    session_start();
    include 'DatabaseUtils/rememberLogin.php';
    if(!isset($_SESSION["LoggedIn"])) {
        header("Location: index.php");
        exit;
    }
    
    // Create a small script that shows an alert if the error variable is already set, which means the user attempted to update the profile with invalid data
    if(isset($_SESSION["update_profileError"])) {
        echo '<script type="text/javascript">';
        echo 'alert("' . $_SESSION["update_profileError"] . '");';
        echo '</script>';
        unset($_SESSION["update_profileError"]);
    }
?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Profile page</title>
        <link rel="stylesheet" type="text/css" href="styles/indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="styles/profileStyle.css"/>
        <meta name="viewport" content="width=device-width"/>
    </head>
    <body>
        <?php include("header.php");
        include("DatabaseUtils/connect.php");
        if($DBerror) header("Location: profileError.php");

        $stmt = $conn->prepare("SELECT * FROM userdata WHERE Email = ?");
        // Email is saved in the session variable
        $stmt->bind_param('s', $_SESSION["LoggedIn"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();

        if($result->num_rows == 1) // User exists
            $row = $result->fetch_object();
       else header("Location: profileError.php"); // User doesn't exists ?> 
        <div class="ProfileContainer">
            <h1>Profilo</h1><br>
            <div class="pictureContainer">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg" alt="Generic avatar">
            </div>
            <div class="dataContainer">
                <div class="fieldContainer">
                    <label for="firstname">Nome</label>
                    <span class="values"><?php echo $row->Name ?></span>
                </div>
                <div class="fieldContainer">
                    <label for="lastname">Cognome</label>
                    <span class="values"><?php echo $row->Surname ?></span>
                </div>
                <div class="fieldContainer">
                    <label for="email">Email</label>
                    <span class="values"><?php echo $row->Email; ?></span>
                </div>
                <div class="fieldContainer">
                    <label for="address">Indirizzo</label>
                    <span class="values"><?php echo $row->Address ?></span>
                </div>
                <div class="fieldContainer">
                    <label for="city">Città</label>
                    <span class="values"><?php echo $row->City ?></span>
                </div>
                <div class="fieldContainer">
                    <label for="postcode">CAP</label>
                    <span class="values"><?php echo $row->PostCode ?></span>
                </div>
                <div class="fieldContainer">
                    <label for="favteam">Squadra preferita</label>
                    <span class="values"><?php echo $row->FavTeam ?></span>
                </div>
            </div>
            <div class="buttonsContainer">
                <button id="editButton" class="editButton">Modifica dati</button>
                <a id="changePasswordLink" href="editPasswordForm.php"><button id="changePasswordButton" class="editButton">Cambia password</button></a>
            </div>
            <div class="buttonsContainer">
                <a id="deletePasswordLink" href="deleteProfile.php"><button id="deleteButton" class="deleteButton">Elimina account</button></a>
            </div>
        </div>
        <script src="scripts/editProfile.js"></script>
    </body>
</html>
   