<?php
	class ConnexionMembre{
		private $cx;
		
		public function __construct(){
			require_once("../Modele/modele_connexion_base.php");
			$this->cx = Connexion::getInstance();
		}
		public function existe()
		{	
			//on récupère, via la méthode "post" les données envoyées
			$login= $_POST['conn_login'];//identifiant de connexion
			$pass=md5($_POST['conn_pass']);//mot de passe de connexion
			//requete SQL récupérant toutes les informations sur l'utilisateur
			$reqSQL="SELECT * FROM utilisateur WHERE login=:login AND mdp=:pass";
			$unLogin = $this->cx->prepare($reqSQL);
			
			//j'associe les paramètres	
			$unLogin->bindValue(":login",$login,PDO::PARAM_STR);
			$unLogin->bindValue(":pass",$pass,PDO::PARAM_STR);	
			$unLogin->execute();
			//on stock dans une variable de session le nombre de lignes que renvoie la requête
			$existe = 0;
			if($uneLigne=$unLogin->fetch(PDO::FETCH_OBJ))
			{
				$existe=1;
			}
			return $existe;
	
		}
		
		public function connection()
		{
			//on récupère, via la méthode "post" les données envoyées
			$login= $_POST['conn_login'];//identifiant de connexion
			$pass=md5($_POST['conn_pass']);//mot de passe de connexion
			//requete SQL récupérant toutes les informations sur l'utilisateur
			$reqSQL="SELECT * FROM utilisateur WHERE login=:login AND mdp=:pass";
			$unLogin = $this->cx->prepare($reqSQL);
			
			//j'associe les paramètres	
			$unLogin->bindValue(":login",$login,PDO::PARAM_STR);
			$unLogin->bindValue(":pass",$pass,PDO::PARAM_STR);	
			$unLogin->execute();
			//on stock dans une variable de session le nombre de lignes que renvoie la requête
			$nbLigne=0;
			if($uneLigne=$unLogin->fetch(PDO::FETCH_OBJ)){
				$nbLigne=1;
			}
			$_SESSION['userLog']=$nbLigne;
			
			if ($_SESSION['userLog']==1)//si la requete renvoie une ligne
			{
				$_SESSION['login']=$uneLigne->login; //on stock l'identifiant dans une variable de session (C'EST CETTE VARIABLE QUI, SI ELLE EST NON VIDE, SIGNIFIE QUE L'ON EST CONNECTE)
				$_SESSION['idUtil']=$uneLigne->idUtil;
				
				header("Location:../index.php");
			}
		}
	}
?>