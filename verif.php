<!DOCTYPE html>
	<html lang="fr">
	  <head>
	  	<?php require("fonction.php")  ?>
		<link href="style2.css" type="text/css" rel="stylesheet">
		<meta charset="utf-8">
		<title>La Fosse Aux Jeux | Verif</title>

	  </head>
	  
	 	<body>

			<?php

			//===============================================
			//Vérification que tout les champs soient remplis
			//===============================================
			$remplie=TRUE;

			$champs = array('prenom', 'nom', 'motdepasse','Rmotdepasse','pseudo','mail');
			foreach ($champs as $unchamp) {
				if(isset($_REQUEST[$unchamp])){
					if(!$_REQUEST[$unchamp]==""){
						$unchamp=$_REQUEST[$unchamp];
					}else{
						$remplie=FALSE;
					}
				}
			}

			//Vérification de la correspondance des deux mots de passe.
			if($_REQUEST['motdepasse']!=$_REQUEST['Rmotdepasse']){
				$remplie=FALSE;
				echo "Les mots de passes ne correspondent pas.";
			}

			//Test si le pseudo ou mail envoyé a déjà été pris.
			$bdd=connexion_bdPDO();
			$DejaPseudo=DejaPseudo($bdd, $_REQUEST['pseudo']);
			$DejaMail=DejaMail($bdd, $_REQUEST['mail']);
			$bdd=null;

			if($DejaPseudo){
				$remplie=FALSE;
				echo "Le Pseudo a déja été pris.";
			}

			if($DejaMail){
				$remplie=FALSE;
				echo "Le mail a déjà été utilisé.";
			}
		

			if($remplie==TRUE){

				/* mysqli_real_escape_string(): Protège les caractères spéciaux d'une chaîne pour l'utiliser dans une requête SQL, 
				* en prenant en compte le jeu de caractères courant de la connexion
				*/

				$connexion=connexion_bd();
				$nom=mysqli_real_escape_string($connexion, $_REQUEST['nom']);
				$prenom=mysqli_real_escape_string($connexion, $_REQUEST['prenom']);
				$motdepasse=mysqli_real_escape_string($connexion, password_hash($_REQUEST['motdepasse'], PASSWORD_DEFAULT)); //Cryptage du mot de passe.
				$pseudo=mysqli_real_escape_string($connexion, $_REQUEST['pseudo']);
				$mail=mysqli_real_escape_string($connexion, $_REQUEST['mail']);
			
					$verif = "INSERT INTO membres (nom, prenom, pseudo, password, mail) VALUES ('$nom','$prenom','$pseudo','$motdepasse', '$mail')";
					
					$resultat=mysqli_query($connexion, $verif);

				/* Validation de l'inscription */	
				echo '<h1 class="accueil">Félicitation, vous êtes tombé dans la fosse, vous n\'en ressortirez pas de sitôt</h1><br>';				
				echo '<a class="retour" href=index.php> <img src="image/start.jpg" height=300px width = 500px alt="acceuil"/> </a>';
														
			}else{
				/* echec de l'inscription */	
				echo '<h1 class="accueil" >Inscription non valide, pour reesayer cliquer sur l\'image :)</h1>';
				echo '<a class="retour" href=Inscription.html><img src=image/gameover.jpg height=300px width = 400px alt="gameover"/></a>';
			}

			?>

		</body>
	</html>