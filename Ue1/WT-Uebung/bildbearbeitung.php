
<?php   //Bilder laden
session_start();
if(!isset($_SESSION['change']))
{
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
    
    echo "<img src ='files/$imagefile'>";


    echo 'name: '. $imagefile;
}
else
{    
    echo "<img src ='files/edited/img_filter_grayscale.jpg'>";
}
?>
<form action="edit.php" enctype="multipart/form-data" method="post">
    <input type="submit" name="edit" id="Grayscale" value="Grayscale"><br/>
    <input type="submit" name="edit" id="cancel" value="cancel"><br/>
</form>

<?php








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