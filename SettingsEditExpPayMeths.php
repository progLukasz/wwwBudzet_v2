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
					$resultPayMets = $connection->query("SELECT PayMetID, Name FROM paymentmethod WHERE UserID = '".$_SESSION['userId']."'");
					$data   = array();
					while ($row = mysqli_fetch_assoc($resultPayMets))
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
		
		$("#addPayMeth").click(function() {
			var payMeth = $("#payMethNew").val();
			$("#messageAdd").load("SettingsEditExpPayMethPHP.php", {
				addExpPayMeth: payMeth
			});	
		});
		
		$("#editPayMeth").click(function() {
			var payMethOld = $('.payMethEdit').find(":selected").val();
			var payMethNew = $("#expPayMethEdit").val();
			$("#messageEdit").load("SettingsEditExpPayMethPHP.php", {
				changePayMethOld: payMethOld,
				changePayMethNew: payMethNew
			});	
		});	
			
		$("#deletePayMeth").click(function() {
			var payMeth = $(".payMethDelete").find(":selected").val();
			$("#messageDelete").load("SettingsEditExpPayMethPHP.php", {
				deleteExpPayMeth: payMeth
			});	
		});	
			
	});
	</script>
	<div style="max-width: 1200px; margin-top: 40px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div class="content">
				
				<div id="newExpPayMeth" class="settings">
					<div style="text-align:center;">Dodaj nowy sposób płatności</div><br />
					<span style="font-size: 14px;">Nazwa nowego sposobu płatności:</span>
					<input type="text" id="payMethNew" placeholder="nowa kategoria" onfocus="this.placeholder=' '" onblur="this.placeholder='nowa kategoria'"/>
					<button id="addPayMeth" class="buttons" style="margin-left: 100px;">Dodaj</button>
					<div id="messageAdd" class="message"></div>
				</div><br /> <br />
			
				<div id="editIncCathegory" class="settings">
					<div style="text-align:center;">Zmień nazwę kategorii</div><br />
					<span style="font-size: 14px;">Wybierz kategorię:</span>
					<select name="cathEdit" class="payMethEdit styled-select">
					<?php
						foreach($data as $row)
						{
							echo '<option value="'.$row['PayMetID'].'">'.$row['Name'].'</option>';
						}					
					?>
					</select>
					<span style="font-size: 14px;">Podaj nową nazwę:</span>
					<input type="text" id="expPayMethEdit" placeholder="nowa nazwa" onfocus="this.placeholder=' '" onblur="this.placeholder='nowa nazwa'"/>
					<button id="editPayMeth" class="buttons" style="margin-left: 100px;">Zmień</button>
					<div id="messageEdit" class="message"></div>
				</div><br /> <br />
			
				<div id="deleteIncCathegory" class="settings">
					<div style="text-align:center;">Usuń instniejącą kategorię</div><br />
					<span style="font-size: 14px;">Wybierz kategorię, którą chesz usunąć:</span>
					<select name="cathDelete" class="payMethDelete styled-select">
					<?php
						foreach($data as $row)
						{
							echo '<option value="'.$row['PayMetID'].'">'.$row['Name'].'</option>';
						}				
					?>
					</select>
					<button id="deletePayMeth" class="buttons" style="margin-left: 100px;">Usuń</button>
					<div id="messageDelete" class="message"></div>
				</div><br /> <br />
			
			</div>
		</div>
	</div>
	
</body>
