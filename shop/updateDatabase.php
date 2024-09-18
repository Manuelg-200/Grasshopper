<?php 
session_start();

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $products = $data['products'];

    include '../utils/connect.php';
    // Get user purchase history
    $stmt = $conn->prepare("SELECT PurchaseHistory FROM userdata WHERE Email = ?");
    $stmt->bind_param('s', $_SESSION['LoggedIn']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_object();
    $purchaseHistory = $result->PurchaseHistory;
    $stmt->close();

    // Start transaction, if one of the products encounters problems on payment rollback all payments
    $conn->begin_transaction();

    foreach($products as $productName) {
        $stmt = $conn->prepare("SELECT UniquePiece FROM products WHERE game = ?");
        $stmt->bind_param('s', $productName);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_object();
        $stmt->close();
        // If the user is buying a unique piece remove it from DB
        if($result->UniquePiece == 1) {
            $stmt = $conn->prepare("DELETE FROM products WHERE game = ?");
            $stmt->bind_param('s', $productName);
            $stmt->execute();
        }
        // Else add one to the weeklysells
        else {
            $stmt = $conn->prepare("UPDATE products SET weeklySells = weeklySells + 1 WHERE game = ?");
            $stmt->bind_param('s', $productName);
            $stmt->execute();
        }
        if($stmt->affected_rows == 0) {
            $stmt->close();
            // Rollback transaction
            $conn->rollback();
            throw new Exception('Errore durante l\'aggiornamento del database');
        }
        $purchaseHistory .= $productName . ', Data di acquisto: ' . date('Y-m-d') . '<br>';
    }
    // Commit transaction
    $conn->commit();

    // Update user purchase history
    $stmt = $conn->prepare("UPDATE userdata SET PurchaseHistory = ? WHERE Email = ?");
    $stmt->bind_param('ss', $purchaseHistory, $_SESSION['LoggedIn']);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo json_encode(['status' => 'ok']);
} catch(Exception $e) {
    echo json_encode(['status' => 'error']);
}