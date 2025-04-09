<?php
include "../private/connection.php"; // Ensure this is included to fetch subcategories
?>

<body>
<form action="PHP/addproduct.php" method="post" enctype="multipart/form-data">
    <div class="small-container">
        <div class="product-box">
            <div class="row1">
                <div class="col-2">
                    <input type="file" name="image" required>
                </div>
                <div class="col-2">
                    <label>Product Name:</label>
                    <input type="text" name="name" required>

                    <label>Product Price:</label>
                    <input type="text" name="price" required>

                    <input type="hidden" name="product_id">

                    <label>Choose a Category:</label>
                    <select name="subcategory_id" class="add-categories_product" required>
                        <?php
                        $stmt = $pdo->prepare("SELECT subcategorie_id, name FROM `subcategories`");
                        $stmt->execute();
                        $subcategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($subcategories) {
                            foreach ($subcategories as $subcategory) {
                                echo '<option value="' . htmlspecialchars($subcategory['subcategorie_id']) . '">' . htmlspecialchars($subcategory['name']) . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <h3>Product Details</h3>
                    <textarea name="product_info" rows="4" cols="50"></textarea>
                </div>
                <button type="submit" class="add-cart">Add Product</button>
            </div>
        </div>
    </div>
</form>
</body>