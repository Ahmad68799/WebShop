<?php
session_start();
include '../../private/connection.php';

$subcategorie_id = $_GET["subcategorie_id"];

$sql = "SELECT COUNT(*) as count FROM products WHERE subcategorie_id = :subcategorie_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':subcategorie_id', $subcategorie_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result['count'] > 0 ){
    $_SESSION['alert'] = "You can't delete a subcategory that is associated with a product. Please delete the product first.";
    header('Location: ../index.php?page=categoriesmanage');
    exit();
}elseif ($subcategorie_id == 1 || $subcategorie_id == 5) {
    $_SESSION['alert'] = "You can't delete this subcategory";
    header('Location: ../index.php?page=categoriesmanage');
    exit();
}
else{
    $sql = "DELETE FROM `subcategories` WHERE subcategorie_id = :subcategorie_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':subcategorie_id', $subcategorie_id);
    $stmt->execute();

    $_SESSION['Success'] = "De subcategorie is succesvol verwijderd.";
header('Location: ../index.php?page=categoriesmanage');
exit();
}
?>