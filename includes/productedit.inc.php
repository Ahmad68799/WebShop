<?php
include "../private/connection.php";
?>

<body>
<form action="PHP/productedit.php" method="POST" enctype="multipart/form-data">
<div class="small-container">
            <div class="product-box">
                <div class="row1">
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = :product_id");
                    $stmt->bindParam(':product_id', $_GET['product_id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (!$product) {
                        die("Product not found.");
                    }
                    ?>

                    <div class="col-2">

                        <?php if (!empty($product['photo'])): ?>
                            <img  src="data:image/jpeg;base64,<?= base64_encode($product['photo']) ?>" alt="Product Image" class="current_image">
                        <?php endif; ?>

                        <input type="file" name="image">
                    </div>
                    <div class="col-2">
                        <label>Edit Name:</label>

                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>" required>

                        <input type="hidden" name="subcategorie_id" value="<?= htmlspecialchars($product['subcategorie_id']) ?>">

                        <input type="text" name="product_name" value="<?= htmlspecialchars($product['name']) ?>" required>

                        <label>Edit Price:</label>
                        <input type="text" name="product_price" value="<?= htmlspecialchars($product['price']) ?>" required>
                        <h4>choose category</h4>
                        <select name="subcategorie_id" class="add-categories_product">
                            <?php
                            $stmt = $pdo->prepare("SELECT subcategorie_id, name FROM `subcategories`");
                            $stmt->execute();
                            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $subcategory) {
                                $selected = ($subcategory['subcategorie_id'] == $product['subcategorie_id']) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($subcategory['subcategorie_id']) . '" ' . $selected . '>' . htmlspecialchars($subcategory['name']) . '</option>';
                            }
                            ?>
                        </select>
                        <h3>Edit Product Details</h3>
                        <textarea name="info" rows="4" cols="50"><?= htmlspecialchars($product['description']) ?></textarea>
                    </div>
                    <button type="submit" class="add-cart">Edit</button>
                </div>
            </div>
        </div>
    </form>
</body>