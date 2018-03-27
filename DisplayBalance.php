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
	
	var d = new Date();
	var month = d.getMonth()+1;
	var day = d.getDate();
	var year = d.getFullYear();
		
	if(month == 1) {
		var prevMonth = 12;
		var prevYear = year - 1;
	} else {
		var prevMonth = month - 1;
		var prevYear = year;
	};
	
	$(document).ready(function() {
		$("#menu").load( "menu.html" );
		
		$('#thisMonthBal').click(function(){
			requestData('thisMonth', year + '-' + month + '-01', year + '-' + month + '-' + day);
		});
		$('#lastMonthBal').click(function(){
			requestData('lastMonth', prevYear + '-' + prevMonth + '-01', prevYear + '-' + prevMonth + '-31');
		});
		$('#thisYearBal').click(function(){
			requestData('thisYear', year + '-01-01', year + '-' + month + '-' + day);
		});
		$('#selectedDateBal').click(function() {
			$('#rowContent').load('DisplayBalance-SelectDate.php');
		});
		$('#fullBalance').click(function(){
			requestData('full', '0000-00-00', year + '-' + month + '-' + day);
		});	
	});
	
	</script>
</head>

<body>

	<div id="menu"></div>
	<div style="max-width: 1200px; margin-top: 130px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div id="content">
				<div class="row">
					<div class="subMenu col-xs-0 col-sm-0 col-md-1"></div>
					<div id="thisMonthBal" class="subMenu col-xs-12 col-sm-4 col-md-2 col-md-offset-1">Bieżący miesiąc</div>
					<div id="lastMonthBal" class="subMenu col-xs-12 col-sm-4 col-md-2">Poprzedni miesiąc</div>
					<div id="thisYearBal" class="subMenu col-xs-12 col-sm-4 col-md-2">Bieżący rok</div>
					<div id="selectedDateBal" class="subMenu col-xs-12 col-sm-4 col-md-2">Z wybranego okresu</div>
					<div id="fullBalance" class="subMenu col-xs-12 col-sm-4 col-md-2">Wszystko</div>
				</div>
				<div id="rowContent" class="row">	
				</div>
			</div>	
		</div>
	</div>
	<footer>
	<div id="info">
	
	</div>

	</footer>		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>