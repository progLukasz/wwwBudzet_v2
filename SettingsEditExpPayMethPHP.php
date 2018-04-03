<?php

	session_start();
	
	require_once "Connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	$connection = new mysqli($host, $db_user, $db_password, $db_name);
	
	$proceed = true;
	$userID = $_SESSION['userId'];
	
	if(isset($_POST['addExpPayMeth']))
	{
		$payMethName = $_POST['addExpPayMeth'];
		
		$result = $connection->query("SELECT * FROM paymentmethod WHERE Name = '$payMethName' AND UserID = '$userID' ");
		
		if ($result->num_rows > 0)
		{
			echo '<div class="error">'."Dany sposób płatności już istnieje".'</div>';
			$proceed = false;
		} else if(strlen($payMethName)<1)
		{
			echo '<div class="error">'."Nie podano nazwy nowego sposobu płatności".'</div>';
			$proceed = false;
		} else {
			$userID = $_SESSION['userId'];
			$query = "INSERT INTO paymentmethod (PayMetID, Name, UserID) VALUES (NULL, '$payMethName', '$userID')";
		}
	}
	else if(isset($_POST['changePayMethOld']))
	{
		$payMethNameID = $_POST['changePayMethOld'];
		$payMethNameNew = $_POST['changePayMethNew'];
		$result = $connection->query("SELECT * FROM paymentmethod WHERE Name = '$payMethNameNew' AND UserID = '$userID' ");
		
		if ($result->num_rows > 0)
		{
			echo '<div class="error">'."Dana nazwa sposobu płatnści już istnieje".'</div>';
			$proceed = false;
		}else if(strlen($payMethNameNew)<1)
		{
			echo '<div class="error">'."Nie podano nowej nazwy sposobu płatności".'</div>';
			$proceed = false;
		} else if($payMethNameID < 1) {
			echo '<div class="error">'."Nie wybrano sposobu płatności z listy".'</div>';
			$proceed = false;
		} else {
			$query = "UPDATE paymentmethod SET Name = '$payMethNameNew' WHERE PayMetID = '$payMethNameID'";
		}		
	}
	else if(isset($_POST['deleteExpPayMeth']))
	{
		$payMethNameID = $_POST['deleteExpPayMeth'];
		
		if($payMethNameID < 1) 
		{
			echo '<div class="error">'."Nie wybrano sposobu płatności do usunięcia".'</div>';
			$proceed = false;
		} else {
		$result = $connection->query("SELECT * FROM expenses WHERE PayMetID = '$payMethNameID' AND UserID = '$userID' ");
		
			if($result->num_rows > 0)
			{
				echo '<div class="error">'."Nie można usunąć danego sposobu płatności, gdyż jest on przypisany do co najmniej jednego wpisu.".'</div>';
				$proceed = false;
			} else {
				$query = "DELETE FROM paymentmethod WHERE PayMetID = '$payMethNameID'";
			}
			$connection->close();
		}
	}
	
	if ($proceed == true)
	{
		$_SESSION['query'] = $query;
		header('Location: Querying.php');
		exit();
	} else {
		exit();
	}
				
?>
