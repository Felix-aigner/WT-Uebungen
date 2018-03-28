
 <header>
    <div class="container">
        <img src="res/banner-shop.jpg" alt="Banner-Shop"/>
    </div>
</header>

<?php
    session_start(); //beim start der Seite wird dies session gestartet

        if(!isset($_SESSION['login']))
        {
        //If the HTTPS is not found to be "on"
        if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
        {
            //Tell the browser to redirect to the HTTPS URL.
            header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
            //Prevent the rest of the script from executing.
            exit;
        }

       $ldapserver = "ldap.technikum-wien.at";
       $searchbase = "dc=technikum-wien,dc=at";
    
       $username = (isset($_POST['username']))?$_POST['username']:NULL;
       $password = (isset($_POST['password']))?$_POST['password']:NULL;
       
    
       if (!$username)
       {
          // HTML-Formular ausschreiben
            include("login-form.php");
          
       } else {
           // LDAP-Login probieren
           include("logout-form.php");
           $username = strtolower($username);
    
           // LDAP connect
           $ds=ldap_connect($ldapserver);
           if (!$ds) {echo "Connect-Error"; exit;}
           
           // LDAP settings
           ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
           ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
           
           // LDAP bind
           $ldapbind=false;
           if(ldap_start_tls($ds)) // verschlüsselte Verbindung verwenden
              $dn = "ou=People,".$searchbase;  // wo wird gesucht?
              $ldapbind = @ldap_bind($ds,"uid=".$username.",".$dn,$password);
              if ($ldapbind) {
                  // LDAP search (Suche am gebundenen Knoten)
                  $filter="(uid=$username)";
                  $justthese = array("sn", "givenname"); // nur nach diesen Einträgen suchen
                  $sr=ldap_search($ds, $dn, $filter, $justthese); // Suche wird durchgeführt
                  $info = ldap_get_entries($ds, $sr);             // gefundene Einträge werden ausgelesen
                  //echo $info["count"]." entries returned\n<br>";
                  $ii=0;
                  $data=$info[0][0];
                  $vorname=$info[0][$data][0];
                  $_SESSION['login']=$vorname;
              }
              ldap_close($ds);
           if(!$ldapbind){
              echo "(Connection ERROR)\n";
              unset($_SESSION['login']);
              header("Refresh:0");
            }
          
        }
    }
    else
    {
        include("logout-form.php");
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
            <?php if(isset($_SESSION['login'])) 
            {
                $name=$_SESSION['login'];
                
                echo "<div class=\"user\"><h3> Eingeloggt als $name</h3></div>";   
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
                ?>
                <div class="info">
                    <div class="Gallery">
                        <h2>Gallery</h2>                        
                    </div>
                </div>
                <?php
                if(isset($_SESSION['login']))
                {
                    ?>
                    <div class="upload-form col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?php
                    include("upload-form.php");
                    include("upload.php");
                    ?>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <?php
                    include("Gallery.php");
                    ?>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                        <h3>Zum uploaden von Dateien<br/>melden sie sich an</h3>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                    <?php
                    include("Gallery.php");
                    ?>
                    </div>
                    <?php
                }
                
            }
        ?>
    </body>
</html>
