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
					$resultCathegories = $connection->query("SELECT CathegoryID, Name FROM inccathegories WHERE UserID = '".$_SESSION['userId']."'");
					
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
				<form class="formEdit" action="AddIncInstance.php" method="post" accept-charset="character_set">
				
					Kwota:
					<input type="text" name="value" value="<?php if (isset($_SESSION['savedValue'])) { echo $_SESSION['savedValue']; } unset($_SESSION['savedValue']);  ?>" placeholder="..." onfocus="this.placeholder="" onblur="this.placeholder="..."/> PLN<br />
					
					Data:
					<input type="text" name="expenseDate" value="<?php if (isset($_SESSION['savedDate'])) { echo $_SESSION['savedDate']; } unset($_SESSION['savedDate']);  ?>" placeholder="RRRR-MM-DD" onfocus="this.placeholder="" onblur="this.placeholder="RRRR-MM-DD"/> <br /> <!--wstawic tutaj dzisiejsza date - js -->
					
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
					if(isset($_SESSION['e_addIncome']))
					{
						echo '<div class="error">'.$_SESSION['e_addIncome'].'</div>';
						unset($_SESSION['e_addIncome']);
					}
					else	echo '<br />';
					?>
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