<?php
session_start();
include '../../private/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $subcategory_id = $_POST['subcategory_id'];
    $product_info = $_POST['product_info'];

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM products WHERE name = :name');
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    if($stmt->fetchcolumn() >0) {
        $_SESSION['alert'] = 'Product name already exists!';
        header('Location: ../index.php?page=addproduct');
        exit;
    }
    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        if($_FILES['image']['size'] > 1000000){
            $_SESSION['alert'] = 'Image size too big!';
            header('Location: ../index.php?page=addproduct');
        }
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        $_SESSION['alert'] = 'Image upload failed!';
        header('Location: ../index.php?page=addproduct');
        exit;
    }
    if (!filter_var($price, FILTER_VALIDATE_FLOAT) || $price < 0) {
        $_SESSION['alert'] = 'Product price must be a non-negative number!';
        header('Location: ../index.php?page=addproduct');
        exit;
    }
    $stmt = $pdo->prepare('INSERT INTO products (name, price, subcategorie_id, description, photo) VALUES (:name, :price, :subcategory_id, :product_info, :photo)');
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':subcategory_id', $subcategory_id);
    $stmt->bindParam(':product_info', $product_info);
    $stmt->bindParam(':photo', $imageData, PDO::PARAM_LOB);

    $stmt->execute();
    $_SESSION['success'] = 'Product added successfully!';
    header('Location: ../index.php?page=productsmanage');
    exit;
}
?>