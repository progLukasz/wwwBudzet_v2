<?php

	session_start();

	function validateDate($date, $format)
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}	
	
	function displayError($message)
	{
		$valid = false;
		$_SESSION['e_addExpense'] = $message;
		header('Location: dodaj-wydatki');
		exit();
	}
	
	if(isset($_POST['value']))
	{
		$valid = true;
		
		$_SESSION['savedValue'] = $_POST['value'];
		$_SESSION['savedPayMeth'] = $_POST['paymentMeth'];
		$_SESSION['savedCathegory'] = $_POST['cathegory'];
		$_SESSION['savedComment'] = $_POST['comment'];
		$_SESSION['savedDate']  = $_POST['expenseDate'];
		
		$cost = $_POST['value'];
		
		if(strlen($cost)<1)
		{
			displayError("Nie podano kwoty wydatku");
			$valid = false;
			$_SESSION['e_addExpense'] = "Nie podano kwoty wydatku";
			header('Location: dodaj-wydatki');
			exit();
		}
		
		if(!is_numeric($cost))
		{
			displayError("Podana kwota nie jest wartością liczbową");
		}
		
		$payMeth = $_POST['paymentMeth'];
		
		$cathegory = $_POST['cathegory'];
		
		$date = $_POST['expenseDate'];
		
		if(strlen($date)<1)
		{
			displayError("Nie podano daty");
		}
		
		if(!validateDate($date, 'Y-m-d'))
		{
			displayError("Podana data jest niepoprawna");
		}
		
		$comment = $_POST['comment'];
		
		if($valid == true) {
			
			require_once "Connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);	//funkcja ta powoduje że nie wyświetlają się żadne poufne dane podczas wyświetlania błędów
				
				try
				{
					$connection = new mysqli($host, $db_user, $db_password, $db_name);
					if($connection->connect_errno!=0)
					{
						throw new Exception(mysqli_connect_errno());
					}
					else
					{
						$result = $connection->query("INSERT INTO expenses (ID, UserID, CathegoryID, PayMetID, Value, Date, Comment) VALUES (NULL, '$userID', '$cathegory', '$payMeth', '$cost', '$date', '$comment')");	
						$connection->close();
						$_SESSION['e_main'] = '<span class="greetingsInfo">Wydatek dodano do bazy danych.</span>';
						unset($_SESSION['savedCathegory']);	
						unset($_SESSION['savedPayMeth']);	
						unset($_SESSION['savedValue']);
						unset($_SESSION['savedDate']);	
						unset($_SESSION['savedComment']);
						header('Location: dodaj-wydatki');
						exit();
					}		
				}	
				catch(Exception $e)
				{
					$_SESSION['e_main'] = '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności.</span>';
					header('Location: kontroluj-swoje-wydatki');
					exit();
				}
				} else {
				header('Location: dodaj-wydatki');
				exit();
				}
	}				
?>