<?php
    
    if(!isset($_SESSION['simple_login'])){
        header("Location: index.php");
        exit();
    }
     

?>


<div class="logout-form">
    <h3>Sign out</h3>
    <form action="logout.php">
                <fieldset>
                        <input type="submit" value="Logout"/>
                </fieldset>
            </form>
</div>




<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Wt-Webshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
   

    <main>

        <h2>Welcome to WT-Webshop</h2>
        <h3>Here you can view our content</h3>


    </main>



    </body>
</html>
