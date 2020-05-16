<?php if(!isset($_SESSION)){session_start();}
require("fonction.php");

$connexion=connexion_bdPDO();
if(isset($_SESSION['pseudo'])){
	$isAdmin = isAdmin($connexion,$_SESSION['pseudo']);
	$isModo = isModo($connexion, $_SESSION['pseudo']);
}
$connexion=null;
?>

<!DOCTYPE html>
	<html lang="fr">
	  <head>
		<link href="style.css" type="text/css" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
		<meta charset="utf-8">
		<title>La Fosse Aux Jeux | NouveauSujet</title>
	  </head>

	  <body>
	  	<div class="nav">
			   	<div class="container">
				   	<nav>
				        <ul>
				          <li><a href="index.php" >Accueil</a></li>        	
				          <li><a href="forum.php" >Forum</a></li>
				          <?php if((isset($isAdmin)&&$isAdmin==TRUE)||(isset($isModo))&&$isModo==TRUE){echo '<li><a href="gestion.php" >Gestion</a></li>';}?>  
				          <?php if(isset($_SESSION['pseudo'])){echo '<li><a href="deconnexion.php">Deconnexion</a></li>';}?>
				        </ul>
				    </nav>
			    </div>
			</div>

		<!-- Formulaire de dépôt d'un nouvel article -->	
		<div class="corps">	
		  	<div class="form">
			  <form action = "forum.php" method="post" enctype="multipart/form-data">
			  	<fieldset>
			  		
			  		<legend>Nouveau Sujet</legend>

					  	<label for="titre">Titre:</label><br>
					  	<input type="text" name="titre" id="titre" size="100"  value=""><br>

					  	<label for="image">Illustration:</label><br>
	     				<input type="file" name="image" id="image" accept=".png, .jpg, .jpeg"><br>

					  	<label for="paragraphe">Paragraphe:</label><br>
					  	<textarea name="paragraphe" id="paragraphe" rows="35" cols="100"></textarea><br>

						<input type="submit" value="Envoyer" name="send">
						
			  	</fieldset>
		  	   </form>
		  	</div>
		  </div>
	  </body>

	</html>  