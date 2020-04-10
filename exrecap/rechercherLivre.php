<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bibliotheque</title>
	<link rel="stylesheet" href="styles/styleAffichage.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<style>
		tr,td,table{
			border:0px;
		}
	</style>

</head>
<body>
	

<?php 
		$isbn=$_POST["isbnrech"];

		if($fich=@fopen('bibliotheque.csv', 'a+'))
	{

		do{
			$tab=fgetcsv($fich,1024,';');

		}
		while ($tab[1]!=$isbn && !feof($fich));

		if(!feof($fich)){

			echo "<h1 id='header'>$tab[2]</h1>";
			echo "<table>";
			echo"<tr>";
			echo"<td>";
			echo"<img src=$tab[0] alt='img'></td>";
			echo"<td >";
			echo"<p><b>ISBN : </b> $tab[1]</p>";
			echo"<p><b>Titre : </b>$tab[2]</p>";
			echo"<p><b>Theme : </b>$tab[3]</p>";
			echo"<p><b>Auteur : </b>$tab[4]</p>";
			echo"<p><b>Editeur : </b>$tab[5]</p>";
			echo"<p id='box'><b>Description : </b>$tab[6]</p>";
			echo"<p><b>Mots Clefs : </b>$tab[7]</p>";
			echo"<p><b>Date : </b>$tab[8]</p>";
			echo"<p><b>Format : </b>$tab[9]</p>";
			echo"</td>";
			echo "</tr>";
			echo "</table>";

		}
		else echo "<h1 id='header' style='color:red'>Oops! Ce livre n'existe pas dans la bibliotheque.</h1>";
			echo "<br><br><br> <div class='text-center'><a role='button' class='btn btn-outline-primary my-2 my-sm-0' style='text-align:center;' href='administration.html'>Retourner à l'Acceuil</a></div><br><br><br>";

		}

		fclose($fich);

 ?>

 </body>
</html>