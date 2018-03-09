
<!DOCTYPE <html>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
        <div class="login-form">
            <form action="validate-login.php" method="POST">
                <input type="text" name="username" placeholder="Username"/>
                <input type="password" name="password" placeholder="Passwort"/>
                <button type="submit" name="submit">Login</button>
            </form>
        </div>


    </nav>
</body>
</html>



<?php
    include_once("upper-part.php");
?>
<?php
    include_once("login-formular.php");
?>
<?php
    include_once("lower-part.php");
?>