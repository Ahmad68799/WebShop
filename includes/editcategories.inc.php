<?php
include '../private/connection.php';

if (!isset($_GET['id'])) {
    die("Null subcategorie .");
}

$subcategorie_id = $_GET['id'];

// Haal de subcategorie op
$stmt = $pdo->prepare("SELECT * FROM `subcategories` WHERE subcategorie_id = :subcategorie_id");
$stmt->bindParam(":subcategorie_id", $subcategorie_id);
$stmt->execute();
$subcategorie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$subcategorie) {
    die("Null subcategorie.");
}
?>

<body>
<div class="sign-up">
    <div class="login">
        <form action="php/editcategories.php" method="POST">
            <h1>Edit category</h1>

            <input type="hidden" name="subcategorie_id" value="<?= htmlspecialchars($subcategorie['subcategorie_id']) ?>">

            <label>Subcategory Name:</label>
            <input type="text" name="edit_name" value="<?= htmlspecialchars($subcategorie['name']) ?>" required>

            <label>Choose a category:</label>
            <select class="add-categories" name="main_categorie_id" required>
                <?php
                // Haal alle hoofdcategorieën op
                $stmt = $pdo->prepare("SELECT main_categorie_id, name FROM `main_categories`");
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Selecteer de huidige hoofdcategorie
                    $selected = ($result['main_categorie_id'] == $subcategorie['main_categorie_id']) ? "selected" : "";
                    echo '<option value="' . htmlspecialchars($result['main_categorie_id']) . '" ' . $selected . '>' . htmlspecialchars($result['name']) . '</option>';
                }
                ?>
            </select>
            <button type="submit" class="submit-btn">Update</button>
        </form>
    </div>
</div>
</body>