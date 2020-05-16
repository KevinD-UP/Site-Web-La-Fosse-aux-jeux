<?php
if(!isset($_SESSION)){session_start();}

require("fonction.php");
?>

<!DOCTYPE html>
	<html lang="fr">
		<head>
			<meta charset="utf-8">
			<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
			<title>Mon compte</title>
			<link rel="stylesheet" type="text/css" href="style2.css">
		</head>
		<body>

			<?php 
			/* mysqli_real_escape_string(): Protège les caractères spéciaux d'une chaîne pour l'utiliser dans une requête SQL, 
			* en prenant en compte le jeu de caractères courant de la connexion
			*/

			//=====================
			//Suppression du compte
			//=====================

			if(isset($_POST['supprimer'])){
				$connexion=connexion_bd();
				$id=mysqli_real_escape_string($connexion, $_SESSION['id']);
				$supprimer="DELETE FROM membres WHERE id='$id'";
				mysqli_query($connexion, $supprimer);
				mysqli_close($connexion);
				session_destroy();
				header("location: index.php");
				exit;
			}

			//======================================
			//Mise a jour des informations du compte
			//======================================

			if(isset($_REQUEST['pseudo']) && isset($_REQUEST['mail' ]) && isset($_REQUEST['nom']) && isset($_REQUEST['prenom'])){

				$connexion=connexion_bd();
				$pseudo=mysqli_real_escape_string($connexion, $_REQUEST['pseudo']);
				$nom=mysqli_real_escape_string($connexion, $_REQUEST['nom']);
				$prenom=mysqli_real_escape_string($connexion, $_REQUEST['prenom']);
				$mail=mysqli_real_escape_string($connexion, $_REQUEST['mail']);
				$id = $_SESSION['id'];
			
				$verif = "UPDATE membres SET nom='$nom', prenom='$prenom',pseudo='$pseudo', mail='$mail' WHERE id='$id'"; 

					if($verif == TRUE){
						mysqli_query($connexion, $verif);
					}

					$_SESSION['pseudo']=$pseudo;
					$_SESSION['mail']=$mail;
					$_SESSION['prenom']=$prenom;
					$_SESSION['nom']=$nom;

					mysqli_close($connexion);	

					$Valide = 'Vos coordonnées ont bien été modifiés';
			}			

			//---------------------------
			//Mise a jour du mot de passe
			//---------------------------
			if(isset($_REQUEST['amdp']) && isset($_REQUEST['nmdp'])){

				$connexion=connexion_bdPDO();
				$pseudo=$_SESSION['pseudo'];
				$amdp=$_REQUEST['amdp'];
				$nmdp=password_hash($_REQUEST['nmdp'], PASSWORD_DEFAULT);

				$req = $connexion->query("SELECT * FROM membres WHERE pseudo = '$pseudo'");

				while($donnee = $req->fetch()){
					if(password_verify($amdp, $donnee['password'])){
						$changement=TRUE;
						break;
					}else{
						$erreur	= "L'ancien mot de passe ne correspond pas, il n'a pas été modifié";
						$changement=FALSE;
					}
				}

				if(isset($changement) && $changement==TRUE){
					$id=$_SESSION['id'];
					$change = $connexion->query("UPDATE membres SET password='$nmdp' WHERE id='$id'");
				}
				
			}
			$connexion=null;
			?>

			 <div class="nav">
		      <div class="container">
		      	<nav>
			        <ul>
			          <li><a href="index.php" >Accueil</a></li>   
			          <li><a href="forum.php" >Forum</a></li>    	
			          <li><a href="propos.html">A propos</a></li>
			          <li><a href="contact.php">Contact</a></li>
			          <?php if(isset($_SESSION['pseudo'])){echo '<li><a href="deconnexion.php">Deconnexion</a></li>';}?>
			        </ul>
		    	</nav>
		      </div>
		    </div>

		    <?php if(isset($Valide)){echo '<h3>'.$Valide.'</h3>';}  ?>
		    <?php if(isset($erreur)){echo '<h3>'.$erreur.'</h3>';}  ?>


		    <!-- Formulaire de mise a jour contenant les informations du compte courant -->
		    <div class="form">	
		  		<form action = "compte.php" method="post">
		  			<fieldset>
		  				
		  				<legend>Information Personnelle</legend>

		  					<label for="nom">Nom:</label>
						  	<input type="text" name="nom" size="30" id="nom" value="<?php echo $_SESSION['nom'];  ?>"><br>

						  	<label for="prenom">Prénom:</label>
						  	<input type="text" name="prenom" size="30" id="prenom" value="<?php echo $_SESSION['prenom'];  ?>"><br>

						  	<label for="amdp">Ancien mdp:</label>
						  	<input type="password" name="amdp" size="30" id="amdp" value=""><br>

						  	<label for="nmdp">Nouveau mdp:</label>
						  	<input type="password" name="nmdp" size="30" id="nmdp" value=""><br>

		  					<label for="pseudo">Pseudo:</label>
						  	<input type="text" name="pseudo" size="30" id="pseudo" value="<?php echo $_SESSION['pseudo'];  ?>"><br>

						  	<label for="mail">Mail:</label>
						  	<input type="text" name="mail" size="30" id="mail" value="<?php echo $_SESSION['mail'];  ?>"><br>

		  			</fieldset>
		  			
		  				<input type="submit" value="Modifier" name="send">
		  		</form>
			</div>
			<br>
			<div class="form">
				<form action="" method="post">
					<input type="hidden" name=supprimer id="supprimer" value="DELETE">
					<input type="submit" value="Supprimer son compte" name="send">
				</form>
			</div>
		</body>
	</html>