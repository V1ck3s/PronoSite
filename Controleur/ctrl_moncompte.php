<?php
	
	require("../Modele/modele_moncompte.php");
		
	$r= new Compte();
	include("../utils/header.php");
	$leCompte=$r->findById($_SESSION['login']);
	$lesComptes=$r->parisCompte($_SESSION['login']);
	if($_POST != null)
   	{
		$reussi=$r->actualiserGain();
		if($reussi){
			header('Location: ../Controleur/ctrl_moncompte.php');
		}
		else{
			header('Location: ../Controleur/ctrl_accueil_paris.php');
		}
   	}
	include("../Vue/vue_moncompte.php");
?>	
