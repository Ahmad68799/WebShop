<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove'])) {
        $product_id = $_POST['product_id'];
        if (isset($_SESSION['user_id'])) {
            // Remove item from the database
            $stmt = $pdo->prepare("DELETE FROM cart WHERE product_id = :product_id WHERE user_id = :user_id ");
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Remove item from the session
            unset($_SESSION['cart'][$product_id]);
        }
    }
}
?>