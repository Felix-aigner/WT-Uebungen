
<?php
session_start();
if($_POST['edit'])
{
    if($_POST['edit']=="Grayscale")
    {
        $imagefile=$_SESSION['imagefile'];
        $image = imagecreatefromjpeg("files/$imagefile");
        imagefilter($image, IMG_FILTER_GRAYSCALE);
        imagejpeg($image, "files/edited/gray_$imagefile");
        $_SESSION['latestedit']="files/edited/gray_".$imagefile;
        $_SESSION['change']=1;
        header("Location: bildbearbeitung.php");

    }
    else if($_POST['edit']=="Cancel")
    {
        unset($_SESSION['change']);
        header("Location: index.php?section=Gallery");
    }

    else if($_POST['edit']=="90 Grad rechts")
    {
        $imagefile=$_SESSION['imagefile'];
        $degrees = 270;
        $image = imagecreatefromjpeg("files/$imagefile");
        $rotate=imagerotate($image, $degrees, 0);
        imagejpeg($rotate, "files/edited/rechts_$imagefile");
        $_SESSION['latestedit']="files/edited/rechts_".$imagefile;
        $_SESSION['change']=1;
        header("Location: bildbearbeitung.php");
    }
    else if($_POST['edit']=="90 Grad links")
    {
        $imagefile=$_SESSION['imagefile'];
        $degrees = 90;
        $image = imagecreatefromjpeg("files/$imagefile");
        $rotate=imagerotate($image, $degrees, 0);
        imagejpeg($rotate, "files/edited/links_$imagefile");
        $_SESSION['latestedit']="files/edited/links_".$imagefile;
        $_SESSION['change']=1;
        header("Location: bildbearbeitung.php");

    }
    else if($_POST['edit']=="Spiegeln")
    {
        $imagefile=$_SESSION['imagefile'];
        $image = imagecreatefromjpeg("files/$imagefile");
        imageflip($image, IMG_FLIP_HORIZONTAL);
        imagejpeg($image, "files/edited/spiegeln_$imagefile");
        
        $_SESSION['change']=1;
        header("Location: bildbearbeitung.php");

    }
}


?>