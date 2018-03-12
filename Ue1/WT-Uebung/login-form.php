<nav>
    <div class="menu">
        <ul>
            <li><a href="index.php?section=Home">Home</a><br/></li>
            <li><a href="index.php?section=Produkte">Produkte</a></li>
        </ul>
    </div>
    <div class="login-form">
        <h3>Please sign in</h3>
        <?php echo $error; ?>
        <form method="post" action="index.php">
            <fieldset>
                <div class="form-group">
                    <input placeholder="Username" name="username" type="text">
                </div>
                <div class="form-group">
                    <input placeholder="Password" name="password" type="password" value="">
                </div>
                    <input type="submit" value="Login"/>
            </fieldset>
        </form>
    </div>


</nav>