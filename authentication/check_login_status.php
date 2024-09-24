<?php 
    // Server-side endpoint to return value of $_SESSION["LoggedIn"] to python selenium tests
    session_start();

    $response = array('logged in' => false);
    if(isset($_SESSION["LoggedIn"])) {
        $response['logged in'] = true;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>