<?php  

	 /**
   	*  La fonction retourne une connexion à la base de données façon procédural.
   	*
   	* @author : Kevin DANG
   	* @return : connexion mode mysqli.
   	**/
	function connexion_bd(){
		$connexion=mysqli_connect("localhost","root", "", "fosse");
		if(!$connexion){
			echo "Echec de la connexion"; exit;
		}
		mysqli_query($connexion, 'SET NAMES UTF8'); //Force la connexion en UTF-8
		return $connexion;
	}

	/**
   	*  La fonction retourne une connexion à la base de données façon orienté objet.
   	*
   	* @author : kevin DANG
   	* @return : connexion mode PDO
   	**/
	function connexion_bdPDO(){
		$bdd = new PDO('mysql:host=localhost;dbname=fosse;charset=utf8', 'root', '');
		if(!$bdd ){
			echo "Echec de la connexion"; exit;
		}
		return $bdd;
	}	

	/**
   	*  La fonction vérifie si l'utilisateur courant est un administrateur
   	*
   	* @author : kevin DANG
   	* @param : connexion $connexion la connexion a la base de données
   	* @param : string $pseudo pseudo de l'utilisateur courant.
   	* @return : Booleen signifiant si l'utilisateur courant est un administrateur.
   	**/	

	function isAdmin($connexion, $pseudo){
		$req = $connexion->query("SELECT * FROM administrateurs WHERE pseudo ='$pseudo'");
		while($donnee = $req->fetch()){
			if($donnee['pseudo']==$pseudo){
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
   	*  La fonction vérifie si l'utilisateur courant est un modérateur
   	*
   	* @author : kevin DANG
   	* @param : connexion $connexion la connexion a la base de données
   	* @param : string $pseudo pseudo de l'utilisateur courant.
   	* @return : Booleen signifiant si l'utilisateur courant est un modérateur.
   	**/	
	function isModo($connexion, $pseudo){
		$req = $connexion->query("SELECT * FROM moderateurs WHERE pseudo ='$pseudo'");
		while($donnee = $req->fetch()){
			if($donnee['pseudo']==$pseudo){
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
   	*  La fonction vérifie si le pseudo choisi est déjà dans la base de données.
   	*
   	* @author : kevin DANG
   	* @param : connexion $connexion connexion à la base de données
   	* @param : string $pseudo pseudo indiqué dans le formulaire d'inscription
   	* @return : Booleen qui indique si le pseudo est disponible
   	**/
	function DejaPseudo($connexion, $pseudo){
		$req = $connexion->query("SELECT pseudo FROM membres WHERE pseudo ='$pseudo'");
		while($donnee = $req->fetch()){
			if($donnee['pseudo']==$pseudo){
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
   	*  La fonction vérifie si le pseudo choisi est déjà dans la base de données.
   	*
   	* @author : kevin DANG
   	* @param : connexion $connexion connexion à la base de données
   	* @param : string $mail mail indiqué dans le formulaire d'inscription
   	* @return : Booleen qui indique si l'email n'a pas déjà été utilisé.
   	**/
	function DejaMail($connexion, $mail){
		$req = $connexion->query("SELECT mail FROM membres WHERE mail ='$mail'");
		while($donnee = $req->fetch()){
			if($donnee['mail']==$mail){
				return TRUE;
			}
		}
		return FALSE;
	}





?>