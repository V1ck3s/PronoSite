<?php
	
	require("../Modele/modele_parispage.php");
		
	$r= new Paris();
	include("../utils/header.php");
	$argentJoueur=$r->argentJoueur($_SESSION['login']);
	$lesParis=$r->readAll();

	if(isset($_SESSION['login']))
	{	
		if($_POST != null)
    	{
    		if($_POST['paris-mise'] > $argentJoueur->argent || $_POST['paris-mise'] <= 0){
    			header('Location: ../Controleur/ctrl_accueil_paris.php');
    		}
    		else{
    			echo "<script type=\"text/javascript\">alert(\"".$_POST['paris-mise']." ".$argentJoueur->argent."Tricher c'est pas bien.\nArrête maintenant et joue sans tricher.\");</script>";
    			$reussi=$r->creerParis();
				if($reussi){
					header('Location: ../Controleur/ctrl_moncompte.php');
				}
				else{
					
				}
    		}
			
			
		}
		else
		{
			include("../Vue/vue_paris.php");
		}
	}
	else{
		header('Location: ../Controleur/ctrl_accueil_paris.php');
	}
	
?>	
