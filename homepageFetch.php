<?php 

// Get leagues categories from database
$stmt = $conn->prepare("SELECT * FROM leagues");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$leagues_number = $result->num_rows;
$leagues = array();
while($row = $result->fetch_object()) {
    array_push($leagues, $row);
}