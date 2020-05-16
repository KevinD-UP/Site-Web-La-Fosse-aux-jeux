<?php 

	if(!isset($_SESSION)){session_start();}

	require("fonction.php");

	$connexion=connexion_bdPDO();
	if(isset($_SESSION['pseudo'])){
		$isAdmin = isAdmin($connexion,$_SESSION['pseudo']);
		$isModo = isModo($connexion,$_SESSION['pseudo']);
	}
	$connexion=null;

	//----------------------------------------
	//Traitement de la requête de bannissement
	//----------------------------------------
	if(isset($_REQUEST['Ban'])){
		$connexion=connexion_bd();
		$pseudo=mysqli_real_escape_string($connexion, $_REQUEST['Ban']);
		$Delete = "DELETE FROM membres WHERE pseudo='$pseudo'";
		mysqli_query($connexion, $Delete);
		mysqli_close($connexion);
		$confirmation="Un membre a été banni.";
	}

	//-------------------------------------
	//Traitement de la requête de promotion
	//-------------------------------------
	if(isset($_REQUEST['modo'])){
		$connexion=connexion_bd();
		$pseudo=mysqli_real_escape_string($connexion, $_REQUEST['modo']);
		$promotion = "INSERT INTO moderateurs (nom,prenom,pseudo) SELECT nom,prenom,pseudo FROM membres WHERE pseudo='$pseudo'"; 
		mysqli_query($connexion,$promotion);
		mysqli_close($connexion);
		$confirmation2="Un membre a été promu modérateurs.";
	}

	//--------------------------------------
	//Traitement de la requête de suppresion
	//--------------------------------------
	if(isset($_REQUEST['titre'])){
		$connexion=connexion_bd();
		$id=mysqli_real_escape_string($connexion, $_REQUEST['titre']);
		$Delete = "DELETE FROM articles WHERE idArticle=".intval($id);
		mysqli_query($connexion, $Delete);
		mysqli_close($connexion);
		$confirmation3="Un article a été supprimé.";
	}

	?>

	<!DOCTYPE html>
	<html lang="fr">
		<head>
			<meta charset="utf-8">
			<title>Gestion</title>
			<link rel="stylesheet" href="style2.css">
			<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
		</head>

		<body class="gestion">
				<div class="nav">
			      <div class="container">
			      	<nav>
				        <ul>
				          <li><a href="index.php">Accueil</a></li>
				          <li><a href="deconnexion.php">Deconnexion</a></li>      
				        </ul>
			   		</nav>
			      </div>
			  	</div>

			  	<?php 
						$bdd = connexion_bdPDO();
						$reponse = $bdd->query('SELECT * FROM membres');
				?>

				<table>
					<caption>Liste des membres</caption>	

				<!-- Affichage sous forme de tableau de la liste des membres -->
				<?php	
					while ($donnees = $reponse->fetch()){
						?>		
								<tr>
								<td>
								<?php	
									echo "ID:".$donnees['id'];
									echo "<br>";
									echo "Pseudo:".$donnees['pseudo'];
									echo "<br>";
									echo "mail:".$donnees['mail'];
								?>
								</td>
								</tr>					
							

						<?php
						}
						?> 
			
					</table>

				<?php		
					$bdd=null;
				 ?>
		
				 
				<!--Affichage du formulaire de ban.-->  
				<div id='Ban'>
				  	<form action='gestion.php' method='post'>	
						<fieldset>
							<legend>Ban</legend><br>
								<label for='pseudo'>Pseudo:</label>
								<input type='text' name='Ban' id='Ban' size='30'><br>
						</fieldset>
						<input type='submit' value='Envoyer' name='send'>
					</form>	
				</div>
			
				
				<?php 
				//Affichage du formulaire de promotion si l'utilisateur et un administrateur.
				if(isset($isAdmin) && $isAdmin==TRUE){echo "
				<div id='modo'>	
				  	<form action='gestion.php' method='post'>
						<fieldset>
							<legend>Promotion modo</legend><br>
								<label for='pseudo'>Pseudo:</label>
								<input type='text' name='modo' size='30' id='modo' ><br>
						</fieldset>
						<input type='submit' value='Envoyer' name='send'>
					</form>
				</div>
				";	
			}
			?>
				
				<div id='modo'>	
				  	<form action='gestion.php' method='post'>
						<fieldset>
							<legend>Supprimer un article</legend><br>
								<label for='titre'>Id:</label>
								<input type='text' name='titre' size='30' id='titre' ><br>
						</fieldset>
						<input type='submit' value='Envoyer' name='send'>
					</form>
				</div>

				<?php
				//Possibilité d'export uniquement pour les administrateurs.
				if(isset($isAdmin)&&$isAdmin==TRUE){
				echo"<div class='export'>";	
				echo"<ul>"; 
				echo"<li><a href='export.php?table=Membres'>Exporter la liste de membres en CSV</a></li>";
				echo"<li><a href='export.php?table=Articles'>Exporter la liste des articles en CSV</a></li>";
				echo"</ul>";
				echo"</div>";	
			}


				//Affichage message de confirmation si une promotion ou un ban a été réalisé.
				if(isset($confirmation)){
			  		echo "<h1 class='confirmation'><center>".$confirmation."</center></h1>";
			  	}
			  	if(isset($confirmation2)){
			  		echo "<h1 class='confirmation'><center>".$confirmation2."</center></h1>";
			  	}
			  	if(isset($confirmation3)){
			  		echo "<h1 class='confirmation'><center>".$confirmation3."</center></h1>";
			  	}
?>

	</body>
</html>