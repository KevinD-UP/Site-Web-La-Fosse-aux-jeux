<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	require("fonction.php");

	//========================================
	//En cas de poste d'un nouveau commentaire
	//========================================

	/* 
	* mysqli_real_escape_string() permet de protéger les caractères spéciaux d'une chaîne pour l'utiliser dans une requête SQL, 
	* en prenant en compte le jeu de caractères courant de la connexion
	*/
	if(isset($_POST['commentaire'])){
		$connexion=connexion_bd();
		$id=$_GET['idArticle'];
		$pseudo=mysqli_real_escape_string($connexion, $_SESSION['pseudo']);
		$newCom=mysqli_real_escape_string($connexion, $_POST['commentaire']);
		$AjoutCom="INSERT INTO commentaires (idArticle,pseudo,commentaire) value ('$id','$pseudo','$newCom')";
		mysqli_query($connexion, $AjoutCom);
		mysqli_close($connexion);
	}

  ?>

<!DOCTYPE html>
<html lang='fr'>
<head>
	<meta charset="utf-8">
	<title>Article</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style2.css" type="text/css">
</head>
<body>
	<div class="nav">
	      <div class="container">
		      <nav>
		        <ul>
		          <li><a href="index.php" >Accueil</a></li>
		          <li><a href="forum.php" >Forum</a></li>
		          <?php if(isset($isAdmin)&&$isAdmin==TRUE){echo '<li><a href="gestion.php" >Gestion</a></li>';}?>         
		          <?php if(isset($_SESSION['pseudo'])){echo '<li><a href="compte.php" >Mon compte</a></li>';}?>         	
		          <li><a href="propos.html">A propos</a></li>
		          <li><a href="contact.php">Contact</a></li>
		        </ul>
	   		 </nav>
	      </div>
	    </div>

	<?php

	$connexion=connexion_bd();
	$id=$_GET['idArticle']; //$id prend en l'id de l'article sur lequel on est
	$comment="SELECT * from commentaires WHERE idArticle='$id' ORDER BY id DESC"; //Requête sur la table des commentaires.
	$afficher="SELECT * from articles WHERE idArticle='$id'"; //Requête sur la tables des articles
	$res=mysqli_query($connexion, $afficher);
	$commentaire=mysqli_query($connexion,$comment);

	//---------------------------------
	//Affichage du contenu de l'article
	//---------------------------------
	while($donnee=mysqli_fetch_assoc($res)){
		echo "<div id=article>";
		echo "<h2>".htmlspecialchars($donnee['titre'])."</h2>";
		echo "<img width=700px heigth=700px src=image/".htmlspecialchars($donnee['image']).">";
		echo "<p>".htmlspecialchars($donnee['paragraphe'])."</p>";
		echo "</div>";
	}

	//--------------------------------------
	//Affichage des commentaires de l'article
	//---------------------------------------
	while($commentaires=mysqli_fetch_assoc($commentaire)){
		echo "<div id=commentaires>";
		echo "<strong>".htmlspecialchars($commentaires['pseudo'])."</strong><br>";
		echo "_____________________________<br>";
		echo htmlspecialchars($commentaires['commentaire'])."<br><br>";
		echo "</div>";
	}	

	mysqli_close($connexion);

	?>

	<!-- Formulaire d'envoi d'un nouveau commentaire -->
	<?php if(isset($_SESSION['pseudo'])){
	echo "
	<div class='form'>
	  		<form action = '' method='post'>
	  			<fieldset>
	  				<legend>Ecrire un commentaire</legend>
	  				
					 	<textarea name='commentaire' id='commentaire' cols='50' rows='10'></textarea><br>

						 <input type='submit' value='Envoyer' name='send'>
						 <input type='reset' value='Effacer' name='clear'>

	  			</fieldset>
	  		</form>
	  	</div>
	  		"
		;
	}
	?>


	</body>
</html>