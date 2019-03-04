<?php

	class News{
		//attribut priv� qui recevra une instance de la connexion
		private $cx;
		
		public function __construct(){
			require_once("../Modele/modele_connexion_base.php");
			$this->cx = Connexion::getInstance();
		}
		
		//Retourne un curseur contenant toutes les recettes
		public function readAll(){
			$req = "SELECT *
					FROM news 
					ORDER BY id DESC";
			$curseur=$this->cx->query($req);
			return $curseur;
		}
		
		//retourne un curseur contenant l'objet associer � l'identifiant pass� en param�tre
		//on utilise ici la technique des requ�tes pr�par�es qui permettent d'�viter les injonctions SQL
		public function findById($idNews){
			//je re�ois ma requ�te SQL
			$req = "SELECT *
					FROM news
					WHERE id = :id";
			
			//je pr�pare ma requ�te
			$prep = $this->cx->prepare($req);
			
			//j'associe les param�tres
			$prep->bindValue(':id', $idNews, PDO::PARAM_STR);
			
			//j'ex�cute
			$prep->execute();
			
			//je remplis le curseur
			$curseur = $prep->fetchObject();
			return $curseur;
		}
		
		/*public function create(){
			//Bool�en permettant de v�rifier l'�x�cution de la requ�te
			$valid=false;
		  
			//r�cup�ration des valeurs des champs:
			$nom=$_POST['rec_nom'];
			$descriptif=$_POST['rec_desc'];
			$difficulte=$_POST['rec_dif'];
			$prix=intval($_POST['rec_prix']);
			$personnes=intval($_POST['rec_pers']);
			$preparation=intval($_POST['rec_prep']);
			$cuisson=intval($_POST['rec_cuis']);
			$totale=$preparation+$cuisson;
			$idUtil=intval($_SESSION['idUtil']);
			//cr�ation de la requ�te SQL:
			$sql="INSERT INTO recette(nom, descriptif, difficulte, prix, nbPersonnes, dureePreparation,
				dureeCuisson, dureeTotale, qteCalories, qteProteines, qteGlucides, qteLipides, qteProtides, idUtil)
				VALUES (:nom, :descriptif, :difficulte, :prix, :personnes, :preparation, :cuisson, :totale, 0, 0, 0, 0, 0, :idUtil)";
				
			$requete = $this->cx->prepare($sql);
				
			//J'associe les valeurs
			$requete->bindValue(":nom",$nom,PDO::PARAM_STR);
			$requete->bindValue(":descriptif",$descriptif,PDO::PARAM_STR);
			$requete->bindValue(":difficulte",$difficulte,PDO::PARAM_STR);	
			$requete->bindValue(":prix",$prix,PDO::PARAM_INT);	
			$requete->bindValue(":personnes",$personnes,PDO::PARAM_INT);	
			$requete->bindValue(":totale",$totale,PDO::PARAM_INT);			
			$requete->bindValue(":cuisson",$cuisson,PDO::PARAM_INT);
			$requete->bindValue(":preparation",$preparation,PDO::PARAM_INT);			
			$requete->bindValue(":idUtil",$idUtil,PDO::PARAM_INT);	
			
			//ex�cution de la requ�te SQL:
			$requete->execute();
			
			//r�cup�ration de l'ID ins�r�			
			$new_recette = $this->cx->lastInsertId();
			
			//r�cup�ration des valeurs des champs:
			$adresse=$_POST['rec_illu'];
			
			//cr�ation de la requ�te SQL:
			$sql2="INSERT INTO illustration(adresse, idRec)
				VALUES (:adresse, :new_recette)";
			
			$requete2 = $this->cx->prepare($sql2);
				
			//J'associe les valeurs
			$requete2->bindValue(":adresse",$adresse,PDO::PARAM_STR);
			$requete2->bindValue(":new_recette",$new_recette,PDO::PARAM_INT);
			
			//ex�cution de la requ�te SQL:
			$requete2->execute();
			
			if($requete && $requete2){
				$valid=true;
			}
			return $valid;
		}*/
	}
?>
