<?php 
if(!isset($_SESSION)){session_start();}

require("fonction.php");

$connexion=connexion_bdPDO();
if(isset($_SESSION['pseudo'])){
	$isAdmin = isAdmin($connexion,$_SESSION['pseudo']);
	$isModo = isModo($connexion,$_SESSION['pseudo']);
}
$connexion=null;

if(isset($_POST['titre'])){

	/* mysqli_real_escape_string(): Protège les caractères spéciaux d'une chaîne pour l'utiliser dans une requête SQL, 
	* en prenant en compte le jeu de caractères courant de la connexion
	*/
	$connexion=connexion_bd();
	$idAuteur=mysqli_real_escape_string($connexion, $_SESSION['id']);
	$titre=mysqli_real_escape_string($connexion, $_POST['titre']);
	$image=mysqli_real_escape_string($connexion, basename($_FILES['image']['name'])); //Tableau $_FILES contient le fichier envoyé par <input type=file>.
	$paragraphe=mysqli_real_escape_string($connexion, $_POST['paragraphe']);

	$verif = "INSERT INTO articles (idAuteur, titre, image, paragraphe) VALUES ('$idAuteur','$titre','$image','$paragraphe')";				
	$resultat=mysqli_query($connexion, $verif);

	$sujet="Votre article a été posté.";
}


 ?>

<!DOCTYPE html>
	<html lang='fr'>
	<head>
	   <meta charset="utf-8">
	   <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
	   <title>Forum</title>
	   <link href="style.css" type="text/css" rel="stylesheet">
	</head>

	<body id=forum>
		<div class="nav">
	      <div class="container">
	      	<nav>
		        <ul>
		          <li><a href="index.php" >Accueil</a></li>
		          <?php if((isset($isAdmin)&&$isAdmin==TRUE)||(isset($isModo)&&$isModo==TRUE)){echo '<li><a href="gestion.php" >Gestion</a></li>';}?>      
		          <?php if(isset($_SESSION['pseudo'])){echo '<li><a href="compte.php" >Mon compte</a></li>';}?>
		          <?php if(isset($_SESSION['pseudo'])){echo '<li><a href="sujet.php" >Nouveau sujet</a></li>';}?>
		          <li><a href="propos.html">A propos</a></li>
		          <li><a href="contact.php">Contact</a></li>
		          <?php if(isset($_SESSION['pseudo'])){echo '<li><a href="deconnexion.php">Deconnexion</a></li>';}?>
		        </ul>
	    	</nav>
	      </div>
	    </div>

	    <h2>Heureux de te voir <?php if(isset($_SESSION['pseudo'])){ echo $_SESSION['pseudo'];}?></h2>
	    <h4><?php if(isset($sujet)){ echo $sujet;}?></h4>

	    <br>

	    <!-- Affichage de tout les articles -->
	    
	  	<?php  
	  		$connexion=connexion_bd();
	  		$selection="SELECT * FROM articles";
	  		$res=mysqli_query($connexion, $selection);
	  		?>
	  		<table>
	  			<caption>Liste des articles</caption>
	  			<?php
	  		while($donnee=mysqli_fetch_assoc($res)){
	  			?>
	  			<tr>
	  			<td>
	  			<?php
	  			echo "<a href=article.php?idArticle=".$donnee['idArticle']." class='listeArticle'>".htmlspecialchars($donnee['titre'])."</a></br>";
	  			echo "--------------------------------------------------";
	  			?>
	  			</td>
	  			</tr>

	  			
	  			<?php					  			
	  		}

	  	?>
	  </table>
	  
	</body>

</html>  