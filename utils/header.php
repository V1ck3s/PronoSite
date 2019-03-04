<?php

	session_start();
	if(!isset($_SESSION["prev_page"]))
	{
		$_SESSION["prev_page"] = "https://papawy.com";
	}

	$_SESSION["prev_page"] = $_SESSION["curr_page"];
	$_SESSION["curr_page"] = $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>

<html>
	<head>
		<title>Papawy's Page</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<meta name="google-site-verification" content="-OCWIqZiDm8eS9sBWqR9ifZW6BKQxMQZSBQ130puBUA" />
		<meta name="google-site-verification" content="9ibuz_jCYsmO3Ew9r42eS_JimEKEEZFzCea7mF4Yojw" />

		<meta name="description" content="I'm a student and programmer.">
  		<meta name="keywords" content="Papawy,Papanon,C++,SAMP,SA-MP-FR,sa-mp-fr,développeur-developer,C#,C,Pawn">
  		<meta name="author" content="Papawy">

		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="https://papawy.com/assets/css/main.css" />
		<link rel="icon" type="image/png" href="https://papawy.com/images/favicon.png">
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="https://papawy.com/assets/css/noscript.css" /></noscript>
		<script type="text/javascript" src="../assets/jquery.js"></script>
	</head>
<html>
