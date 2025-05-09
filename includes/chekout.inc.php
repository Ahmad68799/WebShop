<?php
include '../private/connection.php';


$cart_items = ['cart'];
$total_price = ['totla_price'];

if (isset($_SESSION['user_id'])){
    $stmt =$pdo->prepare ("SELECT * FROM users WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<body>
<div class="container-pay">
    <form action="PHP/chekout.php" method="POST">
        <div class="row">
            <div class="col">
                <h3 class="title">Billing Address</h3>
                <div class="inputBox-pay">
                    <span>Name :</span>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars(isset($user['username']) ? $user['username'] : ''); ?>" placeholder="John" required>
                </div>
                <div class="inputBox-pay">
                    <span>Prefix :</span>
                    <input type="text" name="prefix" value="<?php echo htmlspecialchars(isset($user['prefix']) ? $user['prefix'] : ''); ?>" placeholder="van">
                </div>
                <div class="inputBox-pay">
                    <span>Last Name :</span>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars(isset($user['lastname']) ? $user['lastname'] : ''); ?>" placeholder="Doe" required>
                </div>
                <div class="inputBox-pay">
                    <span>E-mail :</span>
                    <input type="email" name="email" value="<?php echo htmlspecialchars(isset($user['email']) ? $user['email'] : ''); ?>" placeholder="example@example.com" required>
                </div>
                <div class="inputBox-pay">
                    <span>Street :</span>
                    <input type="text" name="street" value="<?php echo htmlspecialchars(isset($user['street']) ? $user['street'] : ''); ?>" placeholder="Street" required>
                </div>
                <div class="inputBox-pay">
                    <span>House Number :</span>
                    <input type="number" name="house_number" value="<?php echo htmlspecialchars(isset($user['house_number']) ? $user['house_number'] : ''); ?>" placeholder="House Number" min="1" required>
                </div>
                <div class="inputBox-pay">
                    <span>City :</span>
                    <input type="text" name="city" value="<?php echo htmlspecialchars(isset($user['place']) ? $user['place'] : ''); ?>" placeholder="City" required>
                </div>
                <div class="flex">
                    <div class="inputBox-pay">
                        <span>Date of Birth :</span>
                        <input type="date" name="dob" value="<?php echo htmlspecialchars(isset($user['birth']) ? $user['birth'] : ''); ?>" required>
                    </div>
                    <div class="inputBox-pay">
                        <span>Zip Code :</span>
                        <input type="text" name="zip_code" value="<?php echo htmlspecialchars(isset($user['zip_code']) ? $user['zip_code'] : ''); ?>" placeholder="123 456" required>
                    </div>
                </div>
            </div>
                  <div class="col">
      
                      <h3 class="title">payment</h3>
      
                      <div class="inputBox-pay">
                          <span>cards accepted :</span>
                          <img src="images/cards.png" alt="">
                      </div>
                      <div class="inputBox-pay">
                          <span>name on card :</span>
                          <input type="text" placeholder="mr. john deo">
                      </div>
                      <div class="inputBox-pay">
                          <span>credit card number :</span>
                          <input type="number" placeholder="1111-2222-3333-4444">
                      </div>
                      <div class="inputBox-pay">
                          <span>exp month :</span>
                          <input type="text" placeholder="january">
                      </div>
      
                      <div class="flex">
                          <div class="inputBox-pay">
                              <span>exp year :</span>
                              <input type="number" placeholder="2022">
                          </div>
                          <div class="inputBox-pay">
                              <span>CVV :</span>
                              <input type="number" placeholder="1234">
                          </div>
                      </div>
      
                  </div>
          
              </div>
      
              <input type="submit" value="Checkout" class="pay-btn">
      
          </form>
      </div>
</body>