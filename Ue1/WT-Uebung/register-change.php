<h3>Ändern sie ihre Account-Details</h3>
<?php
include("datenbankconnection.php");

$username = $pwd = $vorname = $nachname = $email = "";
$newpassword = $newvorname = $newnachname = $newemail = "";
$username = $_SESSION['username'];


$host     =   "localhost";          // Name, Adresse oder IP des MySQL Servers. Standardm��ig: localhost
$user     =   "root";               // Username zum einloggen am MySQL Server
$pass     =   '';	                // Passwort zum einloggen am MySQL Server
$dbname   =   "wt";                 // Name der Datenbank

$db = new mysqli($host, $user, $pass, $dbname);

if (mysqli_connect_errno() == 0) 
{
    $account = "SELECT vorname, nachname, email FROM WTUser WHERE username='$username'";
    $accquery = mysqli_query($db, $account);
    $row = mysqli_fetch_assoc($accquery);
    $vorname = $row["vorname"];
    $nachname = $row["nachname"];
    $email = $row["email"];
}
?>

<body>
    <div class="account-change">
        <form action="?section=register-change">
            <h2>Ihr Username ist<?php echo " " . "$username"; ?></h2></br>

                <label for="pwd"><b>Password</b></label>
                <input type="password" placeholder="Passwort ändern" name="newpassword" value="<?php echo $newpassword;?>"></br>

                <label for="psw-repeat"><b>Password wiederholen</b></label>
                <input type="password" placeholder="Passwort wiederholen" name="newpassword"></br>

                <label for="vorname"><b>Dein Vorname ist <?php echo "\"$vorname\" " ?></b></label>
                <input type="text" placeholder="Vorname ändern" name="newvorname" value="<?php echo $newvorname;?>"></br>

                <label for="nachname"><b>Dein Nachname ist <?php echo "\"$nachname\" " ?></b></label>
                <input type="text" placeholder="Nachname ändern" name="newnachname" value="<?php echo $newnachname;?>"></br>

                <label for="email"><b>Deine Email lautet <?php echo "\"$email\" " ?></b></label>
                <input type="text" placeholder="Email ändern" name="newemail" value="<?php echo $newemail;?>"></br>
            
                <button type="submit" class="cancelbtn" formaction='./index.php'>Cancel changes</button></br>
                <button type="submit" class="signupbtn">Submit</button>
        </form>
    </div>
</body>