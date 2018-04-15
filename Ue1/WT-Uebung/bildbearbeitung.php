
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
    
    echo "<img src ='files/$imagefile'>";


}
else
{    

    $foto = $_SESSION['latestedit'];

    echo "<img src ='$foto'>";
}
?>
<form action="edit.php" enctype="multipart/form-data" method="post">
    <input type="submit" name="edit" id="Grayscale" value="Grayscale"><br/>
    <input type="submit" name="edit" id="90 Grad rechts" value="90 Grad rechts"><br/>
    <input type="submit" name="edit" id="90 Grad rechts" value="90 Grad links"><br/>
    <input type="submit" name="edit" id="Spiegeln" value="Spiegeln"><br/>
    <input type="submit" name="edit" id="undo" value="undo"><br/>
    <input type="submit" name="edit" id="Cancel" value="Cancel"><br/>
</form>
