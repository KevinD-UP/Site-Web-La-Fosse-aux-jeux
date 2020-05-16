<?php  
	if(!isset($_SESSION)){session_start();}

	require("fonction.php");
	$connexion=connexion_bdPDO();

	//===================================
	// Identification de l'administrateur
	//===================================
	if(isset($_SESSION['pseudo'])){
		$isAdmin = isAdmin($connexion,$_SESSION['pseudo']);
	}
	$connexion=null; //fermeture de la connexion PDO

	//===================================================================
	//Début de l'exportation si l'utilisateur est bien un administrateur.
	//===================================================================
	if($isAdmin){

		$table=$_GET['table']; //Récupération de la valeur envoyé par le lien qui détermine quel base table nous voulons exporter.
		$filename=$table.".csv"; //Initialisation du nom du fichier que l'on va obtenir.
		$fp=fopen($filename,'w'); //Création et ouverture du fichier pour écriture.
		fputs($fp,"\xEF\xBB\xBF"); //Force l'affichage en UTF-8 lorsqu'on l'ouvre avec Excel.
		$connexion=connexion_bd();

		//----------------------------------------
		//Procédure sur la table des articles.
		//----------------------------------------
		if($table==='Articles'){

			$tableau=array();
			$tableau[0]=array('idArticle','idAuteur','Titre','Image','Paragraphe');
			fputcsv($fp, $tableau[0], ';'); // INSERTION des en-tête dans le fichier csv. (@param 1: fichier ouvert, @param 2: ligne, @param 3: délimiteur).

			$articles=mysqli_query($connexion,"SELECT * FROM articles ORDER BY idArticle ASC");

			while ($article=mysqli_fetch_assoc($articles)) {
				$tableau[0][0]=$article['idArticle'];
				$tableau[0][1]=$article['idAuteur'];
				$tableau[0][2]=$article['titre'];
				$tableau[0][3]=$article['image'];
				$tableau[0][4]=$article['paragraphe'];
				fputcsv($fp, $tableau[0], ';'); //INSERTION ligne par ligne des données de la table (*optimisation voir plus bas).
			}
		}

		//----------------------------------------
		//Même procédure avec la table des membres
		//----------------------------------------
		else if($table==='Membres'){

			$tableau=array();
			$tableau[0]=array('Id','Nom','Prenom','Pseudo','Mail');
			fputcsv($fp, $tableau[0], ';'); // INSERTION des en-tête dans le fichier csv. (@param 1: fichier ouvert, @param 2: ligne, @param 3: délimiteur).

			$membres=mysqli_query($connexion,"SELECT * FROM membres ORDER BY id ASC");

			while ($membre=mysqli_fetch_assoc($membres)) {
				$tableau[0][0]=$membre['id'];
				$tableau[0][1]=$membre['nom'];
				$tableau[0][2]=$membre['prenom'];
				$tableau[0][3]=$membre['pseudo'];
				$tableau[0][4]=$membre['mail'];
				fputcsv($fp, $tableau[0], ';');
			}
		}

		mysqli_close($connexion); //Fermeture de la connexion.
		fclose($fp); //Fermeture du fichier
		header("Content-Type: text/csv"); // Indique au type du client le contenu renvoyé, en l'occurence csv.
		header("Content-Disposition: attachment; filename=".$filename); //Force le téléchargement du fichier.
		readfile($filename);
		exit;
	}

	/* Note de l'optimisation:
	* Il vaut mieux insérer ligne par ligne les données de la table dans le fichier csv plutôt que de crée un tableau
	* que l'on importe ensuite.
	* On obtient un gain de mémoire et sans doute de performance.
	*/







?>