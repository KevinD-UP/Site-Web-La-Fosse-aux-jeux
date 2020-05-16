<?php 
if(!isset($_SESSION)){session_start();}
require("fonction.php");

$connexion=connexion_bdPDO();
if(isset($_SESSION['pseudo'])){
	$isAdmin = isAdmin($connexion,$_SESSION['pseudo']);
	$isModo = isModo($connexion,$_SESSION['pseudo']);
}

$connexion=null;
?>

<!DOCTYPE html>
	<html lang="fr">
	  <head>
	    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,100' rel='stylesheet' type='text/css'>
		<link href="style.css" type="text/css" rel="stylesheet">
		<meta charset="utf-8">
		<title>La Fosse Aux Jeux</title>
	  </head>
	  
	  <body>
	    <div class="header">
	   	 <h5 id=connecter><?php if(isset($_SESSION['pseudo'])){echo $_SESSION['pseudo'];}?></h5>
	      <div class="container">
	        <h1>La Fosse Aux Jeux</h1>
	        <p>Une fois dedans,on n'en ressort jamais !</p>
	        <a class="btn" href="forum.php">Accès au Forum</a>
	      </div>
	    </div>

	    <div class="nav"> <!-- Barre de navigation -->
	      <div class="container">
		      <nav>
		        <ul>
		          <li><a href="index.php" >Accueil</a></li>
		          <?php if((isset($isAdmin)&&$isAdmin==TRUE)||(isset($isModo)&&$isModo==TRUE)){echo '<li><a href="gestion.php" >Gestion</a></li>';}?>         
		          <?php if(isset($_SESSION['pseudo'])){echo '<li><a href="compte.php" >Mon compte</a></li>';}?>         	
		          <li><a href="propos.html">A propos</a></li>
		          <li><a href="contact.php">Contact</a></li>
		        </ul>
	   		 </nav>
	       </div>
	    </div>
	    
	    <div class="main">
	      <div class="container">
	        <img src="image/icone1.jpg" alt="fond" height="200" width="250">
	        <h2>Bienvenue dans La Fosse Aux Jeux</h2>
	        <p>	La Fosse Aux Jeux est un site web communautaire où vous pourrez retrouver toute l'actualité des derniers jeux vidéos fraîchement sortis. Accéder a des tonnes de critiques, des tests, des reviews, des tutorials et des articles traitant de l'univers vidéoludique.</p>
	        <p>Echangés et débatés avec les autres membres de la communautée dans le respect et la bonne humeur et faites des découvertes dont vous n'aurez jamais soupçonnés l'existence.</p>
	        <p>Partager votre passion, votre enthousiasme et votre engouement pour l'univers des jeux vidéos et imprégnez-vous de celle des autres. </p>
	      </div>
	    </div>

	    <!-- Inscription et connexion/deconnexion -->
	    <div class="jumbotron">
	      <div class="container">
	        <h2>Jump in.</h2>
	        <h3>Keep calm and play.</h3>
	        
	       	<?php 
	       	//Affichage des boutons selon si l'utilisateur est connecté ou pas.
	       	if(!isset($_SESSION['pseudo'])){
	       		echo '<a class="btn" href="inscription.html">Rejoins-nous</a>';
	       		echo '<a class="btn" href="connexion.php">Se connecter</a>';
	       	}
	        else if(isset($_SESSION['pseudo'])){echo '<a class="btn" href="deconnexion.php">Deconnexion</a>';}?>
	      </div>
	    </div>

	    <div id="bas" class="footer">
	      <div class="container">
	        <p>Copyright &copy; LaFosseAuxJeux appartient à leurs créateurs.
	        Tout droits réservés.</p>
	      </div>
	    </div>
	  </body>
	</html>