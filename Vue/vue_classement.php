<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #e7e7e7;
    background-color: #f3f3f3;
	
}

li {
    float: left;
	border-right: none;
}

li a {
    display: block;
    color: #666;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #ddd;
}

li a.active {
    color: white;
    background-color: #4CAF50;
}

table{
	border: medium solid #6495ed;
	border-collapse: collapse;
	
}

th {

	font-family: Segoe UI, Frutiger, Frutiger Linotype, Dejavu Sans, Helvetica Neue, Arial, sans-serif;
	font-size: 24px;
	font-style: normal;
	font-variant: normal;
	font-weight: 100;
	line-height: 26.4px;
	border: thin solid #6495ed;
	padding: 15px;
	background-color: #6d6d6d;
}

</style>


<html>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						
							
					 <ul>


						  <li><a href="../index.php">Accueil</a></li>
						  <li><a href="../Controleur/ctrl_moncompte.php">Mon Compte</a></li>
						  <li><a href="../Controleur/ctrl_paris.php">Paris</a></li>
						  <li><a href="../Controleur/ctrl_classement.php">Classement</a></li>
						  <li><a href="../Controleur/ctrl_deconnexion.php">Déconnexion</a></li>
						</ul>

						</br>
						</br>
						</br>

						<p>
							<table border="10" cellpadding="15" width="100%"><tr height="70"><th>Login</th><th>Argent</th></tr>
							<?php
								while($unClassement=$lesClassements->fetch(PDO::FETCH_OBJ))
								{
									echo "<tr><th>".$unClassement->login."</th><th>".$unClassement->argent."€</th></tr>";
								}
							?>
							</table>
						</p>
							
						
					</section>

				<!-- Footer -->
					<footer id="footer">
						<!--
						<ul class="copyright">
							<li>&copy; Jane Doe</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					-->
					</footer>

			</div>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>

	</body>
</html>