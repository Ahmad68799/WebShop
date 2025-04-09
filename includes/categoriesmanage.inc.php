<?php
include "../private/connection.php";
?>

<body>
<section class="shopping-cart">
    <div class="cart-container1">
        <h2>Edit Supcategory</h2>

        <?php
        $stmt = $pdo->prepare("SELECT subcategorie_id, name FROM `subcategories` WHERE main_categorie_id = 4");
        $stmt->execute();
        echo '<h3>MEN</h3>';

        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '
                <div class="cart-item1">
                    <div class="item-info1">
                        <h3>' . htmlspecialchars($result['name']) . '</h3>
                    </div>
                    <div class="buttens1">
                        <button class="remove-btn" onclick="confirmDelete(' . htmlspecialchars($result['subcategorie_id']) . ')">Delete</button>
                        <a href="index.php?page=editcategories&id=' . $result['subcategorie_id'] . '" class="adjust-btn">Edit</a>
                    </div>
                </div>
                <hr class="divider">';
        }
        ?>

        <?php
        $stmt = $pdo->prepare("SELECT subcategorie_id, name FROM `subcategories` WHERE main_categorie_id = 5");
        $stmt->execute();
        echo '<h3>WOMEN</h3>';

        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '
                <div class="cart-item1">
                    <div class="item-info1">
                        <h3>' . htmlspecialchars($result['name']) . '</h3>
                    </div>
                    <div class="buttens1">
                        <button class="remove-btn" onclick="confirmDelete(' . htmlspecialchars($result['subcategorie_id']) . ')">Delete</button>
                        <a href="index.php?page=editcategories&id=' . $result['subcategorie_id'] . '" class="adjust-btn">Edit</a>
                    </div>
                </div>
                <hr class="divider">';
        }
        ?>
    </div>
</section>
</body>
<script>
    function confirmDelete(subcategorie_id) {
        if (confirm("Are you sure you want to DELETE this category?")) {
            window.location.href = 'PHP/deletecategorie.php?subcategorie_id=' + subcategorie_id;
        }
    }
</script>