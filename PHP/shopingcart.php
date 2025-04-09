<?php
session_start();
include '../../private/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $product_id => $quantity) {
            if (isset($_SESSION['user_id'])) {
                // Update quantity in the database
                $stmt = $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id");
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                // Update quantity in the session
                $_SESSION['cart'][$product_id] = $quantity;
            }
        }
    }
    if (isset($_POST['remove'])) {
        $product_id = $_POST['remove'];
        if (isset($_SESSION['user_id'])) {
            // Remove item from the database
            $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    header('Location: ../index.php?page=shopingcart');
    exit;
}
?>