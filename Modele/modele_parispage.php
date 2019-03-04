<?php
	class Paris{
		//attribut priv� qui recevra une instance de la connexion
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
			//je re�ois ma requ�te SQL
			$req = "SELECT *
					FROM utilisateur
					WHERE login = :id";
			
			//je pr�pare ma requ�te
			$prep = $this->cx->prepare($req);
			
			//j'associe les param�tres
			$prep->bindValue(':id', $idJoueur, PDO::PARAM_STR);
			
			//j'ex�cute
			$prep->execute();
			
			//je remplis le curseur
			$curseur = $prep->fetchObject();
			return $curseur;
		}

		//retourne un curseur contenant l'objet associer � l'identifiant pass� en param�tre
		//on utilise ici la technique des requ�tes pr�par�es qui permettent d'�viter les injonctions SQL
		public function findById($idParis){
			//je re�ois ma requ�te SQL
			$req = "SELECT *
					FROM utilisateur
					WHERE id = :id";
			
			//je pr�pare ma requ�te
			$prep = $this->cx->prepare($req);
			
			//j'associe les param�tres
			$prep->bindValue(':id', $idParis, PDO::PARAM_STR);
			
			//j'ex�cute
			$prep->execute();
			
			//je remplis le curseur
			$curseur = $prep->fetchObject();
			return $curseur;
		}
		
		public function creerParis(){
			//Bool�en permettant de v�rifier l'�x�cution de la requ�te
			$valid=false;
		  
			//r�cup�ration des valeurs des champs:
			$loginJoueur=$_SESSION['login'];
			$idEvent=$_POST['paris-event'];
			$optionChoisis=$_POST['paris-option'];
			$gainRecupere=$_POST['paris-mise']*$_POST['paris-cote'];
			$mise=$_POST['paris-mise'];
			$cote=$_POST['paris-cote'];
			


			
			//cr�ation de la requ�te SQL:
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
			
			
			//ex�cution de la requ�te SQL:
			$requete->execute();
			
			//r�cup�ration de l'ID ins�r�			
			//$new_recette = $this->cx->lastInsertId();
			
			//r�cup�ration des valeurs des champs:
			$argentRetire=$_POST['paris-mise'];
			
			//cr�ation de la requ�te SQL:
			$sql2="UPDATE utilisateur
				SET argent = argent-:argent
				WHERE login = :loginJoueur";
			
			$requete2 = $this->cx->prepare($sql2);
				
			//J'associe les valeurs
			$requete2->bindValue(":argent",$argentRetire,PDO::PARAM_STR);
			$requete2->bindValue(":loginJoueur",$loginJoueur,PDO::PARAM_STR);
			//$requete2->bindValue(":new_recette",$new_recette,PDO::PARAM_INT);
			
			//ex�cution de la requ�te SQL:
			$requete2->execute();
			
			if($requete && $requete2){
				$valid=true;
			}
			return $valid;
		}
	}
?>