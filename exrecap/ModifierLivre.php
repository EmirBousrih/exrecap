<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Modifier Livre</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="styles/styleform.css">
</head>
<body>

	<?php 
		$isbn=$_POST["isbnmodif"];

		if($fich=@fopen('bibliotheque.csv', 'a+'))
	{

		do{
			$tab=fgetcsv($fich,1024,';');

		}
		while ($tab[1]!=$isbn && !feof($fich));

		if(!feof($fich)){





		rewind($fich);
		$final=array();
		$k=0;

		while(!feof($fich))
		{
			$tab=fgetcsv($fich,1024,';');
			$k++;

			if($tab[1]==$isbn ){ 
				$x=$k-1;
			}
			array_push($final, $tab);
			

			

				
			

		};

		fclose($fich);
		array_pop($final);

		$t=$final[$x];
		$auteur=array('Selectionner Auteur','George R. R. Martin','E. L. James','John Green','Nora Roberts','J. K. Rowling','Stephen King','Paulo Coelho','Elif Shafak','Bob Dylan','Jane Austen');
		$editeur=array('Selectionner Editeur','Penguin Random House','HarperCollins','Simon & Schuster','Hachette Book Group','Macmillan','Scolaire','Disney Publishing Worldwide');
		$theme=array('Selectionner Theme','Romance','Policier','Biographie','Horreur','Guerre','Science Fiction','Histoire');
		

		

		echo "<h1> Ajout de Livre </h1>
		
	

	<form action='Handlemodif.php' method='post' enctype='multipart/form-data'>
	
	<table>
		<tr>
			<td>
				<p>ISBN :</p>
			</td>
			<td><input class='form-control mr-sm-2' type='text' name='isbn' required value='$t[1]'></td>
		</tr>
		<tr>
			<td>
				<p>Titre :</p>
			</td>
			<td><input class='form-control mr-sm-2' type='text' name='titre' required value='$t[2]'></td>
		</tr>
		<tr>
			<td>
				<p>Theme :</p>
			</td>
			<td>
				 <select class='form-control mr-sm-2' id='theme' name='theme'>
				 ";

				 for ($i=0; $i <sizeof($theme) ; $i++) { 
				 	if($theme[$i]==$t[3]){
				 		echo "<option value='$theme[$i]' selected >$theme[$i]</option>";
				 	}
				 	else 
				 		echo "<option value='$theme[$i]' >$theme[$i]</option>";
				 	
				 }

			echo "</select>
			</td>
		</tr>
		<tr>
			<td>
				<p>Auteur :</p>
			</td>
			<td><select class='form-control mr-sm-2' id='auteur' name='auteur'>";

			 for ($i=0; $i <sizeof($auteur) ; $i++) { 
				 	if($auteur[$i]==$t[4]){
				 		echo "<option value='$auteur[$i]' selected >$auteur[$i]</option>";
				 	}
				 	else 
				 		echo "<option value='$auteur[$i]' >$auteur[$i]</option>";
				 	
				 }



			echo "
				 </select>
			</td>
		</tr>
		<tr>
			<td>
				<p>Editeur :</p>
			</td>
			<td>
						 <select class='form-control mr-sm-2' id='theme' name='editeur'>";

			for ($i=0; $i <sizeof($editeur) ; $i++) { 
				 	if($editeur[$i]==$t[5]){
				 		echo "<option value='$editeur[$i]' selected >$editeur[$i]</option>";
				 	}
				 	else 
				 		echo "<option value='$editeur[$i]' >$editeur[$i]</option>";
				 	
				 }




		echo "		 </select>
			</td>
		</tr>
		<tr>
			<td>
				<p>Description:</p>
			</td>
			<td><textarea class='form-control  mr-sm-2 ' name='desc' rows='10' cols='35'>$t[6]</textarea></td>
		</tr>
		<tr>
			<td>
				<p>Page de Garde : &nbsp&nbsp&nbsp </p>
			</td>
			
			<td>
				<input class='form-control-file ' type='file' name='fileToUpload' id='fileToUpload' >
				
			
			
			<p style='color:blue; ' >Si vous ne selectionnez aucune image, l'ancienne image reste.</p>
			</td>
		</tr>
		
		<tr>
			<td>
				<p>Mots clefs :</p>
			</td>
			<td><input class='form-control mr-sm-2' type='text' name='mclefs'value='$t[7]' required></td>
		</tr>
		<tr>
			<td>
				<p>Date :</p>
			</td>
			<td><input class='form-control mr-sm-2' type='date' name='date' required value='$t[8]'></td>
		</tr>
		<tr>
			<td>
				<p>Format :</p>
			</td>
			<td>  
				  <label for='papier'> Papier</label>";

				  if($t[9]=='Papier')
				  	echo "<input type='checkbox' id='papier' name='format' value='Papier' checked>";
				  else 
				  	echo "<input type='checkbox' id='papier' name='format' value='Papier'>";


		          echo"<label for='electronique'> Electronique</label>";

		          if($t[9]=='Electronique')
				  	echo "<input type='checkbox' id='electronique' name='format' value='Electronique' checked>";
				  else 
				  	echo "<input type='checkbox' id='electronique' name='format' value='Electronique'>";


				  
	echo"	</td>
		</tr>
		<tr>
			<td></td><td><input class='btn btn-outline-primary my-2 my-sm-0' type='submit' value='Modifier' name='go' >
			<a role='button'class='btn btn-outline-primary my-2 my-sm-0' href='administration.html'>Annuler</a></td>

			<input type='text' style='display:none' name='imagedir' value='$t[0]'/>
			<input type='text' style='display:none' name='oldisbn' value='$t[1]'/>

		</tr>
	</table>
		
	</form>";











		}
		else {echo "<h1 style='font-size: 400%;padding: 50px;text-align: center; text-decoration:none'>Oops! Ce livre n'existe pas dans la bibliotheque.</h1> ";
				echo "<br><br><br> <div class='text-center'><a role='button' class='btn btn-outline-primary my-2 my-sm-0' style='text-align:center;' href='administration.html'>Retourner à l'Acceuil</a></div><br><br><br>";}

		}

		else 
			echo "Erreur Lors de l'ouverture du fichier csv!";

		

 ?>
	
</body>
</html>