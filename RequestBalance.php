<body>
	<div style="max-width: 1200px; margin-top: 130px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div id="content">
				<div class="table-responsive col-xs-12 col-sm-6">
					<table class="table">
					  <tr>
						<th bgcolor='green'><font color='white'>Kategorie przychodów</font></th>
						<th bgcolor='green'><font color='white'>Suma</font></th>
					  </tr>  
					</table>
				</div>
				<div class="canvas col-xs-12 col-sm-6"" >
					<canvas id="pie-chart-inc" width="800" height="450" style="float: left;"></canvas>
					<script>
						
						var iArray= <?php echo json_encode($cathNames); ?>;
						var jArrayStr= <?php echo json_encode($cathSummary); ?>;
						var jArray = jArrayStr.map(Number);
					
						new Chart(document.getElementById("pie-chart"), {
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
				<div style="clear:both;"></div>
				<div class="table-responsive col-xs-12 col-sm-6">
					<table class="table">
					  <tr>
						<th bgcolor='green'><font color='white'>Kategorie wydatków</font></th>
						<th bgcolor='green'><font color='white'>Suma</font></th>
					  </tr>
					  
					</table>
				</div>
				<div class="canvas col-xs-12 col-sm-6">
					<canvas id="pie-chart-inc" width="800" height="450" style="float:left;"></canvas>
					<script>
						
						var iArray= <?php echo json_encode($cathNames); ?>;
						var jArrayStr= <?php echo json_encode($cathSummary); ?>;
						var jArray = jArrayStr.map(Number);
					
						new Chart(document.getElementById("pie-chart"), {
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
				<h3>Bilans z danego okresu wynosi: </h3>
			</div>
		</div>
	</div>
</body>

			
					
					
					