<?php

	session_start();
			
			
	if(!isset($_SESSION['logged']))		
	{
		header('Location: budzet-domowy');
		exit();
	}		
		
	require_once "Connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);	
	try
			{
				$connection = new mysqli($host, $db_user, $db_password, $db_name);

				if($connection->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
				{
					$resultPayMethods = $connection->query("SELECT PayMetID, Name FROM paymentmethod WHERE UserID = '".$_SESSION['userId']."'");
					$resultCathegories = $connection->query("SELECT CathegoryID, Name FROM expcathegories WHERE UserID = '".$_SESSION['userId']."'");
					
					$connection->close();
				}
				
			}
			
			catch(Exception $e)
			{
				$_SESSION['e_server'] = '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o zalogowanie się w innym terminie.</span>';
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css" text/css" />
	
	<script type="text/javascript">
		$(document).ready(function() {
			$("#menu").load( "menu.html" );
			
			$( function() {
				$("#datepicker").datepicker({
					dateFormat: "yy-mm-dd"
				});
			});

		});
	</script>
</head>

<body>
	<div id="menu"></div>
	<div style="max-width: 1200px; margin-top: 40px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div class="content">
				<div class="title">Dodaj wydatek</div>
				<form class="formEdit" action="AddExpInstance.php" method="post" accept-charset="character_set">
		
					Kwota:
					<input type="text" name="value" value="<?php if (isset($_SESSION['savedValue'])) { echo $_SESSION['savedValue']; } unset($_SESSION['savedValue']);  ?>" placeholder="..." onfocus="this.placeholder="" onblur="this.placeholder="..."/> PLN<br />
					
					Data:
					<input type="text" id="datepicker" name="expenseDate" value="<?php if (isset($_SESSION['savedDate'])) { echo $_SESSION['savedDate']; } unset($_SESSION['savedDate']);  ?>" placeholder="RRRR-MM-DD" onfocus="this.placeholder="" onblur="this.placeholder="RRRR-MM-DD"/> <br /> <!-- dodac aktualna date w placeholderze-->
					
					Sposób płatności:
					<select name="paymentMeth" class="styled-select">
						<?php
											
						if (isset($_SESSION['savedPayMeth']))
						{
							while($row = mysqli_fetch_array($resultPayMethods))
							{
								echo '<option value="'.$row['PayMetID'].'"';
								if( $_SESSION['savedPayMeth'] == $row['PayMetID'])
								{ 
									echo ' selected ';
								};
								echo '>'.$row['Name'].'</option>';
							}
						} else {
							while($row = mysqli_fetch_array($resultPayMethods))
							{
								echo '<option value=" '.$row['PayMetID'].' "> '.$row['Name'].' </option>';
							}	
						}	
						unset($_SESSION['savedPayMeth']);		
						?>
					</select><br />
					
					Kategoria: 
					<select name="cathegory" class="styled-select">
						<?php
						if (isset($_SESSION['savedCathegory']))
						{
							while($row = mysqli_fetch_array($resultCathegories))
							{
								echo '<option value="'.$row['CathegoryID'].'"';
								if( $_SESSION['savedCathegory'] == $row['CathegoryID'])
								{ 
									echo ' selected ';
								};
								echo '>'.$row['Name'].'</option>';
							}
						} else {
							while($row = mysqli_fetch_array($resultCathegories))
							{
								echo '<option value=" '.$row['CathegoryID'].' "> '.$row['Name'].' </option>';
							}	
						}
						unset($_SESSION['savedCathegory']);		
						?>
					</select><br />
					
					Komentarz:
					<input type="text" name="comment" value="<?php if (isset($_SESSION['savedComment'])) { echo $_SESSION['savedComment']; } unset($_SESSION['savedComment']);  ?>" placeholder="opcjonalny" onfocus="this.placeholder="" onblur="this.placeholder="opcjonalny"/> <br />
					<?php
					if(isset($_SESSION['e_addExpense']))
					{
						echo '<div class="error">'.$_SESSION['e_addExpense'].'</div>';
						unset($_SESSION['e_addExpense']);
					}
					else	echo '<br />';
					?>
					<input type="submit" Value="Dodaj" name="addToExpenses">
					<a href="kontroluj-swoje-wydatki" class="buttons"> Cancel </a>
				</form>
				
				<?php
					if(isset($_SESSION['e_main']))
					{
						echo "<div class='message'>".$_SESSION['e_main']."</div>";
						unset($_SESSION['e_main']);
					}
					else	echo '<br />';
					?>
			</div>
		</div>	
	</div>
	<footer>
		<div id="info"> 2018 &copy; Łukasz Wojciech - Budżet Domowy. lukasz.wojciech.programista@gmail.com</div>
	</footer>
</body>
</html>