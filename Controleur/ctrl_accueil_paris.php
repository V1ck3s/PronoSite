<?php
	
	require("../Modele/modele_paris.php");
		
	$r= new News();
	include("../utils/header.php");
	$lesNews=$r->readAll();
	include("../Vue/vue_accueil_paris.php");
?>	
