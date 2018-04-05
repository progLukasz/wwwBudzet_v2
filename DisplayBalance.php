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
	<script src="js/Chart.js"></script>
	<script src="js/script.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
			$("#menu").load( "menu.html" );
			$("#subMenu").load("submenu_balance.html");
		});
	</script>
</head>

<body>

	<div id="menu"></div>
	<div style="max-width: 1200px; min-height: 800px; margin-top: 40px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div id="content">
				<div class="title">Wyświetl bilans</div>
				<div id="subMenu"></div>
				<div id="rowContent" class="row">	
				</div>
			</div>	
		</div>
	</div>
	<footer>
		<div id="info"> 2018 &copy; Łukasz Wojciech - Budżet Domowy. lukasz.wojciech.programista@gmail.com</div>
	</footer>		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>