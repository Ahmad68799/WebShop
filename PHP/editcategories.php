<?php
include '../../private/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subcategorie_id = $_POST["subcategorie_id"];
    $new_name = $_POST["edit_name"];
    $new_main_categorie_id = $_POST["main_categorie_id"];

    // Update query
    $stmt = $pdo->prepare("UPDATE `subcategories` SET `name` = :name, `main_categorie_id` = :main_categorie_id WHERE `subcategorie_id` = :subcategorie_id");
    $stmt->bindParam(":name", $new_name);
    $stmt->bindParam(":main_categorie_id", $new_main_categorie_id);
    $stmt->bindParam(":subcategorie_id", $subcategorie_id);
    $stmt->execute();
    header("Location: ../index.php?page=categoriesmanage");
}
?>

