<?php
session_start();
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 'home';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css/edit.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <?php
    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1) {
        include 'includes/navbarklant.inc.php';
    } elseif (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) {
        include 'includes/navbaradmin.inc.php';
    } else {
        include 'includes/navbargast.inc.php';
    }

        if (isset($_SESSION['alert'])): ?>
    <div class="alert">
        <span onclick="this.parentElement.style.display='none'" class="close-btn">&times;</span>
        <p><?php echo $_SESSION['alert']; ?></p>
    </div>
    <?php unset($_SESSION['alert']); ?>
    <?php endif;

    if (isset($_SESSION['success'])): ?>
        <div class="success">
            <span onclick="this.parentElement.style.display='none'" class="close-btn">&times;</span>
            <p><?php echo $_SESSION['success']; ?></p>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif;

    include 'includes/' . $page .'.inc.php';

    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2)  {

    }else if ($page == 'login' || $page =='register' || $page == 'shopingcart' || $page == "checkout" || $page == "history") {

    }else {
        include 'includes/footer.inc.php';
    }
    ?>
</body>
</html>
