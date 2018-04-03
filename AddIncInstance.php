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
		$_SESSION['e_addIncome'] = $message;
		header('Location: dodaj-przychod');
		exit();
	}
	
	if(isset($_POST['value']))
	{
		$valid = true;
		
		$_SESSION['savedValue'] = $_POST['value'];
		$_SESSION['savedCathegory'] = $_POST['cathegory'];
		$_SESSION['savedComment'] = $_POST['comment'];
		$_SESSION['savedDate']  = $_POST['expenseDate'];
		
		$cost = $_POST['value'];
		
		if(strlen($cost)<1)
		{
			displayError("Nie podano kwoty przychodu");
		}
		
		if(!is_numeric($cost))
		{
			displayError("Podana kwota nie jest wartością liczbową");
		}
			
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
						$result = $connection->query("INSERT INTO incomes (ID, UserID, CathegoryID, Value, Date, Comment) VALUES (NULL, '$userID', '$cathegory', '$cost', '$date', '$comment')");	
						$connection->close();
						$_SESSION['e_main'] = '<span class="greetingsInfo">Przychód dodano do bazy danych.</span>';
						unset($_SESSION['savedCathegory']);	
						unset($_SESSION['savedPayMeth']);	
						unset($_SESSION['savedValue']);
						unset($_SESSION['savedDate']);	
						unset($_SESSION['savedComment']);	
						header('Location: dodaj-przychod');
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
				header('Location: dodaj-przychod');
				exit();
				}
	}								
?>