<?php
    $error = "";
    if(isset($_POST['username'],$_POST['password'])){
 
        
        $user = array(
                "user" => "test",
                "pass"=>"1234"          
                );
        $username = $_POST['username'];
        $pass = $_POST['password'];
        if($username == $user['user'] && $pass == $user['pass']){
            session_start();
            $cookie_name = $username;
            $cookie_waren = 0;
            setcookie($cookie_name, $cookie_waren, time() + (86400 * 30), "/"); // 86400 = 1 day

            $_SESSION['simple_login'] = $username;
            include("home.php");
            exit();
        }else{
            $error = '<div class="alert alert-danger">Invalid Login</div>';
        }
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>WT-Webshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="login-form">
            <h3>Please sign in</h3>
            <?php echo $error; ?>
            <form method="post" action="index.php">
                <fieldset>
                    <div class="form-group">
                        <input placeholder="Username" name="username" type="text">
                    </div>
                    <div class="form-group">
                        <input placeholder="Password" name="password" type="password" value="">
                    </div>
                        <input type="submit" value="Login"/>
                </fieldset>
            </form>
        </div>
        <div>
            <?php
                include("navi.php");
            ?>
        </div>
    </nav>

    <main>

        <h2>Welcome to WT-Webshop</h2>
        <h3>To view further information login</h3>


    </main>



    </body>
</html>
