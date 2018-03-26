


<?php ?> 
<?php
    session_start(); //beim start der Seite wird dies session gestartet


    

    /* sicheres LDAP-Login
      1) Verbindung Browser - Webserver wird zwingend auf HTTPS gestellt
      2) Verbindung Webserver - LDAP-Server erfolgt verschlüsselt
    
      Achtung: bei der Verwendung von XAMPP kann es zu Problemen kommen
      --> in der php.ini muss "extension=php_ldap.dll" oder "extension=ldap"
      inkludiert sein (gegebenenfalls Strichpunkt am Anfang weg)
      --> Da das Standardzertifikat des Apache unter XAMPP nicht zertifiziert
      ist, kann der Browser beim ersten Aufruf erwarten, dass das Zertifikat
      akzeptiert wird (permantent zulassen)
      --> unter Windows kann es sein, dass die Datei ldap.conf fehlt
      --> ldap.conf muss die Zeile "TLS_REQCERT never" enthalten
      --> es kann verschiedene Orte geben, wo ldap.conf erwartet wird
      (versuchen Sie es in dieser Reihenfolge)
      --> c:\openldap\sysconf
      --> c:\openldap
      --> c:\
      --> c:\xampp
      --> c:\xampp\apache\conf
    
     */
    
    /* Überprüfen auf HTTPS, gegebenenfalls umschalten 
      -----------------------------------------------
     */
    //If the HTTPS is not found to be "on"
    if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") {
        //Tell the browser to redirect to the HTTPS URL.
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        //Prevent the rest of the script from executing.
        exit;
    }
    
    //ldap config
    
    define("LDAPPATH", "ldap.technikum-wien.at");
    define("LDAPBASE", "dc=technikum-wien,dc=at");
    
    //formular lesen
    $username = (isset($_POST['username'])) ? $_POST['username'] : NULL;
    $password = (isset($_POST['password'])) ? $_POST['password'] : NULL;
    
    if (!$username) {
        showForm($username, $password);
    } else {
        lookupUserData($username, $password);
    }
    
    function showForm($username, $password){
        include("login-form.php");   
    }
    
    function lookupUserData($username, $password){
        // LDAP-Login probieren
    
        $clearedLoginname = strtolower($username);
        // LDAP connect
        $ldapConnection = establishConnection();
        // LDAP bind
        $ldapbind = false;
    
        if (ldap_start_tls($ldapConnection)){ // verschlüsselte Verbindung verwenden
            $directoryName = "ou=People," . LDAPBASE;  // wo wird gesucht?
            $ldapbind = ldap_bind($ldapConnection, "uid=" . $clearedLoginname . "," . $directoryName, $password);
            if ($ldapbind) {
                performLookupAndDisplayData($clearedLoginname,$ldapConnection,$directoryName);
            }
            ldap_close($ldapConnection);
            if (!$ldapbind){
                echo "(Connection ERROR)\n";
            } else {
                echo "(Connection OK)\n";
            }
        } else {
            echo "error";
            exit;
        }
        
    }
    
    function establishConnection(){
        $ldapConnection = ldap_connect(LDAPPATH);
         if (!$ldapConnection) {
            echo "Connect-Error";
            die();
        }
    
        // LDAP settings
        ldap_set_option($ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapConnection, LDAP_OPT_REFERRALS, 0);
        
        return $ldapConnection;
    }
    
    function performLookupAndDisplayData($clearedLoginname,$ldapConnection,$directoryName){
        //erfolgreich angemeldet
        // LDAP search (Suche am gebundenen Knoten)
        $filter = "(uid=$clearedLoginname)";
        $justthese = array("ou", "sn", "givenname", "mail"); // nur nach diesen Einträgen suchen
        $searchResult = ldap_search($ldapConnection, $directoryName, $filter, $justthese); // Suche wird durchgeführt
        $info = ldap_get_entries($ldapConnection, $searchResult); // gefundene Einträge werden ausgelesen
    
        vardump($info);
    
        echo $info["count"] . " entries returned\n<br>";
        $entries = $info[0];
        foreach ($entries as $key => $value) {
            echo $key . ":  " . $value . "\n<br>";
        }
    }
    

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
   /* if(!isset($_SESSION['simple_login']))//wechsel zwischen login und logout form (je nach angemeldet oder nicht)
    {
        include("login-form.php"); 
    }
    else
    {
        include("logout-form.php");
    }*/
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
            if(isset($_SESSION['simple_login']))
            {
                ?><div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"><?php
                include("upload.php");
                ?></div><?php
            }
            include("Gallery.php");
        }else{}
    ?>
   

    
    </body>
</html>
