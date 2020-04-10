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
		$isbn=$_POST["isbnsupp"];

		if($fich=@fopen('bibliotheque.csv', 'a+'))
	{

		do{
			$tab=fgetcsv($fich,1024,';');

		}
		while ($tab[1]!=$isbn && !feof($fich));

		if(!feof($fich)){ //Si le fichier existe





		rewind($fich);
		$final=array();

		while(!feof($fich))
		{
			$tab=fgetcsv($fich,1024,';');
			
			
			if($tab[1]!=$isbn ){
				array_push($final, $tab);
			}

				
			

		};

		fclose($fich);
		array_pop($final);

		if($fich=@fopen('bibliotheque.csv', 'w+')){

			for ($i=0; $i < sizeof($final); $i++) { 

				fputcsv($fich, $final[$i],';');

			}

			echo "<h1 style='font-size: 400%;padding: 50px;text-align: center;'>Le livre d'ISBN <b>$isbn</b> a été supprimé !</h1>" ;
			echo "<br><br><br> <div class='text-center'><a role='button' class='btn btn-outline-primary my-2 my-sm-0' style='text-align:center;' href='administration.html'>Retourner à l'Acceuil</a></div><br><br><br>";
			fclose($fich);





		}
		else
			echo "Erreur Ouverture fichier csv!";

		



		









		}
		//si le fichier n'existe pas
		else {echo "<h1 id='header' style='color:red'>Oops! Ce livre n'existe pas dans la bibliotheque.</h1>";

			echo "<br><br><br> <div class='text-center'><a role='button' class='btn btn-outline-primary my-2 my-sm-0' style='text-align:center;' href='administration.html'>Retourner à l'Acceuil</a></div><br><br><br>";}

		}

		else 
			echo "Erreur Lors de l'ouverture du fichier csv!";

		

 ?>

 </body>
</html>