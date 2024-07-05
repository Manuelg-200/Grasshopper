<?php
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

    // Check if the username is already taken
    $stmt = $conn->prepare("SELECT Username FROM userdata WHERE Username = ?");
    $stmt->bind_param('s', $data["Username"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0)
       handleError($conn, $stmt, "takenUsername");

    // Cookie is composed of the username and the expiration date
    list($currentUsername, $Expiration) = explode('|', $_COOKIE["user"]);
    $stmt;

    $stmt = $conn->prepare("UPDATE userdata SET Username = ?, Email = ?, Name = ?, Surname = ? WHERE Username = ?");
    $stmt->bind_param("sssss", $data["Username"], $data["Email"], $data["Name"], $data["Surname"], $currentUsername);
    $stmt->execute();
    if($stmt->affected_rows == 0) handleError($conn, $stmt, "DBError");
    if($data["Username"] != $currentUsername) {
        setcookie("user", $username . '|' . $expiration, $expiration, "/");
        $currentUsername = $data["Username"];
    }
    $stmt->close();
    $conn->close();
    echo json_encode(array("error" => "ok"));
    exit;
?>