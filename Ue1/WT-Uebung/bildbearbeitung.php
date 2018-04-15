
<?php   //Bilder laden


$imagefile = $_GET['edit_id'];
$_SESSION['imagefile']=$imagefile;
$imagesize = getimagesize("files/$imagefile");
$imagewidth = $imagesize[0];
$imageheight = $imagesize[1];
$imagetype = $imagesize[2];
switch ($imagetype)
{
    // Bedeutung von $imagetype:
    // 1 = GIF, 2 = JPG, 3 = PNG
    case 1: // GIF
        $image = imagecreatefromgif("files/$imagefile");
        break;
    case 2: // JPEG
        $image = imagecreatefromjpeg("files/$imagefile");
        break;
    case 3: // PNG
        $image = imagecreatefrompng("files/$imagefile");
        break;
    default:
        die('Unsupported imageformat');
}

echo 'Grafik-Typ: ' . $imagesize[2] . '<br>';
if(isset($_SESSION['change']))
{
    echo "<img src ='files/edited/img_filter_grayscale.jpg'>";
}
else
{
    echo "<img src ='files/$imagefile'>";
}

echo 'name: '. $imagefile;

?>
<form method="post">
    <input type="submit" name="test" id="test" value="Grayscale" onclick= <?php echo grayscale() ?>/><br/>
</form>

<?php
function grayscale()
{
    $imagefile=$_SESSION['imagefile'];
    $image = imagecreatefromjpeg("files/$imagefile");
    imagefilter($image, IMG_FILTER_GRAYSCALE);
    imagejpeg($image, "files/edited/img_filter_grayscale.jpg");
    //$_SESSION['changemade']=1;
    echo "<img src =\"files/edited/img_filter_grayscale.jpg\">";
    //header("Location: bildbearbeitung.php");
    $_SESSION['change']="greyscale";
    //header("Refresh:5");
}






/*// Maximalausmaße
$maxthumbwidth = 150;
$maxthumbheight = 100;
// Ausmaße kopieren, wir gehen zuerst davon aus, dass das Bild schon Thumbnailgröße hat
$thumbwidth = $imagewidth;
$thumbheight = $imageheight;
// Breite skalieren falls nötig
if ($thumbwidth > $maxthumbwidth)
{
    $factor = $maxthumbwidth / $thumbwidth;
    $thumbwidth *= $factor;
    $thumbheight *= $factor;
}
// Höhe skalieren, falls nötig
if ($thumbheight > $maxthumbheight)
{
    $factor = $maxthumbheight / $thumbheight;
    $thumbwidth *= $factor;
    $thumbheight *= $factor;
}
// Thumbnail erstellen
$thumb = imagecreatetruecolor($thumbwidth, $thumbheight);

imagecopyresampled(
    $thumb,
    $image,
    0, 0, 0, 0, // Startposition des Ausschnittes
    $thumbwidth, $thumbheight,
    $imagewidth, $imageheight
);*/






/*header('Content-Type: image/png'); //BIld speichern
imagepng($thumb);
// In Datei speichern
// $thumbfile = 'thumbs/' . $imagefile;
// imagepng($thumb, $thumbfile);
imagedestroy($thumb);
?>*/

 ?>