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
			$userID = $_SESSION['userId'];
			$_SESSION['query'] = "INSERT INTO incomes (ID, UserID, CathegoryID, Value, Date, Comment) VALUES (NULL, '$userID', '$cathegory', '$cost', '$date', '$comment')";
			unset($_SESSION['savedCathegory']);	
			unset($_SESSION['savedPayMeth']);	
			unset($_SESSION['savedValue']);
			unset($_SESSION['savedDate']);	
			unset($_SESSION['savedComment']);				
			header('Location: Querying.php');
			exit();
		} else {
			header('Location: dodaj-przychod');
			exit();
		}
	}				
?>