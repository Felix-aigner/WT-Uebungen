
<html>
<body>
<h3>Formular zum Upload</h3>

<?php
$subdir = "./files/"; 		// Stelle, wo die Datei hinkopiert werden soll 
							// (hier das Unterverzeichnis "files" zum aktuellen Verzeichnis, wo diese php-Datei liegt
							// WICHTIG: das Unterverzeichnis muss beim Ausf�hren des Scripts bereits existieren
							// WICHTIG: das Verzeichnis muss die vollen Lese- und Schreibrechte haben
							// -> in Winscp Verzeichnis selektieren, rechte Maustaste -> Eigenschaften, bei octal 0777 eintragen !!!!!!!


							
if (isset($_FILES['userfile'])) {							// wurde Datei per POST-Methode upgeloaded
	$fileupload=$_FILES['userfile'];						// diverse Statusmeldungen ausschreiben
	/*echo "name: ".$fileupload['name']." <br>";				// Originalname der hochgeladenen Datei
	echo "type: ".$fileupload['type']." <br>";				// Mimetype der hochgeladenen Datei
	echo "size: ".$fileupload['size']." <br>";				// Gr��e der hochgeladenen Datei
	echo "error: ".$fileupload['error']." <br>";			// eventuelle Fehlermeldung
	echo "tmp_name: ".$fileupload['tmp_name']." <br>";		// Name, wie die hochgeladene Datei im tempor�ren Verzeichnis hei�t
	echo "ziel: ".$subdir.$fileupload['name']." <br>";		// Pfad und Dateiname, wo die hochgeladene Datei hinkopiert werden soll
	echo "<br>";
	*/
	
	if($fileupload['type']=="image/jpeg" || $fileupload['type']=="image/jpg" || $fileupload['type']=="image/gif" || $fileupload['type']=="image/png")
	{
	// Pr�fungen, ob Dateiupload funktioniert hat
	if ( !$fileupload['error'] 								// kein Fehler passiert
		&& $fileupload['size']>0						// Gr��e > 0	
    	&& $fileupload['tmp_name']							// hochgeladene Datei hat einen tempor�ren Namen
		&& is_uploaded_file($fileupload['tmp_name']))
		{
			move_uploaded_file($fileupload['tmp_name'],$subdir.$fileupload['name']);  // erst dann ins neue Verzeichnis verschieben
		}		// nur dann true, wenn Datei gerade erst hochgeladen wurde
		 else echo 'Fehler beim Upload';
	}
}

?>

	<form class="form" method="post" action="index.php?section=Gallery" enctype="multipart/form-data">
      <input type="hidden" name="MAX_FILE_SIZE" value="1024000">
	  <p>Filename:</p> 
	  <input name="userfile" type="file" class="inputfile">
      <input type="submit" value="Upload">
	</form>
<?php

if(isset($_GET['delete']) && $_GET['delete']){
	unlink($_GET['delete']);
}
?>

</body>
</html>