<?php
    session_start();
    function handleError($conn, $stmt, $message) {
        if($stmt)
            $stmt->close();
        $conn->close();
        echo json_encode(array("error" => $message));
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    include '../DatabaseUtils/connect.php';
    if($DBerror) handleError($conn, null, "DBError");
    
    // Get email from session variable
    $currentEmail = $_SESSION["LoggedIn"];

    // Check if the username is already taken if it's different from the current one
    if ($data["Email"] != $currentEmail) {
        $stmt = $conn->prepare("SELECT Email FROM userdata WHERE Email = ?");
        $stmt->bind_param('s', $data["Email"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0)
            handleError($conn, $stmt, "takenEmail");
    }

    // TODO: Trims and tolower the data

    // Update the user's data
    $stmt = $conn->prepare("UPDATE userdata SET Name = ?, Surname = ?, Email = ?, Address = ?, City = ?, PostCode = ?, FavTeam = ?  WHERE Email = ?");
    $stmt->bind_param("ssssssss", $data["Name"], $data["Surname"], $data["Email"], $data["Address"], $data["City"], $data["PostCode"], $data["FavTeam"], $currentEmail);
    $stmt->execute();
    if($stmt->affected_rows == 0) handleError($conn, $stmt, "DBError");
    // If the email has been changed, update the session variable and the cookie if it's present
    if($data["Email"] != $currentEmail) {
        $_SESSION["LoggedIn"] = $data["Email"];
        if(isset($_COOKIE["remember"])) {
            $expiration = explode('|', $_COOKIE["remember"])[1];
            setcookie("remember", $data["Email"] . '|' . $expiration, $expiration, "/");
        }
    }
    $stmt->close();
    $conn->close();
    echo json_encode(array("error" => "ok"));
    exit;
?>