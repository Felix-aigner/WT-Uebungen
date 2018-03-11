<?php
    session_start();
?>
<!DOCTYPE <html>

<html>
<head>
    <meta charset="utf-8" />
    <title>Webshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>
<body>
    
       
        <?php
            if(!isset($_SESSION['user']))
            {
                include_once("login.php");
                include_once("main-loggedout.php");
            }
            else
            {
                ?>
                <nav>
                    <button action="logout.php">Logout</button>
                </nav>
                <?php
                include_once("main-loggedin.php");
            }
        ?>
      


   
    <main>

    </main>
   
    
</body>

</html>



