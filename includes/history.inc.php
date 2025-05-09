<?php

include '../private/connection.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch order history
    $stmt = $pdo->prepare("
        SELECT h.orderhistory_id, h.date, op.product_id, op.quantity, op.totalprice, p.name, p.photo
        FROM history h
        JOIN orderproducts op ON h.orderhistory_id = op.orderhistory_id
        JOIN products p ON op.product_id = p.product_id
        WHERE h.user_id = :user_id
        ORDER BY h.date DESC
    ");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $order_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $order_history = [];
}
?>

<body>
<section class="shopping-cart">
    <div class="cart-container">
        <h2>Order History</h2>
        <div class="cart-items">
            <?php if (!empty($order_history)): ?>
                <?php foreach ($order_history as $order): ?>
                    <div class="cart-item">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($order['photo']); ?>" alt="Product Image">
                        <div class="item-info">
                            <h3><?php echo htmlspecialchars($order['name']); ?></h3>
                            <p class="price">€<?php echo number_format($order['totalprice'], 2); ?></p>
                            <label>Amount:</label>
                            <input type="number" value="<?php echo htmlspecialchars($order['quantity']); ?>" min="1" readonly>
                            <p>Order Date: <?php echo htmlspecialchars($order['date']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
</body>