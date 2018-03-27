<?php

	session_start();
			
			
	if(!isset($_SESSION['logged']))		
	{
		header('Location: budzet-domowy');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<title>Budżet Domowy</title>
	<meta name="description" content="Strona pomagająca w prowadzeniu budżetu domowego i ograniczenia niepotrzebnych wydatków.">
	<meta name="keywords" content="budżet, wydatki, pieniądze, wydawanie, zarządzanie pieniędzmi">
	<meta name="author" content="Lukasz Wojciech">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/fontello.css" rel="stylesheet" type="text/css" />
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css" text/css" />
	<script type="text/javascript">
		$(document).ready(function() {
			$("#menu").load( "menu.html" );
		});
	</script>
</head>

<body>
	
	<div id="menu"></div>
	
	<div id="mainContainer">	
		<div="content" style="padding-top: 50px;">
			<?php
				if(isset($_SESSION['e_main']))
				{
					echo '<div class="error">'.$_SESSION['e_main'].'</div>';
					unset($_SESSION['e_main']);
				}
			?>
		</div>
	</div>
	
	<footer>
		<div id="info">
		</div>
	
	</footer>
	
</body>

</html>