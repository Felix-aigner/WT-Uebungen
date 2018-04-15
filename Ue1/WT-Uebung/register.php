<?php
    include("datenbankconnection.php");
    $usernameReg = $passwordReg = $passwortRepeat = $vornameReg = $nachnameReg = $emialReg = "";
?>
<div>
    <h2>Please fill in you information</h2>

    <form action="./?section=register" method="post">
        <label for="username">Username</label><br/>
        <input type="text" name="usernameReg" placeholder="Usernamen eingeben" value="<?php echo $usernameReg; ?>"><br/>
        <label for="password">Passwort</label><br/>
        <input type="password" name="passwordReg" placeholder="Passwort eingeben" value="<?php echo $passwordReg; ?>"><br/>
        <label for="password">Passwort wiederholen</label><br/>
        <input type="password" name="passwordRepeat" placeholder="Passwort wiederholen" value="<?php echo $passwortRepeat; ?>"><br/>
        <label for="vorname">Vorname</label><br/>
        <input type="text" name="vornameReg" placeholder="Vornamen eingeben" value="<?php echo $vornameReg; ?>"><br/>
        <label for="nachname">Nachname</label><br/>
        <input type="text" name="nachnameReg" placeholder="Nachname eingeben" value="<?php echo $nachnameReg; ?>"><br/>
        <label for="email">Email</label><br/>
        <input type="text" name="emailReg" placeholder="Email eingeben" value="<?php echo $emialReg; ?>"><br/>

        <button type="submit">Sign up</button>
    </form>
</div>