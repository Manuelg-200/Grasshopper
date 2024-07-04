<?php
    function handleError($conn, $stmt) {
        if($stmt)
            $stmt->close();
        $conn->close();
        echo json_encode(array("error" => "DBerror"));
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    include '../DatabaseUtils/connect.php';
    if($DBerror) handleError($conn, null);
    // Cookie is composed of the username and the expiration date
    list($currentUsername, $Expiration) = explode('|', $_COOKIE["user"]);
    $stmt;

    $stmt = $conn->prepare("UPDATE userdata SET Username = ?, Email = ?, Name = ?, Surname = ? WHERE Username = ?");
    $stmt->bind_param("sssss", $data["Username"], $data["Email"], $data["Name"], $data["Surname"], $currentUsername);
    $stmt->execute();
    if($stmt->affected_rows == 0) handleError($conn, $stmt);
    if($data["Username"] != $currentUsername) {
        setcookie("user", $username . '|' . $expiration, $expiration, "/");
        $currentUsername = $data["Username"];
    }
    $stmt->close();
    $conn->close();
    echo json_encode(array("error" => "ok"));
    exit;
?>