<?php
    session_start();
	require ("../Modele/modele_connexion_membre.php");
			
	$cm= new ConnexionMembre();
			
	if(isset($_GET['mem']))
	{
		$existe=$cm->existe();
		
		$login= $_POST['conn_login'];//identifiant de connexion
		if($existe==1)
		{
			$uneLigne=$cm->connection();
		}
		else //si la requete ne renvoie pas de ligne
		{
			//si erreur=true(mot de passe ou login incorrect alors on affiche un message d'erreur)
			echo"<script> alert ('Login ou Mot De Passe Incorrect !');</script>";
			// et redirection vers la page de connexion
			print ("<script language = \"JavaScript\">");
			print ("location.href = '../index.php';");
			print ("</script>");
		}
	}
	else
	{
		include("../index.php");
	}
?>