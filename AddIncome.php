
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
	<div style="max-width: 1200px; margin-top: 40px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div class="content">
				<form class="formEdit" action="AddDBInstance.php" method="post" accept-charset="character_set">
				
					Kwota:
					<input type="text" name="value" placeholder="..." onfocus="this.placeholder="" onblur="this.placeholder="..."/> PLN<br />
					
					Data:
					<input type="text" name="expenseDate" placeholder="RRRR-MM-DD" onfocus="this.placeholder="" onblur="this.placeholder="RRRR-MM-DD"/> <br /> <!--wstawic tutaj dzisiejsza date - js -->
					
					Kategoria: 
					<select name="cathegory" class="styled-select">
						<option value="1">Wynagrodzenie</option>
						<option value="2">Odsetki bankowe</option>
						<option value="3">Sprzedaż na allegro</option>
						<option value="4">Inne</option>
					</select><br />
					
					Komentarz:
					<input type="text" name="comment" placeholder="opcjonalny" onfocus="this.placeholder="" onblur="this.placeholder="opcjonalny"/> <br />
					
					<input type="submit" Value="Dodaj" name="addToIncomes"> <br />
					
				</form>
			</div>
		</div>
	</div>
	
	<footer>
		<div id="info">
		
		</div>
	
	</footer>
	
	
	
</body>

</html>