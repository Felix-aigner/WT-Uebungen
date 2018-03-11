<?php 
    session_start();
    unset($_COOKIE['user']);
    unset($_COOKIE['page']);

    unset($_SESSION['simple_login']);
    header("Location: index.php");
?>