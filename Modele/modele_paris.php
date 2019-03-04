<?php

	class News{
		//attribut privé qui recevra une instance de la connexion
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
		
		//retourne un curseur contenant l'objet associer à l'identifiant passé en paramètre
		//on utilise ici la technique des requêtes préparées qui permettent d'éviter les injonctions SQL
		public function findById($idNews){
			//je reçois ma requête SQL
			$req = "SELECT *
					FROM news
					WHERE id = :id";
			
			//je prépare ma requête
			$prep = $this->cx->prepare($req);
			
			//j'associe les paramètres
			$prep->bindValue(':id', $idNews, PDO::PARAM_STR);
			
			//j'exécute
			$prep->execute();
			
			//je remplis le curseur
			$curseur = $prep->fetchObject();
			return $curseur;
		}
		
		/*public function create(){
			//Booléen permettant de vérifier l'éxécution de la requête
			$valid=false;
		  
			//récupération des valeurs des champs:
			$nom=$_POST['rec_nom'];
			$descriptif=$_POST['rec_desc'];
			$difficulte=$_POST['rec_dif'];
			$prix=intval($_POST['rec_prix']);
			$personnes=intval($_POST['rec_pers']);
			$preparation=intval($_POST['rec_prep']);
			$cuisson=intval($_POST['rec_cuis']);
			$totale=$preparation+$cuisson;
			$idUtil=intval($_SESSION['idUtil']);
			//création de la requête SQL:
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
			
			//exécution de la requête SQL:
			$requete->execute();
			
			//récupération de l'ID inséré			
			$new_recette = $this->cx->lastInsertId();
			
			//récupération des valeurs des champs:
			$adresse=$_POST['rec_illu'];
			
			//création de la requête SQL:
			$sql2="INSERT INTO illustration(adresse, idRec)
				VALUES (:adresse, :new_recette)";
			
			$requete2 = $this->cx->prepare($sql2);
				
			//J'associe les valeurs
			$requete2->bindValue(":adresse",$adresse,PDO::PARAM_STR);
			$requete2->bindValue(":new_recette",$new_recette,PDO::PARAM_INT);
			
			//exécution de la requête SQL:
			$requete2->execute();
			
			if($requete && $requete2){
				$valid=true;
			}
			return $valid;
		}*/
	}
?>
