<?php
session_start();
include '../../private/connection.php';

$product_id = $_GET["product_id"];

$stmt = $pdo->prepare ("DELETE FROM products WHERE product_id = :product_id");
$stmt->bindParam(':product_id', $product_id);
$stmt->execute();

$_SESSION['success'] = "product successfuly deleted.";
header('Location: ../index.php?page=productsmanage');

?>