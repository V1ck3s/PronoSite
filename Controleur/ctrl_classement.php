<?php
	
	require("../Modele/modele_classement.php");
		
	$r= new Classement();
	include("../utils/header.php");
	$lesClassements=$r->readAll();
	include("../Vue/vue_classement.php");
?>	
