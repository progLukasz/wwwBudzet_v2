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
					$data   = array();
					while ($row = mysqli_fetch_assoc($resultCathegories))
					{
						$data[] = $row;
					}
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

<body>
	<script>
	$(document).ready(function() {
		
		$("#addCathegory").click(function() {
				var incCathegory = $("#incCathNew").val();
				$("#messageAdd").load("SettingsEditIncCathPHP.php", {
					addIncCath: incCathegory
				});	
			});
			
		$("#editCathegory").click(function() {
				var incCathegory = $("#cathegoryEdit").find(":selected").val();
				var incCathegoryNew = $("#incCathEdit").val();
				$("#messageEdit").load("SettingsEditIncCathPHP.php", {
					changeIncOld: incCathegory,
					changeIncNew: incCathegoryNew
				});	
				alert(incCathegory + ' ' + incCathegoryNew);
			});	
			
		$("#deleteCathegory").click(function() {
				var incCathegory = $("#cathegoryDelete").val();
				$("#messageDelete").load("SettingsEditIncCathPHP.php", {
					deleteIncCath: incCathegory
				});	
			});	
			
	});
	</script>
	<div style="max-width: 1200px; margin-top: 40px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div class="content">
				
				<div id="newIncCathegory" class="settings">
					<div style="text-align:center;">Dodaj nową kategorię przychodów</div><br />
					<span style="font-size: 14px;">Nazwa nowej kategorii:</span>
					<input type="text" id="incCathNew" placeholder="nowa kategoria" onfocus="this.placeholder=' '" onblur="this.placeholder='nowa kategoria'"/>
					<button id="addCathegory" class="buttons" style="margin-left: 100px;">Dodaj</button>
					<?php
						if(isset($_SESSION['e_addCath']))
						{
						echo '<div class="error">'.$_SESSION['e_addCath'].'</div>';
						unset($_SESSION['e_addCath']);
						}
						else	echo '<br />';
					?>
					<div id="messageAdd" class="message"></div>
				</div><br /> <br />
			
				<div id="editIncCathegory" class="settings">
					<div style="text-align:center;">Zmień nazwę kategorii</div><br />
					<span style="font-size: 14px;">Wybierz kategorię:</span>
					<select name="cathegoryEdit" class="styled-select">
					<?php
						foreach($data as $row)
						{
							echo '<option value=" '.$row['CathegoryID'].' "> '.$row['Name'].' </option>';
						}					
					?>
					</select>
					<span style="font-size: 14px;">Podaj nową nazwę:</span>
					<input type="text" id="incCathEdit" placeholder="nowa nazwa" onfocus="this.placeholder=' '" onblur="this.placeholder='nowa nazwa'"/>
					<button id="editCathegory" class="buttons" style="margin-left: 100px;">Zmień</button>
					<?php
						if(isset($_SESSION['e_editCath']))
						{
						echo '<div class="error">'.$_SESSION['e_editCath'].'</div>';
						unset($_SESSION['e_editCath']);
						}
						else	echo '<br />';
					?>
					<div id="messageEdit" class="message"></div>
				</div><br /> <br />
			
				<div id="setLogin" class="settings">
					<div style="text-align:center;">Usuń instniejącą kategorię</div><br />
					<span style="font-size: 14px;">Wybierz kategorię, którą chesz usunąć:</span>
					<select name="cathegoryDelete" class="styled-select">
					<?php

						foreach($data as $row)
						{
							echo '<option value=" '.$row['CathegoryID'].' "> '.$row['Name'].' </option>';
						}
										
					?>
					</select>
					<button id="deleteCathegory" class="buttons" style="margin-left: 100px;">Usuń</button>
					<?php
						if(isset($_SESSION['e_delCath']))
						{
						echo '<div class="error">'.$_SESSION['e_delCath'].'</div>';
						unset($_SESSION['e_delCath']);
						}	
						else	echo '<br />';
					?>
					<div id="messageDelete" class="message"></div>
				</div><br /> <br />
			
			</div>
		</div>
	</div>
	
</body>
