
<?php
session_start();
if($_POST['edit'])
{
    if($_POST['edit']=="Grayscale")
    {
        
        if(isset($_SESSION['change']))
        {
            
            $imagefile=$_SESSION['latestedit'];
            $image = imagecreatefromjpeg($imagefile);
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            imagejpeg($image, $imagefile);
            $_SESSION['latestedit']=$imagefile;
            $_SESSION['change']="grey";
            header("Location: bildbearbeitung.php");
        }
        else
        {
            $imagefile=$_SESSION['imagefile'];
            $image = imagecreatefromjpeg("files/$imagefile");
            imagefilter($image, IMG_FILTER_GRAYSCALE);
            imagejpeg($image, "files/edited/$imagefile");
            $_SESSION['latestedit']="files/edited/".$imagefile;
            $_SESSION['change']="grey";
            header("Location: bildbearbeitung.php");
        }


    }
    else if($_POST['edit']=="Cancel")
    {
        unset($_SESSION['change']);
        header("Location: index.php?section=Gallery");
    }

    else if($_POST['edit']=="90 Grad rechts")
    {
        if(isset($_SESSION['change']))
        {
            $imagefile=$_SESSION['latestedit'];
            $degrees = 270;
            $image = imagecreatefromjpeg($imagefile);
            $rotate=imagerotate($image, $degrees, 0);
            imagejpeg($rotate, $imagefile);
            $_SESSION['latestedit']=$imagefile;
            $_SESSION['change']="rechts";
            header("Location: bildbearbeitung.php");
        }
        else
        {
            $imagefile=$_SESSION['imagefile'];
            $degrees = 270;
            $image = imagecreatefromjpeg("files/$imagefile");
            $rotate=imagerotate($image, $degrees, 0);
            imagejpeg($rotate, "files/edited/".$imagefile);
            $_SESSION['latestedit']="files/edited/".$imagefile;
            $_SESSION['change']="rechts";
            header("Location: bildbearbeitung.php");
        }

 
    }
    else if($_POST['edit']=="90 Grad links")
    {
        if(isset($_SESSION['change']))
        {
            $imagefile=$_SESSION['latestedit'];
            $degrees = 90;
            $image = imagecreatefromjpeg($imagefile);
            $rotate=imagerotate($image, $degrees, 0);
            imagejpeg($rotate, $imagefile);
            $_SESSION['latestedit']=$imagefile;
            $_SESSION['change']="links";
            header("Location: bildbearbeitung.php");
        }
        else
        {
            $imagefile=$_SESSION['imagefile'];
            $degrees = 90;
            $image = imagecreatefromjpeg("files/$imagefile");
            $rotate=imagerotate($image, $degrees, 0);
            imagejpeg($rotate, "files/edited/".$imagefile);
            $_SESSION['latestedit']="files/edited/".$imagefile;
            $_SESSION['change']="links";
            header("Location: bildbearbeitung.php");
        }

    }
    else if($_POST['edit']=="Spiegeln")
    {
       if(isset($_SESSION['change']))
       {
        $imagefile=$_SESSION['latestedit'];
        $image = imagecreatefromjpeg($imagefile);
        $image = imageflip($image, IMG_FLIP_HORIZONTAL);
        imagejpeg($image, $imagefile);
        $_SESSION['latestedit']=$imagefile;
        $_SESSION['change']="spiegeln";
        header("Location: bildbearbeitung.php");
       }
       else
       {
        $imagefile=$_SESSION['imagefile'];
        $image = imagecreatefromjpeg("files/$imagefile");
        imageflip($image, IMG_FLIP_HORIZONTAL);
        imagejpeg($image, "files/edited/".$imagefile);
        $_SESSION['latestedit']="files/edited/".$imagefile;
        $_SESSION['change']="spiegeln";
        header("Location: bildbearbeitung.php");
       }

    }
    else if($_POST['edit']=="undo")
    {
        if($_SESSION['change']=="grey")
        {
            $imagefile=$_SESSION['imagefile'];
            $_SESSION['latestedit']=$imagefile;
            $_SESSION['change']="grey";
            header("Location: bildbearbeitung.php");
        }
        else if($_SESSION['change']=="links")
        {
            $imagefile=$_SESSION['latestedit'];
            $degrees = 270;
            $image = imagecreatefromjpeg($imagefile);
            $rotate=imagerotate($image, $degrees, 0);
            imagejpeg($rotate, $imagefile);
            $_SESSION['latestedit']=$imagefile;
            $_SESSION['change']="rechts";
            header("Location: bildbearbeitung.php");
        }
        else if($_SESSION['change']=="rechts")
        {
            $imagefile=$_SESSION['latestedit'];
            $degrees = 90;
            $image = imagecreatefromjpeg($imagefile);
            $rotate=imagerotate($image, $degrees, 0);
            imagejpeg($rotate, $imagefile);
            $_SESSION['latestedit']=$imagefile;
            $_SESSION['change']="links";
            header("Location: bildbearbeitung.php");
        }
        else if($_SESSION['change']=="spiegeln")
        {
            $imagefile=$_SESSION['latestedit'];
            $image = imagecreatefromjpeg($imagefile);
            $image = imageflip($image, IMG_FLIP_HORIZONTAL);
            imagejpeg($image, $imagefile);
            $_SESSION['latestedit']=$imagefile;
            $_SESSION['change']="spiegeln";
            header("Location: bildbearbeitung.php");
        }
    }
}


?>