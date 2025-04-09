<?php
include '../private/connection.php';
?>
<body>
    <div class="sign-up">
        <div class="login">
        <form action="PHP/addcategories.php" method="GET">
            <h1>Add categorys</h1>

            <label>Supcategory Name:</label>
            <input type="text" name="supcategory_name">

            <label>Choose a category:</label>
            <select class="add-categories" name="main_categorie_id" required>
                <?php
                // Haal het main_categorie_id en name op uit de subcategorieën
                $stmt = $pdo->prepare("SELECT main_categorie_id, name FROM `main_categories`");
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // Print het name van de subcategorie in de dropdown
                    echo '<option value="' . htmlspecialchars($result['main_categorie_id']) . '">' . htmlspecialchars($result['name']) . '</option>';
                }
                ?>
            </select>
            <button type="submit" class="submit-btn">Add</button>
        </form>
    </div>
    </div>
</body>