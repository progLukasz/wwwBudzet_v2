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
					<input type="text" name="expenseDate" placeholder="RRRR-MM-DD" onfocus="this.placeholder="" onblur="this.placeholder="RRRR-MM-DD"/> <br /> <!-- dodac aktualna date w placeholderze-->
					
					Sposób płatności:
					<select name="paymentMeth" class="styled-select">
						<option value="1">Gotówka</option>
						<option value="2">Karta debetowa</option>
						<option value="3">Karta kredytowa</option>
					</select><br />
					
					Kategoria: 
					<select name="cathegory" class="styled-select">
						<option value="1">Jedzenie</option>
						<option value="2">Mieszkanie</option>
						<option value="3">Transport</option>
						<option value="4">Telekomunikcja</option>
						<option value="5">Opieka zdrowotna</option>
						<option value="6">Ubranie</option>
						<option value="7">Higiena</option>
						<option value="8">Dzieci</option>
						<option value="9">Rozrywka</option>
						<option value="10">Wycieczka</option>
						<option value="11">Szkolenia</option>
						<option value="12">Książki</option>
						<option value="12">Oszczędności</option>
						<option value="13">Na emeryturę</option>
						<option value="14">Spłata zadłużenia</option>
						<option value="15">Darowizna</option>
						<option value="16">Inne wydatki</option>
					</select><br />
					
					Komentarz:
					<input type="text" name="comment" placeholder="opcjonalny" onfocus="this.placeholder="" onblur="this.placeholder="opcjonalny"/> <br />

					<input type="submit" Value="Dodaj" name="addToExpenses"> <br />
			
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