<?php

	session_start();

	require_once "Connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);	//funkcja ta powoduje że nie wyświetlają się żadne poufne dane podczas wyświetlania błędów

	$sortedBy = $_POST['sortedBy'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	
	function validateDate($date, $format)
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	
	if ($sortedBy == 'selectedDate' AND ($startDate == '' OR $endDate == '' OR $startDate > $endDate OR !validateDate($startDate, 'Y-m-d') OR  !validateDate($endDate, 'Y-m-d')) )
	{
		$_SESSION['e_selectedDate'] = "Wprowadzono zły przedział czasowy";
		header('Location: DisplayBalance-SelectDate.php');
		exit();
	}
		
	try
	{
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		if($connection->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			$resultExp = $connection->query("SELECT cat.Name, SUM(exp.Value) Sum FROM expenses exp NATURAL JOIN expcathegories cat WHERE CathegoryID IN (SELECT CathegoryID FROM expcathegories WHERE UserID = ".$_SESSION['userId'].") AND Date BETWEEN '$startDate' AND '$endDate' GROUP BY exp.CathegoryID");
			
			$resultInc = $connection->query("SELECT cat.Name, SUM(inc.Value) Sum FROM incomes inc NATURAL JOIN inccathegories cat WHERE CathegoryID IN (SELECT CathegoryID FROM inccathegories WHERE UserID = ".$_SESSION['userId'].") AND Date BETWEEN '$startDate' AND '$endDate' GROUP BY inc.CathegoryID");	
			
			$resultBalance = $connection->query("SELECT(SELECT SUM(Value)  FROM incomes WHERE UserID = ".$_SESSION['userId']." AND Date BETWEEN '$startDate' AND '$endDate') - (SELECT SUM(Value)  FROM expenses WHERE UserID = ".$_SESSION['userId']." AND Date BETWEEN '$startDate' AND '$endDate')");
			
			$connection->close();
				
		}		
		$resultBalanceFirstRow = $resultBalance->fetch_row();
		$totalBalance =$resultBalanceFirstRow[0];
		if(!$resultExp) throw new Exception($connection->error);
		if(!$resultInc) throw new Exception($connection->error);
	}	
	catch(Exception $e)
	{
		echo  '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności.</span>';
	}
	
?>

<body>
	<div style="max-width: 1200px; margin-top: 130px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div id="content">
			
				<div class="table-responsive col-xs-12 col-sm-6">
					<table class="table">
						<tr>
							<th bgcolor='green'><center><strong><font color='white'>Kategorie przychodów</font></strong></center></th>
							<th bgcolor='green'><center><strong><font color='white'>Suma</font></strong></center></th>
						</tr>
						<?php
							$i = 0;
							$number = 0;
							$iteration = 0;
							while($row = mysqli_fetch_array($resultInc)) {
					 
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
								echo "<td><center><strong>".$row['Name']."</strong></center></td>";
								echo "<td><center><strong>".$row['Sum']."</strong></center></td>";
								echo "</tr>";
								
								$incNames[$iteration] =$row['Name'];
								$incValues[$iteration] = $row['Sum'];
								$iteration = $iteration + 1;
							} 								
						 ?>					  
					</table>
				</div>
				<div class="canvas col-xs-12 col-sm-6" style="float: left;">
					<canvas id="pie-chart-inc" width="800" height="450">pipa</canvas>
					<script>
						
						var iArray= <?php echo json_encode($incNames); ?>;
						var jArrayStr= <?php echo json_encode($incValues); ?>;
						var jArray = jArrayStr.map(Number);
					
						new Chart(document.getElementById("pie-chart-inc"), {
							type: 'pie',
							data: {
							  labels: iArray,
							  datasets: [{
								label: 'Przychody wg kategorii [zł]',
								backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#30952d", "#0d1bbc","#fc0724","#d861ca","#b7aa58","#346d40","#e0a34e","#43a0a0","#938d14","#921414"],
								data: jArray
							  }]
							},
							options: {
							  title: {
								display: true,
								text: 'Przychody wg kategorii [zł]'
							  }
							}
						});
					</script>
				</div>
				<div style="clear:both; margin-bottom: 20px;"></div>
				<div class="table-responsive col-xs-12 col-sm-6">
					<table class="table">
					  <tr>
						<th bgcolor='green'><center><strong><font color='white'>Kategorie wydatków</font></strong></center></th>
						<th bgcolor='green'><center><strong><font color='white'>Suma</font></strong></center></th>
					  </tr>
					  <?php
							$i = 0;
							$number = 0;
							$iteration = 0;
							while($row = mysqli_fetch_array($resultExp)) {
					 
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
								echo "<td><center><strong>".$row['Name']."</strong></center></td>";
								echo "<td><center><strong>".$row['Sum']."</strong></center></td>";
								echo "</tr>";
								
								$expNames[$iteration] =$row['Name'];
								$expValues[$iteration] = $row['Sum'];
								$iteration = $iteration + 1;
							} 
						 ?>	
					  
					</table>
				</div>
				<div class="canvas col-xs-12 col-sm-6" style="float:left;">
					<canvas id="pie-chart-exp" width="800" height="450"></canvas>
					<script>
						
						var iArray= <?php echo json_encode($expNames); ?>;
						var jArrayStr= <?php echo json_encode($expValues); ?>;
						var jArray = jArrayStr.map(Number);
					
						new Chart(document.getElementById("pie-chart-exp"), {
							type: 'pie',
							data: {
							  labels: iArray,
							  datasets: [{
								label: 'Wydatki wg kategorii [zł]',
								backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#30952d", "#0d1bbc","#fc0724","#d861ca","#b7aa58","#346d40","#e0a34e","#43a0a0","#938d14","#921414"],
								data: jArray
							  }]
							},
							options: {
							  title: {
								display: true,
								text: 'Wydatki wg kategorii [zł]'
							  }
							}
						});
					</script>
				</div>	
				<h3>Bilans z danego okresu wynosi: <?php echo $totalBalance; ?> </h3>
				
			</div>
		</div>
	</div>
</body>

			
					
					
					