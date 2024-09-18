<?php
    session_start();

    function handleDBError($conn, $stmt, $error) {
        if($stmt) $stmt->close();
        $conn->close();
        header("Location: profileError.php");
        exit;
    }

    function handlePostError($error) {
        $_SESSION["update_profileError"] = $error;
        header("Location: show_profile.php");
        exit;
    }

    // Obligatory fields
    if(!isset($_POST["firstname"]) || !isset($_POST["lastname"]) || !isset($_POST["email"]) || empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["email"]))
        handlePostError("Nome, Cognome ed Email sono campi obbligatori");
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    // Optional fields
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $city = isset($_POST["city"]) ? $_POST["city"] : "";
    $postCode = isset($_POST["postcode"]) ? $_POST["postcode"] : "";
    $favTeam = isset($_POST["favteam"]) ? $_POST["favteam"] : "";

    include '../utils/connect.php';
    if($DBerror) handleDBError($conn, null, "DBError");
    
    // Get email from session variable
    $currentEmail = $_SESSION["LoggedIn"];

    // Check if the username is already taken if it's different from the current one
    if ($email != $currentEmail) {
        $stmt = $conn->prepare("SELECT Email FROM userdata WHERE Email = ?");
        $stmt->bind_param('s', $data["email"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $conn->close();
            handlePostError("Email già in uso");      
        }      
    }

    // Data checks and sanitization
    $firstname = ucfirst(strtolower(trim($firstname)));
    $lastname = ucfirst(strtolower(trim($lastname)));
    $email = trim($email);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        handlePostError("Email non valida");
    if(!empty($address)) $address = ucfirst(strtolower(trim($address)));
    if(!empty($city)) $city = ucfirst(strtolower(trim($city)));
    if(!empty($postCode)) $postcode = trim($postCode);
    if(!empty($favTeam)) $favTeam = ucfirst(strtolower(trim($favTeam)));
    

    // Update the user's data
    $stmt = $conn->prepare("UPDATE userdata SET Name = ?, Surname = ?, Email = ?, Address = ?, City = ?, PostCode = ?, FavTeam = ?  WHERE Email = ?");
    $stmt->bind_param("ssssssss", $firstname, $lastname, $email, $address, $city, $postCode, $favTeam, $currentEmail);
    $stmt->execute();
    if($stmt->affected_rows == 0) handleDBError($conn, $stmt, "DBError");
    // If the email has been changed, update the session variable and the cookie if it's present
    if($email != $currentEmail) {
        $_SESSION["LoggedIn"] = $email;
        if(isset($_COOKIE["remember"])) {
            $expiration = explode('|', $_COOKIE["remember"])[1];
            $expiration = strtotime($expiration);
            setcookie("remember", $email . '|' . $expiration, $expiration, "/");
        }
    }
    $stmt->close();
    $conn->close();
    header("Location: show_profile.php");
    exit;
?>