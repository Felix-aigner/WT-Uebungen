<?php
echo "ist da!";
if(!isset($_SESSION["simple-login"]))
{
?>
    <ul>
        <li>
            <a href="index.php">HOME</a><br/>
        </li>
    </ul>


<?php
}
else
{
?>

    <ul>
        <li>
            <a href="home.php">HOME</a><br/>
            <a href="warenkorb.php">Warenkorb</a>
            <a href="#">Account</a>
        </li>
    </ul>


<?php
}
?>
