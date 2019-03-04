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

.paris-case.active
{
	background: red;
}

input{
	color:black;
}

</style>


<html>
<script>
$(function()
{
	var jCote = 0;
	var jMise = 0;
	var jGain = 0;
	var pEvent = 0;
	var pOption = '';

	$(".paris-case").click(function()
	{
		jCote = $(this).data('cote');
		pOption = $(this).data('option');
		pEvent = $(this).data('id');

		$(".paris-case").removeClass('active');
		$(this).toggleClass('active');

		$("#paris-option").val(pOption);
		$("#paris-cote").val(jCote);
		$("#paris-event").val(pEvent);

		if(jMise != 0)
		{
			jGain = jMise * jCote;

			$("#gain").text(jGain);			
		}
	});

	$("#someid").change(function()
	{
		jMise = $(this).val();
		jGain = jMise * jCote;

		$("#paris-mise").val(jMise);

		$("#gain").text(jGain.toFixed(2));
	});


});
</script>

<script type="text/javascript">
				var toto = new Array();
				function myFunction(elmnt,clr, id, idOption, cote){
                	//alert('ID Match : '+id+'\nID de l\'équipe :'+idOption+'\nGain : '+document.getElementById('someid').value*cote);
                	var elem = document.getElementById('gain');
                	elem.innerHTML = document.getElementById('someid').value*cote;
                	elmnt.style.color = clr;

        		}
        		function test(){
        			var elem = document.getElementById('gain');
        			elem.innerHTML = document.getElementById('someid').value*cote;
        		}

				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
</script>

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
							Événements à venir :
							<table border="10" cellpadding="15" width="100%"><tr height="70"><th>1</th><th>N</th><th>2</th><th>Date</th></tr>
							<?php
								while($unParis=$lesParis->fetch(PDO::FETCH_OBJ))
								{
									$string = '<tr>';
										$string .= '<th class="paris-case" data-id="' . $unParis->id . '" data-cote="' . $unParis->cotePremiere . '" data-option="' . $unParis->premiereOption . '">' . $unParis->premiereOption . '<br><br>' . number_format($unParis->cotePremiere, 2, ',', ' ') . '</th>';
										$string .= '<th class="paris-case" data-id="' . $unParis->id . '" data-cote="' . $unParis->coteDeuxieme . '" data-option="' . $unParis->deuxiemeOption . '">' . $unParis->deuxiemeOption . '<br><br>' . number_format($unParis->coteDeuxieme, 2, ',', ' ') . '</th>';
										$string .= '<th class="paris-case" data-id="' . $unParis->id . '" data-cote="' . $unParis->coteTroisieme . '" data-option="' . $unParis->troisiemeOption . '">' . $unParis->troisiemeOption . '<br><br>' . number_format($unParis->coteTroisieme, 2, ',', ' ') . '</th>';
										$string .= '<th>' . $unParis->heureDebut . '</th>';
									$string .= '</tr>';

									echo $string;


									//echo "<tr><th id=\"premiereCase".$unParis->id."\" onclick=\"myFunction(this, 'red', ".$unParis->id.", 1, ".$unParis->cotePremiere.");\">".$unParis->premiereOption."</br></br>".$unParis->cotePremiere."</th><th id=\"deuxiemeCase".$unParis->id."\" onclick=\"myFunction(this, 'red', ".$unParis->id.", 2, ".$unParis->coteDeuxieme.");\">".$unParis->deuxiemeOption."</br></br>".$unParis->coteDeuxieme."</th><th id=\"troisiemeCase".$unParis->id."\" onclick=\"myFunction(this, 'red', ".$unParis->id.",3, ".$unParis->coteTroisieme.");\">".$unParis->troisiemeOption."</br></br>".$unParis->coteTroisieme."</th><th>".$unParis->heureDebut."</th></tr>";
								}
							?>
							</table>
						</p>
						</br>
						<p>
							Votre mise : <input type="number" id="someid" onchange="test()" min="1" max="<?php echo $argentJoueur->argent; ?>"/> €
						</br>
							Gain en cas de succès : <span id="gain">0</span> €
						</p>

						<form method="post" action="../Controleur/ctrl_paris.php">
							<input type="hidden" id="paris-option" name="paris-option">
							<input type="hidden" id="paris-mise" name="paris-mise">
							<input type="hidden" id="paris-cote" name="paris-cote">
							<input type="hidden" id="paris-event" name="paris-event">

							<button type="submit">Parier</button>
						</form>

							
						
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
			

	</body>
</html>