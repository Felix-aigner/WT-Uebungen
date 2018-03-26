<nav>
    <div class="menu">
        <ul>
            <li><a href="index.php?section=Home">Home</a><br/></li>
            <li><a href="index.php?section=Produkte">Produkte</a></li>
            <li><a href="index.php?section=Gallery">Gallery</a></li>
        </ul>
    </div>
    <div class="login-form">
        <h3>Melde dich mit deinem fh-account an</h3>
        <?php //echo $error; ?>
        <form method="post" action='<?php $_SERVER['PHP_SELF']; ?>' enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <input placeholder="Username" name="username" type="text" value='<?php echo $username ?>'>
                </div>
                <div class="form-group">
                    <input placeholder="Password" name="password" type="password" value='<?php echo $password ?>'>
                </div>
                    <input type="submit" value="Login"/>
            </fieldset>
        </form>
    </div>


</nav>