<nav>
    <div class="menu">
        <ul>
            <li><a href="index.php?section=Home">Home</a><br/></li>
            <li><a href="index.php?section=Produkte">Produkte</a></li>
            <li><a href="index.php?section=Gallery">Gallery</a></li>
        </ul>
    </div>
    <div class="login-form">
        <?php
        echo "<html>";
        echo "<head>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">";
        echo "<title>FH Verwaltung - Login</title>";
        echo "<meta name=\"Description\" content=\"\">";
        echo "<meta name=\"Keywords\" content=\"\">";
        echo "<link rel='stylesheet' type='text/css' href='fh.css'>";
        echo "</head>";
        echo "<body bgcolor=\"#FFFFFF\" text=\"#000000\" style=\"font-family:Tahoma;font-size:10pt;\">";
        echo "<h4>Melden dich bitte mit deinem<br> FH Account an.</h4><br>\n";
        echo "<form action='".$_SERVER['PHP_SELF']."' enctype=\"multipart/form-data\" method='post'>\n";
        echo "<table border=0>\n";
        echo "<tr valign='top'><td>Benutzer:</td><td>";
        echo "<input type='text' name='username' size=15 value='".$username."'></td></tr>\n";
        echo "<tr valign='top'><td>Kennwort:</td><td>";
        echo "<input type='password' name='password' size=15 value='".$password."'></td></tr>\n";
        echo "<tr valign='top'><td></td><td><input type='submit' name='login' value='Login'></td><td></td></tr>\n";
        echo "</table>\n</form><br>\n";
        echo "</body>";
        echo "</html>";
        ?>
    </div>
</nav>