
<?php
    session_destroy();
    unset($_SESSION['user']);
    include_once("index.php");
?>