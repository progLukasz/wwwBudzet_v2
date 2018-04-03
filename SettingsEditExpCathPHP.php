<?php

	session_start();
	
	require_once "Connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	$connection = new mysqli($host, $db_user, $db_password, $db_name);
	
	$proceed = true;
	$userID = $_SESSION['userId'];
	
	if(isset($_POST['addExpCath']))
	{
		$cathName = $_POST['addExpCath'];
		
		$result = $connection->query("SELECT * FROM expcathegories WHERE Name = '$cathName' AND UserID = '$userID' ");
		
		if ($result->num_rows > 0)
		{
			echo '<div class="error">'."Dana nazwa kategorii już istnieje".'</div>';
			$proceed = false;
		} else if(strlen($cathName)<1)
		{
			echo '<div class="error">'."Nie podano nazwy nowej kategorii".'</div>';
			$proceed = false;
		} else {
			$userID = $_SESSION['userId'];
			$query = "INSERT INTO expcathegories (CathegoryID, Name, UserID) VALUES (NULL, '$cathName', '$userID')";
		}
	}
	else if(isset($_POST['changeExpOld']))
	{
		$cathNameID = $_POST['changeExpOld'];
		$cathNameNew = $_POST['changeExpNew'];
		$result = $connection->query("SELECT * FROM expcathegories WHERE Name = '$cathNameNew' AND UserID = '$userID' ");
		
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
			$query = "UPDATE expcathegories SET Name = '$cathNameNew' WHERE CathegoryID = '$cathNameID'";
		}		
	}
	else if(isset($_POST['deleteExpCath']))
	{
		$cathNameID = $_POST['deleteExpCath'];
		
		$result = $connection->query("SELECT * FROM expenses WHERE CathegoryID = '$cathNameID' UserID = '$userID' ");
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
				$query = "DELETE FROM expcathegories WHERE CathegoryID = '$cathNameID'";
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





















	session_start();
	
	$userID = $_SESSION['userId'];
	$query = '';
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
			if ($result = $connection->query(sprintf("SELECT * FROM users WHERE UserID='%s'",
			 mysqli_real_escape_string($connection, $userID))))	
			{
				$row = $result->fetch_assoc();
				
				$loginNow = $row['Login'];
				$emailNow = $row['Email'];
				$passNow = $row['Password'];

				if (isset($_POST['changeLogin'])) 
				{
					$changeLogin = $_POST['changeLogin'];
					$changeLogin = htmlentities($changeLogin, ENT_QUOTES, "UTF-8");
					
					if (strlen($changeLogin)<1) 
					{
						echo '<span style="color: red;">Nie podano nowej nazwy użytkownika!</span>';
					} 
					else if ((strlen($changeLogin)>=1) && ($changeLogin == $loginNow))
					{
						echo '<span style="color: red;">Nowy login nie różni się od poprzedniego!</span>';
					} 
					else	
					{
						$query = "UPDATE users SET Login = '$changeLogin' WHERE UserID = '$userID'";
					}
				}
				else if (isset($_POST['changeEmail']))
				{
					$changeEmail = $_POST['changeEmail'];
					$changeEmail = htmlentities($changeEmail, ENT_QUOTES, "UTF-8");
					if (strlen($changeEmail)<1) 
					{
						echo '<span style="color: red;">Nie podano nowego adresu email!</span>';
					} 
					else if ((strlen($changeEmail)>=1) && ($changeEmail == $emailNow))
					{
						echo '<span style="color: red;">Nowy email nie rózni się od poprzedniego!</span>';
					} 
					else
					{	
						$emailB = filter_var($changeEmail, FILTER_SANITIZE_EMAIL);
						
						if((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB != $changeEmail))
						{
							echo '<span style="color: red;">Podaj poprawny adres email!</span>';
						} 
						else
						{	
							$query = "UPDATE users SET Email = '$changeEmail' WHERE UserID = '$userID'";
						}
					}
				}
				else if (isset($_POST['changePassNew1'])) 
				{
					$changePassOld = $_POST['changePassOld'];
					$changePassNew1 = $_POST['changePassNew1'];
					$changePassNew2 = $_POST['changePassNew2'];

					if(!(password_verify($changePassOld, $row['Password'])) || (strlen($changePassOld) < 1))
					{
						echo "Stare hasło niepoprawne!";
					}
					else
					{
						if((strlen($changePassNew1)<8) || (strlen($changePassNew1)>20))
						{
							echo "Hasło musi posiadać od 8 do 20 znaków!";
						}
						else
						{
							if($changePassNew1 != $changePassNew2)
							{
								echo "Podane hasła różnią się od siebie!";
							}	
							else
							{
							
							$hashedPassNew = password_hash($changePassNew1, PASSWORD_DEFAULT);
							$query = "UPDATE users SET Password = '$hashedPassNew' WHERE UserID = '$userID'";
							}	
						}
					}		
				}
				
				if (strlen($query)>0)
				{
					$result = $connection->query($query);
					if (isset($_POST['changeLogin'])) 
					{
						echo "Nazwa użytkownika została zminiona.";
					}
					else if (isset($_POST['changeEmail']))
					{
						echo "Adres email został zmieniony.";
					}						
					else if (isset($_POST['changePassNew1'])) 
					{
						echo "Hasło zostało zmienione.";
					}
				}		
					$connection->close();
			}
			else
			{
				throw new Exception($connection->error);
			}
		}
	}
	
	catch(Exception $e)
	{
		$_SESSION['e_main'] = '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o zalogowanie się w innym terminie.</span>';
		header('Location: budzet-domowy');
		exit();
	}	

?>