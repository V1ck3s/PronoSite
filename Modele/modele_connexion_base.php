<?php
	
	class Connexion{
		private static $monPdo;
		
		private  function __construct(){
			Connexion::$monPdo = null;
		}
		
		public static function getInstance(){
			if( Connexion :: $monPdo == null){
				try{
					$serveur='mysql:host=localhost';
					$bdd='dbname=paris';
					$user='vic1997';
					$mdp='vic1997_pswd';
					Connexion::$monPdo = new PDO($serveur.';'.$bdd, $user,$mdp);
					Connexion::$monPdo->query("SET CHARACTER SET utf8");
                    
				}catch (PDOException $e){
					throw new Exception("Erreur à la connexion \n" . $e->getMessage());
                    
                    
				}
			}
		return Connexion::$monPdo;
		}
		
	}
?>
