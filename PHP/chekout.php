<?php
session_start();

include '../../private/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = $_POST['first_name'];
    $prefix = $_POST['prefix'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $street = $_POST['street'];
    $housenumber = $_POST['house_number'];
    $city = $_POST['city'];
    $zipcode = $_POST['zip_code'];
    $birth = $_POST['dob'];

    if ($housenumber < 1 || $zipcode < 0) {
        $_SESSION['alert'] = 'House number must be a positive number and Postal code must not be negative!';
        header('Location: ../index.php?page=chekout');
        exit;
    }

    // Validate birth date
    $currentDate = new DateTime();
    $birthDate = DateTime::createFromFormat('Y-m-d', $birth);

    if (!$birthDate || $birthDate >= $currentDate) {
        $_SESSION['alert'] = 'Please choose a valid date!';
        header('Location: ../index.php?page=chekout');
        exit;
    }

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Fetch cart items from database
        $stmt = $pdo->prepare("SELECT product_id, quantity FROM cart WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($cart_items)) {
            $_SESSION['alert'] = 'Uw winkelwagen is leeg. Voeg alstublieft producten toe aan uw winkelwagen voordat u afrekent.';
            header('Location: ../index.php?page=shopingcart');
            exit;
        }
        $stmt = $pdo->prepare("INSERT INTO history (user_id, date, username, prefix, lastname, place, street, house_number, zip_code, email, birth) VALUES (:user_id, NOW(), :first_name, :prefix, :last_name, :city, :street, :house_number, :zip_code, :email, :birth)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    } else {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $cart_items = $_SESSION['cart'];

            if (empty($cart_items)) {
                $_SESSION['alert'] = 'Uw winkelwagen is leeg. Voeg alstublieft producten toe aan uw winkelwagen voordat u afrekent.';
                header('Location: ../index.php?page=shopingcart');
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO history (user_id, date, username, prefix, lastname, place, street, house_number, zip_code, email, birth) VALUES (NULL, NOW(), :first_name, :prefix, :last_name, :city, :street, :house_number, :zip_code, :email, :birth)");

        } else {
            $_SESSION['alert'] = 'Uw winkelwagen is leeg. Voeg alstublieft producten toe aan uw winkelwagen voordat u afrekent.';
            header('Location: ../index.php?page=shopingcart');
            exit;
        }
    }

    $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindParam(':prefix', $prefix, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':street', $street, PDO::PARAM_STR);
    $stmt->bindParam(':house_number', $housenumber, PDO::PARAM_INT);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':zip_code', $zipcode, PDO::PARAM_STR);
    $stmt->bindParam(':birth', $birth, PDO::PARAM_STR);
    $stmt->execute();
    $orderhistory_id = $pdo->lastInsertId();

    // Insert each cart item into orderproducts table
    foreach ($cart_items as $item) {
        if (is_array($item) && isset($item['product_id'], $item['quantity'])) {
            $stmt = $pdo->prepare("INSERT INTO orderproducts (orderhistory_id, product_id, quantity, totalprice) VALUES (:orderhistory_id, :product_id, :quantity, (SELECT price FROM products WHERE product_id = :product_id) * :quantity)");
            $stmt->bindParam(':orderhistory_id', $orderhistory_id, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    // Clear cart
    if (isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        // Clear session cart for guests
        unset($_SESSION['cart']);
    }

    // Set success message
    $_SESSION['success'] = 'Uw bestelling is succesvol geplaatst!';
    header('Location: ../index.php?page=home');
    exit;
}
?>