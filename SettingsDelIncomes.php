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
			$result = $connection->query("SELECT inc.Value, inc.Date, inc.Comment, inc.ID, (SELECT Name FROM inccathegories WHERE inc.CathegoryID = CathegoryID ) cathName FROM incomes inc WHERE inc.UserID = ".$_SESSION['userId']);
			$connection->close();
				
		}
		if(!$result) throw new Exception($connection->error);
	}	
	catch(Exception $e)
	{
		echo  '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności.</span>';
	}
	
?>

<head>
	<script>
	
		$(document).ready(function(){
			$('.delete').click(function(){
				var element = this;
				var id = this.id;
				var splitId = id.split("_");

				var deleteId = splitId[1];
				 
				$.ajax({
					url: 'DelIncome.php',
					type: 'POST',
					data: { id:deleteId },
					success: function(response){

						$(element).closest('tr').css('background','green');
						$(element).closest('tr').fadeOut(800, function(){ 
							$(this).remove();
						});
					}
				 });
			});
		});
	</script>

</head>

<body>

	<form id="formExpenses" name="form" method="post" action="confirm.php" style="padding-top: 20px;">
		<div class="table-responsive-sm">
			<table class="table table-sm" id='expTable'>
			  <tr>
				<th bgcolor='green'><font color='white'>Kategoria</font></th>
				<th bgcolor='green'><font color='white'>Wartość [zł]</font></th>
				<th bgcolor='green'><font color='white'>Data</font></th>
				<th bgcolor='green'><font color='white'>Komentarz</font></th>
				<th bgcolor='green'><font color='white'>Usuń wpis</font></th>
			  </tr>
			  
				<?php
					$i = 0;
					$number = 0;
					while($row = mysqli_fetch_array($result)) {
			 
						$number++; 
						$i++;
						if($i%2)
						{
							$bg_color = "#EEEEEE";
						}
						else 
						{
							$bg_color = "#E0E0E0";
						}   
				   
						echo "<tr bgcolor=".$bg_color.">";
						echo "<td><center><Strong>".$row['cathName']."</Strong></center></td>";
						echo "<td><center><Strong>".$row['Value']."</Strong></center></td>";
						echo "<td><center><Strong>".$row['Date']."</Strong></center></td>";
						echo "<td><center><Strong>".$row['Comment']."</Strong>";
						echo "<td><div class='delete' id='del_".$row['ID']."'>Usuń</div></td>";
						echo "</tr>";
					} 
				 ?>
			</table>
		</div>
	</form>
</body>