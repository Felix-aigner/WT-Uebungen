


<?php //putenv('LDAPTLS_REQCERT=never');?> 
<?php
    session_start(); //beim start der Seite wird dies session gestartet
/*
    if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"]!="on")
    {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit;
    }

    $ldapserver="ldap.technikum-wien.at";
    $serchbase="dc=technikum-wien, dc=at";

    $username=(isset($_POST['username']))?$_POST['username']:NULL;
    $password=(isset($_POST['password']))?$_POST['password']:NULL;

    if(!$username)
    {
        include("login-form.php");
    }
    else
    {
        $username=strtolower($username);
        $ds=ldap_connect($ldapserver);
        if(!$ds){$error = '<div class="alert alert-danger">Invalid Login</div>';exit;}
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERALS, 0);

        $ldapbind=false;
        if(ldap_start_tls($ds))
        {
            $dn="ou=People," . $searchbase;
        }
        $ldapbind=@ldap_bind($ds, "uid=".$username . "," . $dn, $password);
        if($ldapbind)
        {
            $filter="(uid=$username)";
            $justthese=array("ou", "sn", "givenname", "mail");
            $sr=ldap_search($ds, $dn, $filter, $justthese);
            $info=ldap_get_entries($ds, $sr);
            echo $info["count"]."entries returned\n<br/>";
            $k=0;
            for($i=0;$k<$info[$i]["count"];$k++)
            {
                $data=$info[$i][$k];
                echo $data.": ".$info[$i][$data][0]."\n<br/>";
            }
        }
        ldap_close($ds);
        if(!$ldapbind)
            echo "(connection error)\n";
        else
            echo "(connection okay)\n";
    }
    */


    $_SESSION['section']="Home";//per default wird in der section "Home" gespeichert, damit der home-screen auch beim ersten aufrufen geladen wird.
    $user = array( //array für die korrekten userdaten
        "user" => "test",
        "pass"=>"1234"          
    );
    $error = ""; //error wir ohne inhalt vordefiniert, damit nachher ein alert "ohne inhalt" ausgegeben werden kann 
    
    if(!isset($_COOKIE['page'])) //wenn der page cookie noch nicht gesetzt ist, soll er initialisiert werden
    {
        setcookie("page", "Home", time() + (86400 * 30), "/");
    }
    
    if(isset($_POST['username'],$_POST['password']))//abfrage ob im login-panel etwas eingegeben wurde
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];
        if($username == $user['user'] && $pass == $user['pass'])//überprüfen ob die eingaben stimmen
        {
            if(!isset($_COOKIE['user']))//abfrage ob der usercookie noch nicht gesetzt wurde
            {
                setcookie("user", $username, time() + (86400 * 30), "/"); // 86400 = 1 day
            }
            else
            {
                $_COOKIE['user']=$username; //wenn der cookie bereits initiiert wurde bekommt er den value von user
            }
            $_SESSION['simple_login'] = $username; //username wird in der session gespeichert
        }
        else
        {
            $error = '<div class="alert alert-danger">Invalid Login</div>';   //allert wird aufgefüllt um nachher wieder ausgegeben zu werden
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
    <link href="res/style.css" type="text/css" rel="stylesheet">
</head>
<body>

    <header>
        <div class="container">
            <img src="res/banner-shop.jpg" alt="Banner-Shop"/>
        </div>
    </header>
    <?php 
    if(!isset($_SESSION['simple_login']))//wechsel zwischen login und logout form (je nach angemeldet oder nicht)
    {
        include("login-form.php"); 
    }
    else
    {
        include("logout-form.php");
    }
    ?>

    <?php
        if(isset($_GET['section']))//wenn ein neuer menüpunkt angeklickt wird, wird das im entsprechenden cookie gespeichert
        {
            
            $_COOKIE['page'] = $_GET['section'];
            $page =  $_COOKIE['page'];
        }
        $page = $_COOKIE['page'];
        //laden des section-entsprechenden php files
        if($page=="Home")
        {
            include("Home.php");
        }
        else if($page=="Produkte")
        {
            include("Produkte.php");
        }
        else if($page=="Warenkorb")
        {
            include("Warenkorb.php");
        }
        else if($page=="Gallery")
        {
            include("Gallery.php");
        }else{}
    ?>
   

    
    </body>
</html>
