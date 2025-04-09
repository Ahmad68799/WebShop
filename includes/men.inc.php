<?php
include '../private/connection.php';
?>
<body>
<section class="products1">
    <div class="men-collection">
        <div class="heading">
            <h1>MEN COLLECTION</h1>
        </div>
        <div class="content">
            <!-- Categorieën -->
            <aside class="men-list">
                <h1>Categories:</h1>
                <?php
                $stmt = $pdo->prepare("SELECT * FROM subcategories WHERE main_categorie_id = 4");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $categorie) {
                    echo '
                           <ul>
                                <li><a href="index.php?page=men&subcategorie_id=' . htmlspecialchars($categorie['subcategorie_id']) . '">' . htmlspecialchars($categorie['name']) . '</a></li>
                           </ul>
                        ';
                }
                ?>
            </aside>

            <!-- Product content -->
            <div class="product-grid1">
                <?php
                $subcategorie_id = isset($_GET['subcategorie_id']) ? $_GET['subcategorie_id'] : null;

                $query = "
                    SELECT * FROM products
                    JOIN subcategories ON products.subcategorie_id = subcategories.subcategorie_id
                    JOIN main_categories ON subcategories.main_categorie_id = main_categories.main_categorie_id
                    WHERE subcategories.main_categorie_id = 4
                ";

                if ($subcategorie_id && $subcategorie_id != 1) {
                    $query .= " AND products.subcategorie_id = :subcategorie_id";
                }

                $stmt = $pdo->prepare($query);

                if ($subcategorie_id && $subcategorie_id != 1) {
                    $stmt->bindParam(':subcategorie_id', $subcategorie_id, PDO::PARAM_INT);
                }

                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $product) {
                    echo '
                            <div class="product-container1">
                                <div class="box1">
                                    <a class="a_home_link" href="index.php?page=productpage&product_id=' . htmlspecialchars($product['product_id']) . '">
                                        <img src="data:image/jpeg;base64,' . base64_encode($product['photo']) . '" alt="Product Image">
                                        <h2>' . htmlspecialchars($product['name']) . '</h2>
                                        <h3 class="price">&euro;' . htmlspecialchars($product['price']) . '</h3>
                                    </a>
                                </div>
                            </div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>
</body>