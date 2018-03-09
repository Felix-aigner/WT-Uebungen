<?php

if(isset($_POST['submit']))
{
    include_once 'data-include.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    //Error Handlers
    if(empty($username) || empty($password))
    {
        header("Location: signup.php?signup=empty");
        exit();
    }
    else
    {
        $sql = "INSERT INTO users (user_name, user_pwd) VALUES ('$username', '$password');";
        mysqli_query($conn, $sql);
        header("Location: signup.php?signup=success");
        exit();
    }

}
else
{
    header("Location: signup.php");
    exit();
}
