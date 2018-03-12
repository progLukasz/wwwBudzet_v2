
function requestData(period, startD, endD){
	$("#rowContent").load("RequestBalance.php", {
		sortedBy: period,
		startDate: startD,
		endDate: endD
	});	
}
