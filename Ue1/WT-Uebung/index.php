
 <header>
    <div class="container">
        <img src="res/banner-shop.jpg" alt="Banner-Shop"/>
    </div>
</header>
<?php

	session_start(); //beim start der Seite wird dies session gestartet
<<<<<<< HEAD
	$_SESSION['changemade']=0;
=======

>>>>>>> e9b7414420a872130c6e59bc1ae44a2d36ce54c8
	if(isset($_POST['formaction']))
	{
		session_unset();
	}

	if(!isset($_SESSION['login']))
	{
		//If the HTTPS is not found to be "on"
		if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
<<<<<<< HEAD
		{		
			$_COOKIE['page'] = "Home";
=======
		{
>>>>>>> e9b7414420a872130c6e59bc1ae44a2d36ce54c8
			//Tell the browser to redirect to the HTTPS URL.
			header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
			//Prevent the rest of the script from executing.
			exit;
		}

		$ldapserver = "ldap.technikum-wien.at";
		$searchbase = "dc=technikum-wien,dc=at";

		$username = (isset($_POST['username']))?$_POST['username']:NULL;
		$passwort = (isset($_POST['passwort']))?$_POST['passwort']:NULL;

		if (!$username)
		{
			// HTML-Formular ausschreiben
			echo "<html>";
			echo "<head>";
			echo "<meta name=\"Description\" content=\"\">";
			echo "<meta name=\"Keywords\" content=\"\">";
			echo "</head>";
            echo "<body>";
            echo "<div class=\"login-form\">";
			echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
			echo "<table border=0>\n";
			if(isset($_SESSION['connection_error_un']))
			{
				echo "Username ist falsch.\n";
			}
			if(isset($_SESSION['connection_error_pw']))
			{
				echo "Passwort ist falsch.\n";
			}
			echo "<tr valign='top'><td class=\"login_text\">Benutzer:</td><td>";
			echo "<input type='text' name='username' size=20 value='".$username."'></td></tr>\n";
			echo "<tr valign='top'><td class=\"login_text\">Kennwort:</td><td>";
			echo "<input type='password' name='passwort' size=20 value='".$passwort."'></td></tr>\n";
			echo "<tr valign='top'><td></td><td><input type='submit' name='login' value='Login'></td><td></td></tr>\n";
			echo "<tr valign='top'><td></td><td><input type='submit' formaction='?section=register' name='regist' value='Registrieren'></td><td></td></tr>\n";
			echo "</table>\n</form><br>\n";
            echo "</div>";
            echo "</body>";
            echo "</html>";
		
		} 
		else 
		{
			$Pwd_hash = md5($passwort);
			$_SESSION['username']=$username;

			//Abfragen ob Eintrag in Datenbank ist
			$host     =   "localhost";          // Name, Adresse oder IP des MySQL Servers. Standardm��ig: localhost
			$user     =   "root";               // Username zum einloggen am MySQL Server
			$pass     =   '';	                // Passwort zum einloggen am MySQL Server
			$dbname   =   "wt";                 // Name der Datenbank

			// Verbindung zur Datenbank herstellen:
			$db = new mysqli($host, $user, $pass, $dbname);

			if (mysqli_connect_errno() == 0) 
			{
				$user_einlesen = "SELECT username FROM WTUser WHERE username='$username'";	//count(*) geht nicht
				//$result = $db->query($user_einlesen);
				//$count = $result->num_rows;

				$query = mysqli_query($db, $user_einlesen);

				if (!$query)
				{
					die('Error: ' . mysqli_error($db));
				}

				if(mysqli_num_rows($query) > 0)
				{
					$pw_einlesen = "SELECT pwd FROM WTUser WHERE username='$username'";
					$query = mysqli_query($db, $pw_einlesen);

					while ($qValues=mysqli_fetch_assoc($query))
					{
						if (is_null($qValues["pwd"]))
						{
							unset($_SESSION['noLDAPuser']);
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
								$ldapbind = @ldap_bind($ds,"uid=".$username.",".$dn,$passwort);
								if ($ldapbind) 
								{
									// LDAP search (Suche am gebundenen Knoten)
									$filter="(uid=$username)";
									$justthese = array("ou", "sn", "givenname"); // nur nach diesen Einträgen suchen
									$sr=ldap_search($ds, $dn, $filter, $justthese); // Suche wird durchgeführt
									$info = ldap_get_entries($ds, $sr);             // gefundene Einträge werden ausgelesen
									$data = $info[0][0];
									$Vorname = $info[0][$data][0];
									$data = $info[0][1];
									$Nachname = $info[0][$data][0];

									$_SESSION['login']=$username;
									$_SESSION['Vorname']=$Vorname;
									$_SESSION['Nachname']=$Nachname;
							
									
								}
								ldap_close($ds);
							
								if(!$ldapbind)
								{	
									$_SESSION['connection_error_pw']=1;
									unset($_SESSION['login']);
									header("Refresh:0");
								}
								else
								{  																		
									echo "<html>";
									echo "<head>";
									echo "<meta name=\"Description\" content=\"\">";
									echo "<meta name=\"Keywords\" content=\"\">";
                                    echo "</head>";
                                    echo "<div class=\"logout-form\">";
									echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
									echo "<tr valign='top'><td></td><td><input type='submit' name='formaction' value='Logout'></td><td></td></tr>\n";
                                    echo "</table>\n</form><br>\n";
                                    echo "</div>";
									echo "</body>";
									echo "</html>";
									echo "<p class=\"getItRight\">(Connection OK)</p>\n";
									unset($_SESSION['connection_error_un']);
									unset($_SESSION['connection_error_pw']);
								}
						}
						else
						{
							//echo "pwd data=".$qValues["pwd"];
							if($Pwd_hash == $qValues["pwd"])
							{
								$getName = "SELECT vorname, nachname FROM WTUser WHERE username='$username'";
								$query = mysqli_query($db, $getName);
								$row = mysqli_fetch_assoc($query);

								$_SESSION['noLDAPuser']=1;
								$_SESSION['login']=$username;
								$_SESSION['Vorname']=$row["vorname"];
								$_SESSION['Nachname']=$row["nachname"];

								
								echo "<html>";
								echo "<head>";
								echo "<meta name=\"Description\" content=\"\">";
								echo "<meta name=\"Keywords\" content=\"\">";
                                echo "</head>";
                                echo "<div class=\"logout-form\">";
								echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
								echo "<tr valign='top'><td></td><td><input type='submit' name='formaction' value='Logout'></td><td></td></tr>\n";
                                echo "</table>\n</form><br>\n";
                                echo "</div>";
								echo "</body>";
								echo "</html>";
								echo "<p class=\"getItRight\">(Connection OK)</p>\n";
								unset($_SESSION['connection_error_un']);
								unset($_SESSION['connection_error_pw']);
							}
							else
							{
								$_SESSION['connection_error_pw']=1;
								unset($_SESSION['login']);
								header("Refresh:0");
							}
						}
					}		
				}
				else
				{
					// LDAP-Login probieren
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
						$ldapbind = @ldap_bind($ds,"uid=".$username.",".$dn,$passwort);
						if ($ldapbind) 
						{
							// LDAP search (Suche am gebundenen Knoten)
							$filter="(uid=$username)";
							$justthese = array("ou", "sn", "givenname", "mail"); // nur nach diesen Einträgen suchen
							$sr=ldap_search($ds, $dn, $filter, $justthese); // Suche wird durchgeführt
							$info = ldap_get_entries($ds, $sr);             // gefundene Einträge werden ausgelesen
							//echo $info["count"]." entries returned\n<br>";
							$ii=0;
							/*for ($i=0; $ii<$info[$i]["count"]; $ii++){
								$data = $info[$i][$ii];
								echo $data.":  ".$info[$i][$data][0]."\n<br>";
							}*/
							$data = $info[0][0];
							$Vorname = $info[0][$data][0];
							$data = $info[0][1];
							$Nachname = $info[0][$data][0];
							$data = $info[0][3];
							$eMail = $info[0][$data][0];

							$_SESSION['login']=$username;
							$_SESSION['Vorname']=$Vorname;
							$_SESSION['Nachname']=$Nachname;
							$_SESSION['eMail']=$eMail;

							//In Datenbank schreiben
							$sql = "INSERT INTO WTUser (username, vorname, nachname, email, is_admin, is_ldap) VALUES ('$username', '$Vorname', '$Nachname', '$eMail', false, true)";
							if ($db->query($sql) === TRUE) 
							{
								echo "Erfolgreich angemeldet.";
							} 
							else 
							{            
								echo '<script language="javascript">alert("Error: Fehler.")</script>';
							}

						
						}
						ldap_close($ds);

					if(!$ldapbind)
					{	
						$_SESSION['connection_error']=1;
						unset($_SESSION['login']);
						header("Refresh:0");
					}
					else
					{  
						echo "<html>";
						echo "<head>";
						echo "<meta name=\"Description\" content=\"\">";
						echo "<meta name=\"Keywords\" content=\"\">";
                        echo "</head>";
                        echo "<div class=\"logout-form\">";
						echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
						echo "<tr valign='top'><td></td><td><input type='submit' name='formaction' value='Logout'></td><td></td></tr>\n";
                        echo "</table>\n</form><br>\n";
                        echo "</div>";
						echo "</body>";
						echo "</html>";
						echo "<p class=\"getItRight\">(Connection OK)</p>\n";
						unset($_SESSION['connection_error_un']);
						unset($_SESSION['connection_error_pw']);
					}
				}
			}
    		$db->close(); // Datenbankverbindung schließen
		}
	}
	else
	{
		
		echo "<html>";
		echo "<head>";
		echo "<meta name=\"Description\" content=\"\">";
		echo "<meta name=\"Keywords\" content=\"\">";
		echo "</head>";
        echo "<body>";
        echo "<div class=\"logout-form\">";
		echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
		echo "<tr valign='top'><td></td><td><input type='submit' name='formaction' value='Logout'></td><td></td></tr>\n";
        echo "</table>\n</form><br>\n";
        echo "</div>";
		echo "</body>";
		echo "</html>";
		echo "<p class=\"getItRight\">(Connection OK)</p>\n";
		unset($_SESSION['connection_error_un']);
		unset($_SESSION['connection_error_pw']);
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
                include("logout-form.php");
            }
            else
            {
                include("login-form.php");
            }
            ?> 
            <?php if(isset($_SESSION['login'])) 
            {
                $Vorname=$_SESSION['Vorname'];
                $Nachname=$_SESSION['Nachname'];
                
                echo "<div class=\"user\"><h4> Eingeloggt als $Vorname $Nachname</h4></div>";   
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
            else if($page=="register")
            {
                include("register.php");
            }
            else if($page=="Produkte")
            {
                include("Produkte.php");
            }
            else if($page=="Warenkorb")
            {
                include("Warenkorb.php");
			}
			else if($page=="register-change")
			{
				include("register-change.php");
			}
<<<<<<< HEAD
			else if($page=="Gallery")
=======
            else if($page=="Gallery")
>>>>>>> e9b7414420a872130c6e59bc1ae44a2d36ce54c8
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
                    include("upload.php");
                    include("upload-form.php");
                    ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <?php
					include("Gallery.php");
					
					if($page=="bildbearbeitung")
					{
						include("bildbearbeitung.php");
					}

                    ?>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="unlogged-form col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <h3>Bitte logge ich ein<br/>um Bilder hochzuladen!</h3>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
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
