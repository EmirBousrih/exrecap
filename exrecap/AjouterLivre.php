<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajout</title>
    <link rel="stylesheet" href="styles/styleAffichage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    

<?php 
$isbn=$_POST["isbn"];
$isbns=array();
$fich=@fopen('bibliotheque.csv','a+');

while(!feof($fich)){
    $t=fgetcsv($fich,1024,';');
    $isbns[]=$t[1];
}
array_pop($isbns);


if (in_array($isbn, $isbns)){
    
    echo "<h1 style='font-size: 400%;padding: 50px;text-align: center; text-decoration:none ;color:blue'>Cet ISBN existe déja. <br>Chaque ISBN doit être unique.</h1> ";
    echo "<br> <div class='text-center'><a role='button' class='btn btn-outline-primary my-2 my-sm-0' style='text-align:center;' href='AjoutLivre.html'>Ressayer</a>&nbsp&nbsp&nbsp<a role='button' class='btn btn-outline-primary my-2 my-sm-0' style='text-align:center;' href='administration.html'>Retourner à l'Acceuil</a></div><br><br><br>";
}
else 
{




$isbn=$_POST["isbn"];
$titre=$_POST["titre"];
$theme=$_POST["theme"];
$auteur=$_POST["auteur"];
$editeur=$_POST["editeur"];
$desc=$_POST["desc"];
$mclefs=$_POST["mclefs"];
$date=$_POST["date"];
$format=$_POST["format"];




$target_dir = "uploads/";
$base=basename($_FILES["fileToUpload"]["name"]);
$base=preg_replace('/\s+/', '_', $base);
$target_file = $target_dir . $base;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        

		if($f=@fopen('bibliotheque.csv','a+'))
		{
			fputcsv($f, array($target_file, $isbn, $titre, $theme, $auteur, $editeur, $desc, $mclefs, $date, $format),';');

			
			fclose($f);
			echo "<h1 style='font-size: 400%;padding: 50px;text-align: center;'>Le livre <b>$titre</b> a été ajouté avec succès avec succès !</h1>" ;
            echo "<br><br><br> <div class='text-center'><a role='button' class='btn btn-outline-primary my-2 my-sm-0' style='text-align:center;' href='administration.html'>Retourner à l'Acceuil</a></div><br><br><br>";

		}
		else {echo "Impossible d'acceder au fichier ";}






    } else {
        echo "Sorry, there was an error uploading your file.";

    }
}



}





 ?>
 </body>
</html>