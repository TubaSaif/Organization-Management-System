<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('db.php'); 
?>
<?php 
$DATEE=date('Y-m-d');
$s = "SELECT * from employee";
$q = $con->query($s);
while($r= $q->fetch_assoc())
{
$pre = "SELECT *, COUNT(id) AS total FROM attendance WHERE value='Present' AND date = '$DATEE' ";
$prequery = $con->query($pre);
$prerow = $prequery->fetch_assoc();
$PRESENT = $prerow['total'];

$abs = "SELECT *, COUNT(id) AS total FROM attendance WHERE value='Absent' AND date = '$DATEE' ";
$absquery = $con->query($abs);
$absrow = $absquery->fetch_assoc();
$ABSENT = $absrow['total'];
}
?>
<?php


$dataPoints = array(
	array("label"=> "Total Employees", "y"=> 8 ),
	array("label"=> "Present Employees", "y"=> $PRESENT),
	array("label"=> "Absent Employees", "y"=> $ABSENT),
	array("label"=> "Absent", "y"=> $ABSENT)
);
	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Attendance per day"
	},
	subtitles: [{
		text: "Attendance of an employees"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - .",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 