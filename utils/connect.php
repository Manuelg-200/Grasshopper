<?php
    try {
        $DBerror = false;
        $conn = new mysqli('localhost', 'root', '', 'grasshopper');
        $conn->set_charset('utf8mb4');
    } catch (Exception $e) {
        $DBerror = true;
        echo "Connetion failed: " . $e->getMessage();
    }
?>