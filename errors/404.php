<!DOCTYPE HTML>
<!--
	Identity by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<?php
	include($_SERVER['DOCUMENT_ROOT']."/utils/header.php");
?>

<html>
	<head>
		<link rel="stylesheet" href="/assets/css/pages.css"/>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main" style="text-align:center;">
						<h1 style="font-size: 300%; margin-bottom: 1px;">404 ERROR</h1>
						<h2 style="margin-top: 50px;margin-bottom: 40px">Nothing to see here !</h2>


						<hr class="separator"/>
						<footer style="text-align:center;margin-top: 30px;">
							<ul class="icons">
								<li><a target="_blank" href="https://github.com/Papawy" class="fa-github">Github</a></li>
								<li><a target="_blank" href="https://twitter.com/PapawyDev" class="fa-twitter">Twitter</a></li>
								<li><a href="mailto:contact@papawy.com" class="fa-envelope">E-Mail me !</a></li>
							</ul>
						</footer>
						<h1 style="font-size:500%;vertical-align:top;text-align:left;color:white;margin-top:0px;margin-bottom:0px;"><a href="https://papawy.com/" class="back_link"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a></h1>
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