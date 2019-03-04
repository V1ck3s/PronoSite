<?php
	class Paris{
		//attribut privé qui recevra une instance de la connexion
		private $cx;
		
		public function __construct(){
			require_once("../Modele/modele_connexion_base.php");
			$this->cx = Connexion::getInstance();
		}
		
		//Retourne un curseur contenant toutes les recettes
		public function readAll(){
			$req = "SELECT *
					FROM event
					WHERE heureDebut >= NOW()
					ORDER BY heureDebut ASC";
			$curseur=$this->cx->query($req);
			return $curseur;
		}
		
		public function argentJoueur($idJoueur){
			//je reçois ma requête SQL
			$req = "SELECT *
					FROM utilisateur
					WHERE login = :id";
			
			//je prépare ma requête
			$prep = $this->cx->prepare($req);
			
			//j'associe les paramètres
			$prep->bindValue(':id', $idJoueur, PDO::PARAM_STR);
			
			//j'exécute
			$prep->execute();
			
			//je remplis le curseur
			$curseur = $prep->fetchObject();
			return $curseur;
		}

		//retourne un curseur contenant l'objet associer à l'identifiant passé en paramètre
		//on utilise ici la technique des requêtes préparées qui permettent d'éviter les injonctions SQL
		public function findById($idParis){
			//je reçois ma requête SQL
			$req = "SELECT *
					FROM utilisateur
					WHERE id = :id";
			
			//je prépare ma requête
			$prep = $this->cx->prepare($req);
			
			//j'associe les paramètres
			$prep->bindValue(':id', $idParis, PDO::PARAM_STR);
			
			//j'exécute
			$prep->execute();
			
			//je remplis le curseur
			$curseur = $prep->fetchObject();
			return $curseur;
		}
		
		public function creerParis(){
			//Booléen permettant de vérifier l'éxécution de la requête
			$valid=false;
		  
			//récupération des valeurs des champs:
			$loginJoueur=$_SESSION['login'];
			$idEvent=$_POST['paris-event'];
			$optionChoisis=$_POST['paris-option'];
			$gainRecupere=$_POST['paris-mise']*$_POST['paris-cote'];
			$mise=$_POST['paris-mise'];
			$cote=$_POST['paris-cote'];
			


			
			//création de la requête SQL:
			$sql="INSERT INTO paris(loginJoueur, idEvent, optionChoisis, gainRecupere, mise, cote)
				VALUES (:loginJoueur, :idEvent, :optionChoisis, :gainRecupere, :mise, :cote)";
				
			$requete = $this->cx->prepare($sql);
				
			//J'associe les valeurs
			$requete->bindValue(":loginJoueur",$loginJoueur,PDO::PARAM_STR);
			$requete->bindValue(":idEvent",$idEvent,PDO::PARAM_INT);
			$requete->bindValue(":optionChoisis",$optionChoisis,PDO::PARAM_STR);	
			$requete->bindValue(":gainRecupere",$gainRecupere,PDO::PARAM_STR);	
			$requete->bindValue(":mise",$mise,PDO::PARAM_STR);	
			$requete->bindValue(":cote",$cote,PDO::PARAM_STR);			
			
			
			//exécution de la requête SQL:
			$requete->execute();
			
			//récupération de l'ID inséré			
			//$new_recette = $this->cx->lastInsertId();
			
			//récupération des valeurs des champs:
			$argentRetire=$_POST['paris-mise'];
			
			//création de la requête SQL:
			$sql2="UPDATE utilisateur
				SET argent = argent-:argent
				WHERE login = :loginJoueur";
			
			$requete2 = $this->cx->prepare($sql2);
				
			//J'associe les valeurs
			$requete2->bindValue(":argent",$argentRetire,PDO::PARAM_STR);
			$requete2->bindValue(":loginJoueur",$loginJoueur,PDO::PARAM_STR);
			//$requete2->bindValue(":new_recette",$new_recette,PDO::PARAM_INT);
			
			//exécution de la requête SQL:
			$requete2->execute();
			
			if($requete && $requete2){
				$valid=true;
			}
			return $valid;
		}
	}
?>