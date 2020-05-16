<?php  

if(!isset($_SESSION)){session_start();}
require("fonction.php");
		
		/* 
		* mysqli_real_escape_string permet de protéger les caractères spéciaux d'une chaîne pour l'utiliser dans une requête SQL, 
		* en prenant en compte le jeu de caractères courant de la connexion
		*/

		if(isset($_REQUEST['pseudo']) && isset($_REQUEST['password'])){
			$valid=FALSE;
			$connexion=connexion_bd();
			$pseudo=mysqli_real_escape_string($connexion, $_REQUEST['pseudo']);
			$password=mysqli_real_escape_string($connexion, $_REQUEST['password']);
		
			$req = mysqli_query($connexion, "SELECT * FROM membres WHERE pseudo ='$pseudo'");
			while($donnee = mysqli_fetch_assoc($req)){
				if(password_verify($password, $donnee['password'])){
					$valid=TRUE;
					break;
				}
			}

			//-----------------------
			//Demarrage de la session
			//-----------------------
			if($valid){
				
				$_SESSION['id'] = $donnee['id'];
				$_SESSION['pseudo'] = $donnee['pseudo'];
				$_SESSION['nom'] = $donnee['nom'];
				$_SESSION['prenom'] = $donnee['prenom'];
				$_SESSION['mail'] = $donnee['mail'];

				header('Location: forum.php'); //Direction le forum lorsqu'on se connecte
				$bdd=null;
				exit;
			}else{
				echo 'Votre pseudo et mot de passe ne correspondent pas.';//En cas d'echec.
				$bdd=null; 
			}
		}
?>

<!DOCTYPE html>
	<html lang="fr">
	  <head>
	  	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
		<link href="style2.css" type="text/css" rel="stylesheet">
		<meta charset="utf-8">
		<title>La Fosse Aux Jeux | Connexion</title>
	  </head>

	  <body>
	  	<div class="nav">
	      <div class="container">
	      	<nav>
		        <ul>
		          <li><a href="index.php" >Accueil</a></li>        	
		          <li><a href="propos.html">A propos</a></li>
		          <li><a href="contact.php">Contact</a></li>
		        </ul>
	    	</nav>
	      </div>
	    </div>

	    <!-- Formulaire de connexion -->
	  	<div class="form">
	  		<form action = "connexion.php" method="post">
	  			<fieldset>
	  				<legend>Connexion</legend>
	  				
	  					<label for="pseudo">Pseudo:</label>  
							<input type="text" name="pseudo" id="pseudo" size="30" value="" required><br>
						 <label for="password">Mot de passe:</label>
						  	<input type="password" name="password" id="password" size="30" value="" required><br>

						 <input type="submit" value="Envoyer" name="send">
						 <input type="reset" value="Effacer" name="clear">

	  			</fieldset>
	  		</form>
	  	</div>


	  </body>

	</html>  