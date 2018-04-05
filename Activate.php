<?php

	session_start();

	
		require_once "Connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);	//funkcja ta powoduje że nie wyświetlają się żadne poufne dane podczas wyświetlania błędów
		
		
		if (isset($_GET["token"])) {
			$token = $_GET["token"];
			
			try
			{
				$connection = new mysqli($host, $db_user, $db_password, $db_name);
				if($connection->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
				{
					$resultUnactiveUser = $connection->query("SELECT * FROM unactivatedusers WHERE Token = '$token'");
					$row = $resultUnactiveUser->fetch_assoc();
					$Login = $row['Login'];
					$Email = $row['Email'];
					$Pass = $row['Password'];
					
					if($connection->query("INSERT INTO users (UserID, Login, Email, Password, IsAdmin, Date) VALUES (NULL, '$Login', '$Email', '$Pass', 'No', NULL) "))
					{
						$connection->query("DELETE FROM unactivatedusers WHERE Token = '$token' ");
						$resultUserID = $connection->query("SELECT UserID FROM users WHERE Login = '$Login'");
						$row = $resultUserID->fetch_assoc();
						$UserID = $row['UserID'];
						$connection->query("INSERT INTO inccathegories (CathegoryID, Name, UserID) VALUES (NULL, 'Wynagrodzenie', '$UserID'), (NULL, 'Odsetki bankowe', '$UserID'), (NULL, 'Sprzedaż na allegro', '$UserID'), (NULL, 'Inne', '$UserID')");
						$connection->query("INSERT INTO expcathegories (CathegoryID, Name, UserID) VALUES (NULL, 'Jedzenie', '$UserID'), (NULL, 'Mieszkanie', '$UserID'), (NULL, 'Transport', '$UserID'), (NULL, 'Telekomunikacja', '$UserID'), (NULL, 'Opeka zdrowotna', '$UserID'), (NULL, 'Ubranie', '$UserID'), (NULL, 'Higiena', '$UserID'), (NULL, 'Dzieci', '$UserID'), (NULL, 'Rozrywka', '$UserID'), (NULL, 'Wycieczka', '$UserID'), (NULL, 'Szkolenia', '$UserID'), (NULL, 'Inne', '$UserID')");
						$connection->query("INSERT INTO paymentmethod (PayMetID, Name, UserID) VALUES (NULL, 'Gotówka', '$UserID'), (NULL, 'Karta debetowa', '$UserID'), (NULL, 'Karta kredytowa', '$UserID')");
					}
					else
					{
						throw new Exception($connection->error);
					}

				}	
				$connection->close();
			}	
			catch(Exception $e)
			{
				$_SESSION['e_server'] = '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności.</span>';
				header('Location: budzet-domowy');
				exit();
			}
			
			
			
		}
		else {
			throw new Exception("Valid token not provided.");
		}	
		header('Location: konto-aktywowane');
				exit();
?>