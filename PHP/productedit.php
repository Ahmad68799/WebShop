<?php
session_start();
include '../../private/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$info = $_POST['info'];
$subcategorie_id = $_POST['subcategorie_id'];

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM products WHERE name = :name AND product_id != :product_id');
    $stmt->bindParam(':name', $product_name);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        $_SESSION['alert'] = 'Product name already exists!';
        header('Location: ../index.php?page=productedit&product_id=' . urlencode($product_id));
        exit;
    }

    $stmt = $pdo->prepare("SELECT photo FROM products WHERE product_id = :product_id");
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        $imageData = $product['photo'];
    }
    if (!filter_var($product_price, FILTER_VALIDATE_FLOAT) || $product_price < 0) {
        $_SESSION['alert'] = 'Product price must be a non-negative number!';
        header('Location: ../index.php?page=productedit&product_id=' . urlencode($product_id));
        exit;
    }
$stmt = $pdo->prepare("UPDATE products SET name = :product_name, price = :product_price, description = :info, photo = :photo, subcategorie_id = :subcategorie_id WHERE product_id = :product_id");
$stmt->bindParam(':product_name', $product_name);
$stmt->bindParam(':product_price', $product_price);
$stmt->bindParam(':info', $info);
$stmt->bindParam(':product_id', $product_id);
$stmt->bindParam(':photo', $imageData, PDO::PARAM_LOB);
$stmt->bindParam(':subcategorie_id', $subcategorie_id);

$stmt->execute();
$_SESSION['success'] = 'product updated successfully! :)';
//header('location: ../index.php?page=productsmanage');
exit;
}
?>