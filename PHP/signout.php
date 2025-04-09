<?php
session_start();
unset($_SESSION['role_id']);
unset($_SESSION['user_id']);
header("location:../index.php?page=home");
?>