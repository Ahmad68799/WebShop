<?php
session_start();
include '../../private/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if ($quantity < 1) {
        $_SESSION['alert'] = 'quantity must be a positive !';
        header('Location: ../index.php?page=shopingcart');
        exit;
    }

    if (isset($_SESSION['user_id'])) {
        // Insert or update quantity in the database
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)
                               ON DUPLICATE KEY UPDATE quantity = quantity + :quantity");
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        // Insert or update quantity in the session
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }

    if (isset($_POST['quantity'])) {
        $quantity_new = $_POST['quantity'];
        $product_id = $_POST['product_id'];
        if (isset($_SESSION['user_id'])) {
            // Update quantity in the database
            $stmt = $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :product_id AND user_id = :user_id");
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Update quantity in the session
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = $quantity;
            }
        }
    }
    header('Location: ../index.php?page=shopingcart');
    exit;
}
?>
