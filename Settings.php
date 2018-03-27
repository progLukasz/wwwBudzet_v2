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
	<script src="js/script.js"></script>
	
	<script type="text/javascript">

	$(document).ready(function() {
		$("#menu").load( "menu.html" );
		
		$('#editIncCathegories').click(function(){
			$("#settingsContent").load("SettingsEditIncCathegories.php");
		});
	
		$('#editExpCathegories').click(function(){
			$("#settingsContent").load("SettingsEditExpCathegories.php");
		});
		
		$('#editExpPayMeths').click(function(){
			$("#settingsContent").load("SettingsEditExpPayMeths.php");
		});
		$('#delIncome').click(function(){
			$("#settingsContent").load("SettingsDelIncomes.php");	
		});
	
		$('#delExpense').click(function(){
			$("#settingsContent").load("SettingsDelExpenses.php");
		});
	
		$('#profileDetails').click(function(){
			$("#settingsContent").load("SettingsPersonalDetails.php");
		});
	});
	</script>
	
	<style>
		
	</style>
</head>

<body>
	<div id="menu"></div>
	<div style="max-width: 1200px; margin-top: 130px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div id="content">
				<div class="row">
					<div id="editIncCathegories" class="subMenu col-xs-12 col-sm-4 col-md-2 col-md-offset-1">Kategorie przychodów</div>
					<div id="editExpCathegories" class="subMenu col-xs-12 col-sm-4 col-md-2">Kategorie wydatków</div>
					<div id="editExpPayMeths" class="subMenu col-xs-12 col-sm-4 col-md-2">Metody płatności</div>
					<div id="delIncome" class="subMenu col-xs-12 col-sm-4 col-md-2">Usuń przychód</div>
					<div id="delExpense" class="subMenu col-xs-12 col-sm-4 col-md-2">Usuń wydatek</div>
					<div id="profileDetails" class="subMenu col-xs-12 col-sm-4 col-md-2">Edytuj dane profilowe</div>
				</div>
				<div id="settingsContent" class="row">	
				</div>
			</div>	
		</div>
	</div>
	<footer>
		<div id="info">
		
		</div>
	
	</footer>
	
	
	
</body>

</html>