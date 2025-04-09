<?php
include '../private/connection.php';

// Check if product_id is set in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    ?>
    <body>
    <form action="PHP/shopingcart.php" method="post">
    <div class="small-container">
        <div class="product-box">
            <div class="row1">
                <?php
                $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = :product_id");
                $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->execute();
                $product = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($product) {
                    // Display product details
                    echo '
                        <div class="col-2">
                            <img src="data:image/jpeg;base64,' . base64_encode($product['photo']) . '" alt="Product Image">
                        </div>
                        <div class="col-2">
                            <h1>' . htmlspecialchars($product['name']) . '</h1>
                            <h4>€' . htmlspecialchars($product['price']) . '</h4>
                            
                                <input type="hidden" name="product_id" value="' . htmlspecialchars($product['product_id']) . '">
                                <input type="number" name="quantity" value="1" min="1">
                                <button type="submit" class="add-cart">Add to Cart</button>
                            
                            <a href="" class="add-cart">Pay Now</a>
                            <h3>Product Details</h3>
                            <textarea name="product-info" rows="4" cols="50" readonly>' . htmlspecialchars($product['description']) . '</textarea>
                        </div>';
                } else {
                    echo 'Product not found.';
                }
                ?>
            </div>
        </div>
    </div>
    </form>
    </body>
    <?php
} else {
    echo 'No product selected.';
}
?>