
<?php
session_start();
if($_POST['edit'])
{
    if($_POST['edit']=="Grayscale")
    {
        $imagefile=$_SESSION['imagefile'];
        $image = imagecreatefromjpeg("files/$imagefile");
        imagefilter($image, IMG_FILTER_GRAYSCALE);
        imagejpeg($image, "files/edited/img_filter_grayscale.jpg");
        //$_SESSION['changemade']=1;
        echo "<img src =\"files/edited/img_filter_grayscale.jpg\">";
        
        $_SESSION['change']=1;
        header("Location: bildbearbeitung.php");
        //header("Refresh:5");
    }
    else if($_POST['edit']=="cancel")
    {
        unset($_SESSION['change']);
        header("Location: index.php?section=Gallery");
    }
}


?>