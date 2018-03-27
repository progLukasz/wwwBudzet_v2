<?php
	session_start();
?>
<head>

	<script type="text/javascript">

	$(document).ready(function() {
		$("#menu").load( "menu.html" );
		
		$('#buttonDate').click(function(){
			var startDate = $('#startDateText').val();
			var endDate = $('#endDateText').val();
			requestData('selectedDate', startDate, endDate);
		});
	
	});
		
	</script>
</head>

<body>
	<div id="menu"></div>
	<div style="max-width: 1200px; margin-top: 130px; margin-left: auto; margin-right: auto; padding: 10px;">
		<div class="container-fluid">
			<div id="content">
				<div id="rowContent" class="row">
					<div id="selectDate" class="formEdit">
						Wyświetl balans z okresu <br/> 
						od:
						<input type="text" id="startDateText" placeholder="RRRR-MM-DD" onfocus="this.placeholder="" onblur="this.placeholder="RRRR-MM-DD"/>
						do:
						<input type="text" id="endDateText" placeholder="RRRR-MM-DD" onfocus="this.placeholder="" onblur="this.placeholder="RRRR-MM-DD"/> <br />
						<?php
							if(isset($_SESSION['e_selectedDate']))
							{
								echo '<div class="error">'.$_SESSION['e_selectedDate'].'</div>';
								unset($_SESSION['e_selectedDate']);
							}
							else echo '<br />';
						?>
						<input type="submit" value="Wyświetl" id="buttonDate"> <br />		
					</div>
				</div>
				
			</div>
		</div>
	<footer>
		<div id="info">
		
		</div>
	
	</footer>		
	
</body>

</html>