<?php

$user = $_POST['user'];
$password = $_POST['password'];

if($user=="test" && $password=="1234")
{
    $_SESSION['user']=$user;
    include_once("index.php");
}
else
{
    include_once("index.php");
}





?>