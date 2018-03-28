<?php 
    session_start();
    unset($_COOKIE['user']);
    unset($_COOKIE['page']);

    unset($_SESSION['login']);
    header("Location: index.php");
?>