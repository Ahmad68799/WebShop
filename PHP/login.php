<?php
session_start();
include '../../private/connection.php';

$email = $_POST["email"];
$password = $_POST["password"];


try{
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
        $_SESSION['role_id'] = $user['role_id'];
        $_SESSION['user_id'] = $user['user_id'];
        // Redirect op basis van rol
}

if($user['role_id'] == 1){
    header('Location: ../index.php?page=home');
}elseif ($user['role_id'] == 2) {
    header('Location: ../index.php?page=home');
    exit();
}else{
    $_SESSION['alert'] = 'Incorrect E-mail or Password! Please try again';
    header('Location: ../index.php?page=login');
    exit;
}

}catch (Exception $e){}

?>