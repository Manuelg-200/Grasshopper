<?php session_start(); ?>

<!DOCTYPE html>
<html lang="IT">
    <head>
        <title>Profile page</title>
        <link rel="stylesheet" type="text/css" href="../indexStyle.css"/>
        <link rel="stylesheet" type="text/css" href="profileStyle.css"/>
    </head>
    <body>
        <?php include("../header.php");
        include("../DatabaseUtils/connect.php");
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
                <div class="labelContainer">
                    <span class="label">Nome</span>
                    <span id="Name" class="values"><?php echo $row->Name ?></span>
                </div>
                <div class="labelContainer">
                    <span class="label">Cognome</span>
                    <span id="Surname" class="values"><?php echo $row->Surname ?></span>
                </div>
                <div class="labelContainer">
                    <span class="label">Email</span>
                    <span id="Email" class="values"><?php echo $row->Email; ?></span>
                </div>
            </div>
            <div class="buttonsContainer">
                <button id="editButton" class="editButton">Modifica dati</button>
                <a id="changePasswordLink" href="/Grasshopper/profile/editPasswordForm.php"><button id="changePasswordButton" class="editButton">Cambia password</button></a>
            </div>
            <div class="buttonsContainer">
                <button id="deleteButton" class="deleteButton">Elimina account</button>
            </div>
        </div>
        <script src="editProfile.js"></script>
    </body>
</html>
   