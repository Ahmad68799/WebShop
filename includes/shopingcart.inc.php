<?php

include '../private/connection.php';

$cart_items = [];
$total_price = 0;

if (isset($_SESSION['user_id'])) {
    // Fetch cart from database
    $stmt = $pdo->prepare("SELECT products.product_id, products.name, products.price, cart.quantity, products.photo 
                           FROM cart 
                           JOIN products ON cart.product_id = products.product_id 
                           WHERE cart.user_id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch cart from session
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $stmt = $pdo->prepare("SELECT product_id, name, price, photo FROM products WHERE product_id = :product_id");
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($product) {
                $product['quantity'] = $quantity;
                $cart_items[] = $product;
            }
        }
    }
}

foreach ($cart_items as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

// Display the shopping cart
echo '<div class="cart-container">';
echo'<form id="cart-form" action="PHP/shopingcart.php" method="post">';
echo '<div class="cart-items">';
foreach ($cart_items as $item) {
    echo '
        <div class="cart-item">
            <img src="data:image/jpeg;base64,' . base64_encode($item['photo']) . '" alt="Product Image">
            <div class="item-info">
                <h3>' . htmlspecialchars($item['name']) . '</h3>
                <p class="price">€' . number_format($item['price'], 2) . '</p>
                  <form action="PHP/shopingcart.php" method="post">
                    <input type="hidden" name="product_id" value="' . $item['product_id'] . '">
                    <label for="quantity_' . $item['product_id'] . '">Amount:</label>
                    <input type="number" name="quantity" value="' . htmlspecialchars($item['quantity']) . '" min="1">
                    <button type="submit" class="update-btn">Update</button>
                </form>
                <form id="cart-form" action="PHP/shopingcartdelete.php" method="post">
                <input type="hidden" name="product_id" value="' . $item['product_id'] . '">
                <button type="submit" name="remove" value="' . $item['product_id'] . '" class="remove-btn">Delete</button>
                  </form>
            </div>
        </div>
    ';
}
echo '</div>
      <div class="checkout-box">
          <h3>Total Price: €' . number_format($total_price, 2) . '</h3>
          <form action="PHP/checkout.php" method="post">
                <a href="index.php?page=chekout" class="checkout-btn">Checkout</a>
          </form>
      </form>
      </div>
    </div>';
?>