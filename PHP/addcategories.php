<?php
session_start();
include '../../private/connection.php';

$supcategorie_name = $_GET["supcategory_name"];
$maincategory_id = $_GET["main_categorie_id"];

$stmt = $pdo->prepare('SELECT COUNT(*) FROM subcategories WHERE name = :name');
$stmt->bindParam(':name', $supcategorie_name);
$stmt->execute();
if($stmt->fetchcolumn() >0) {
    $_SESSION['alert'] = 'category name already exists!';
    header('Location: ../index.php?page=addcategories');
    exit;
}else{
    $stmt = $pdo->prepare("INSERT INTO subcategories (name, main_categorie_id) VALUES (:category_name, :main_category_id)");
    $stmt->bindParam(':category_name', $supcategorie_name);
    $stmt->bindParam(':main_category_id', $maincategory_id);
    $stmt->execute();
    header('Location: ../index.php?page=categoriesmanage');
}

