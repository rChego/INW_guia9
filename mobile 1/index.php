<!DOCTYPE html>
<html>
	<head>
		<title>jQuery Mobile App</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
		<script src="js/jquery.js"></script>
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>	
	</head>
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="b">
				<h1></h1>
				<?php require 'nav.php'; ?>
			</div>
			<div data-role="main" data-theme="a">
				<div class="ui-content">
					<h3>&Uacute;ltimos productos</h3>
				</div>
			</div>
			<div data-role="footer" data-theme="a">
				<div class="iu-content">
					<small>&copy; Rub&eacute;n Echegoy&eacute;n</small>
				</div>
			</div>
		</div>
	</body>
</html>