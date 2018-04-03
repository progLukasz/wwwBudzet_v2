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
			$resultCathegories = $connection->query("SELECT CathegoryID, Name FROM expcathegories WHERE UserID = '".$_SESSION['userId']."'");
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

<body >
	<script>
	
	//var added;
	
	$(document).ready(function() {
		
		$("#addCathegory").click(function() {
			var expCathegory = $("#expCathNew").val();
			$("#messageAdd").load("SettingsEditExpCathPHP.php", {addExpCath: expCathegory}, function() {

			}
			);
			
		});
		
		$("#editCathegory").click(function() {
			var expCathegory = $('.cathegoryEdit').find(":selected").val();
			var expCathegoryNew = $("#expCathEdit").val();
			$("#messageEdit").load("SettingsEditExpCathPHP.php", {changeExpOld: expCathegory, changeExpNew: expCathegoryNew});	
		});	
			
		$("#deleteCathegory").click(function() {
			var expCathegory = $(".cathegoryDelete").find(":selected").val();
			$("#messageDelete").load("SettingsEditExpCathPHP.php", {deleteExpCath: expCathegory});	
		});	
		
		//if (added == true)
		//{
		//$("#messageAdd").append("<span class='greetingsInfo'>Operacja przeprowadzona prawidłowo.</span>");
		//added = false;
		//}

		
	});
	</script>
	<div style="max-width: 1200px; margin-top: 40px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div class="content">
				
				<div id="newExpCathegory" class="settings">
					<div style="text-align:center;">Dodaj nową kategorię wydatków</div><br />
					<span style="font-size: 14px;">Nazwa nowej kategorii:</span>
					<input type="text" id="expCathNew" placeholder="nowa kategoria" onfocus="this.placeholder=' '" onblur="this.placeholder='nowa kategoria'"/>
					<button id="addCathegory" class="buttons" style="margin-left: 100px;">Dodaj</button>
					<div id="messageAdd" class="message"></div>
				</div><br /> <br />
			
				<div id="editExpCathegory" class="settings">
					<div style="text-align:center;">Zmień nazwę kategorii</div><br />
					<span style="font-size: 14px;">Wybierz kategorię:</span>
					<select name="cathEdit" class="cathegoryEdit styled-select">
					<?php
						foreach($data as $row)
						{
							echo '<option value="'.$row['CathegoryID'].'">'.$row['Name'].'</option>';
						}					
					?>
					</select>
					<span style="font-size: 14px;">Podaj nową nazwę:</span>
					<input type="text" id="expCathEdit" placeholder="nowa nazwa" onfocus="this.placeholder=' '" onblur="this.placeholder='nowa nazwa'"/>
					<button id="editCathegory" class="buttons" style="margin-left: 100px;">Zmień</button>
					<div id="messageEdit" class="message"></div>
				</div><br /> <br />
			
				<div id="deleteExpCathegory" class="settings">
					<div style="text-align:center;">Usuń instniejącą kategorię</div><br />
					<span style="font-size: 14px;">Wybierz kategorię, którą chesz usunąć:</span>
					<select name="cathDelete" class="cathegoryDelete styled-select">
					<?php

						foreach($data as $row)
						{
							echo '<option value="'.$row['CathegoryID'].'">'.$row['Name'].'</option>';
						}
										
					?>
					</select>
					<button id="deleteCathegory" class="buttons" style="margin-left: 100px;">Usuń</button>
					<div id="messageDelete" class="message"></div>
				</div><br /> <br />
			
			</div>
		</div>
	</div>
	
</body>
