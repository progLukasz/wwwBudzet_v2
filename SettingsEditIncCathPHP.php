<?php

	session_start();
	
	require_once "Connect.php";
	include "phpFunctions.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	$connection = new mysqli($host, $db_user, $db_password, $db_name);
	
	$proceed = true;
	$userID = $_SESSION['userId'];
	
	if(isset($_POST['addIncCath']))
	{
		$cathName = $_POST['addIncCath'];
		
		$result = $connection->query("SELECT Name FROM inccathegories WHERE UserID = '$userID' ");
		
		if(strlen($cathName)<1)
		{
			echo '<div class="error">'."Nie podano nazwy nowej kategorii".'</div>';
			$proceed = false;
		} elseif ($result->num_rows > 0)
		{
			while($row = mysqli_fetch_assoc($result)) {
				$cmpResult = compareStrings($cathName, $row['Name']);
				if ($cmpResult == 0)
				{
					echo '<div class="error">'."Dana nazwa kategorii już istnieje".'</div>';
					$proceed = false;
					break;
				}
			}
		} 
		
		if ($proceed == true)
		{
			$userID = $_SESSION['userId'];
			$query = "INSERT INTO inccathegories (CathegoryID, Name, UserID) VALUES (NULL, '$cathName', '$userID')";
		}
	}
	else if(isset($_POST['changeIncOld']))
	{
		$cathNameID = $_POST['changeIncOld'];
		$cathNameNew = $_POST['changeIncNew'];
		$result = $connection->query("SELECT * FROM inccathegories WHERE Name = '$cathNameNew' AND UserID = '$userID' ");
		
		if ($result->num_rows > 0)
		{
			echo '<div class="error">'."Dana nazwa kategorii już istnieje".'</div>';
			$proceed = false;
		}else if(strlen($cathNameNew)<1)
		{
			echo '<div class="error">'."Nie podano nowej nazwy kategorii".'</div>';
			$proceed = false;
		} else if($cathNameID < 1) {
			echo '<div class="error">'."Nie wybrano kategorii z listy".'</div>';
			$proceed = false;
		} else {
			$query = "UPDATE inccathegories SET Name = '$cathNameNew' WHERE CathegoryID = '$cathNameID'";
		}		
	}
	else if(isset($_POST['deleteIncCath']))
	{
		$cathNameID = $_POST['deleteIncCath'];
		
		$result = $connection->query("SELECT * FROM incomes WHERE CathegoryID = '$cathNameID' UserID = '$userID' ");
		if($result->num_rows > 0)
		{
			echo '<div class="error">'."Nie można usunąć danej kategorii, gdyż jest ona przypisana do co najmniej jednego wpisu.".'</div>';
			$proceed = false;
		} else {
			if($cathNameID < 1) 
			{
				echo '<div class="error">'."Nie wybrano kategorii do usunięcia".'</div>';
				$proceed = false;
			} else {
				$query = "DELETE FROM inccathegories WHERE CathegoryID = '$cathNameID'";
			}
		}
		$connection->close();
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




