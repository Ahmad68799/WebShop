<?php
include "../private/connection.php";
?>

<!-- products -->
<section class="products">
    <div class="heading">
        <h1>Manage Products</h1>
        <a class="shopnow_btn" href="index.php?page=addproduct">Add products</a>
    </div>

    <?php
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        echo '
    <div class="product-container">
         <div class="box">
           <img src="data:image/jpeg;base64,' . base64_encode($product['photo']) . '" alt="">
               <h2>' . htmlspecialchars($product['name']) . '</h2>
              <h3 class="price">' . htmlspecialchars($product['price']) . '</h3>
              <a class="edit_btn1" href="index.php?page=productedit&product_id=' . $product['product_id'] . '">Edit</a>
              <button class="remove-btn" onclick="confirmDelete(' . htmlspecialchars($product['product_id']) . ')">Delete</button>
         </div>
    </div>
        ';
    }
    ?>
</section>
<script>
    function confirmDelete(product_id) {
        if (confirm("Are you sure you want to DELETE this product?")) {
            window.location.href = 'PHP/productdelete.php?product_id=' + product_id;
        }
    }
</script>