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

// Get best selling products from database
$stmt = $conn->prepare("SELECT * FROM products, stadiums WHERE stadium=name ORDER BY weeklySells DESC LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$best_selling_number = $result->num_rows;
$best_selling = array();
while($row = $result->fetch_object()) {
    array_push($best_selling, $row);
}

// Get discounted products from database
$stmt = $conn->prepare("SELECT * FROM products, stadiums WHERE stadium=name AND discount is not null ORDER BY discount DESC LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$discounted_number = $result->num_rows;
$discounted = array();
while($row = $result->fetch_object()) {
    array_push($discounted, $row);
}

// Get new products from database
$stmt = $conn->prepare("SELECT * FROM products, stadiums WHERE stadium=name ORDER BY date DESC LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$new_products_number = $result->num_rows;
$new_products = array();
while($row = $result->fetch_object()) {
    array_push($new_products, $row);
}

$conn->close();
?>