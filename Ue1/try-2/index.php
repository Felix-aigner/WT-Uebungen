<?php
    session_start();
    $user = array(
        "user" => "test",
        "pass"=>"1234"          
    );
    $error = "";
    
    if(!isset($_COOKIE['']))
    
    

    //echo daten
    echo session_id()."<br/>";
    echo $_COOKIE['user']."<br/>";
    echo $cookie_page."<br/>";
    //echo daten

    
    if(isset($_POST['username'],$_POST['password']))
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];
        if($username == $user['user'] && $pass == $user['pass'])
        {
            if(!isset($_COOKIE['user']))
            {
                setcookie("user", $username, time() + (86400 * 30), "/"); // 86400 = 1 day
            }
            $_SESSION['simple_login'] = $username;
        }
        else
        {
            $error = '<div class="alert alert-danger">Invalid Login</div>';   
        }

    }

    if($_COOKIE['user']==$user['user'] && !isset($_SESSION['simple-login']))
    {
        $_SESSION['simple_login']=$_COOKIE['user'];
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>WT-Webshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="res/style.css" type="text/css" rel="stylesheet">
</head>
<body>

    <header>
        <div class="container">
            <img src="res/banner-shop.jpg" alt="Banner-Shop"/>
        </div>
    </header>
    <?php 
    if(!isset($_SESSION['simple_login']))
    {
        include("login-form.php"); 
    }
    else
    {
        include("logout-form.php");
    }
    ?>

    <?php
        if(isset($_GET['section']))
        {
            setcookie("page", $_SESSION['section'], time() + (86400 * 30), "/");
            $page = $_SESSION['section'];
            echo "<br/><h2 style=\"text-align: center;\"> $page </h2>";
        }
        
    ?>

    </body>
</html>
