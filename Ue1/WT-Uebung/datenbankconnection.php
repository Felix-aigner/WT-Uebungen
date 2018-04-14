<?php

$username = (isset($_POST['usernameReg']))?$_POST['usernameReg']:NULL;
$pwd = (isset($_POST['passwordReg']))?$_POST['passwordReg']:NULL;
$vorname = (isset($_POST['vornameReg']))?$_POST['vornameReg']:NULL;
$nachname = (isset($_POST['nachnameReg']))?$_POST['nachnameReg']:NULL;
$email = (isset($_POST['emailReg']))?$_POST['emailReg']:NULL;

if($username && $pwd && $vorname && $nachname && $email)
{

    // Datenbankinformationen:
    $host     =   "localhost";          // Name, Adresse oder IP des MySQL Servers. Standardm��ig: localhost
    $user     =   "root";               // Username zum einloggen am MySQL Server
    $pass     =   '';                    // Passwort zum einloggen am MySQL Server
    $dbname   =   "wt";                 // Name der Datenbank

    // Verbindung zur Datenbank herstellen:
    $db=@new mysqli($host, $user, $pass, $dbname);

    if (mysqli_connect_errno() == 0) {

        $pwd_hash = md5($pwd);

        $sql = "INSERT INTO WTUser VALUES ('$username', '$pwd_hash', '$vorname', '$nachname', '$email', false, false)";

        ?> <script language="javascript"> alert("con established") </script> <?php

        if ($db->query($sql) === TRUE) 
        {
            echo "Erfolgreich rergistriert.";
            ?> <script language="javascript"> alert("written") </script> <?php
        } 
        else 
        {
            echo '<script language="javascript">alert("Error: "'. $username .'" bereits vergeben.")</script>';
            ?> <script language="javascript"> alert("not written") </script> <?php
        }
    }
    else 
    {
        echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler
        trat auf:' .mysqli_connect_errno(). ' : ' .mysqli_connect_error();
        ?> <script language="javascript"> alert("no con") </script> <?php
    }
    $db->close(); // Datenbankverbindung schließen
}
?>
