<?php

	session_start();
	


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
			if(isset($_POST['id']))
			{
				$incID = $_POST['id'];
				$result = $connection->query("DELETE FROM incomes WHERE ID = '$incID'");	
				$connection->close();

			}
		}
		if(!$result) throw new Exception($connection->error);
	}	
	catch(Exception $e)
	{
		$_SESSION['e_addExpense'] = '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności.</span>';
		header('Location: kontroluj-swoje-wydatki');
		exit();
	}
				
?>