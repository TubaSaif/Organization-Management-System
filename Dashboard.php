<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('db.php'); 
?>
                <?php
                $query = "SELECT * FROM employee ORDER BY id";
                $query_run = mysqli_query($con,$query);
                $row = mysqli_num_rows($query_run);
                ?>
<!--+++++++++ ATTENDANCE CHART +++++++++++++-->
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
$dataPoints = array(
	array("label"=> "Total Employees", "y"=> $row ),
	array("label"=> "Present Employees", "y"=> $PRESENT),
	array("label"=> "Absent Employees", "y"=> $ABSENT),
	array("label"=> "Absent", "y"=> $ABSENT)
);	
?>

<!-- DEP CHART-->
<?php 
$sql = "SELECT * from department";

$query = $con->query($sql);
$chart_data = '';
while($row = $query->fetch_assoc())
{
$depname = $row['name'];

$casql = "SELECT *, COUNT(id) AS total,department FROM employee WHERE department='$depname' ";
$caquery = $con->query($casql);
$carow = $caquery->fetch_assoc();
$cashadvance = $carow['total'];
$chart_data .= "{ department:'".$row['name']."', employee :".$cashadvance."}, ";
}
?>

 
<!-- $dquery = "SELECT * FROM department";
$dresult = mysqli_query($con, $dquery);
$drow = mysqli_fetch_array($dresult);

$query = "SELECT * FROM employee";
$result = mysqli_query($con, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $drow = mysqli_fetch_array($dresult);
 $chart_data .= "{ department:'".$drow["name"]."', employee :".$row["id"]."}, ";
} -->

<!-- / CHART-->

<!DOCTYPE html>
<html>
 <head>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
 </head>
 <body>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- ----------- -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Employee</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $query = "SELECT * FROM employee ORDER BY id";
                $query_run = mysqli_query($con,$query);
                $row = mysqli_num_rows($query_run);
                echo $row;
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ------------------------ -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Present Employees</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php
                $d=date('Y-m-d');
                $query = "SELECT * FROM attendance where date='$d' and value='Present' ORDER BY id";
                $query_run = mysqli_query($con,$query);
                $row = mysqli_num_rows($query_run);

                echo '<h4>'.$row.'</h4>';
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-male fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- -------------------- -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Late</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                <?php
                $d=date('Y-m-d');
                $query = "SELECT * FROM attendance where date='$d' and value='Absent' ORDER BY id";
                $query_run = mysqli_query($con,$query);
                $row = mysqli_num_rows($query_run);

                echo '<h4>'.$row.'</h4>';
                ?>
                </div>
                
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-tag fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- --------------------- -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Departments</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                $query = "SELECT * FROM department ORDER BY department_id";
                $query_run = mysqli_query($con,$query);
                $row = mysqli_num_rows($query_run);
                echo '<h4>'.$row.'</h4>';
                ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-home fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- / Content Row -->
<!-- ATT CHART+++++++++++++++++++++++++++++++++++++=-->
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
		indexLabel: "{label} - #percent%",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script> <div id="chartContainer" style="height: 370px; width: 100%;"></div>
 <!-- DEP CHART-->
  <br><br><div class="container" style="height: 370px; width: 100%; background:white">
   <h4 style="color:black; font-family: fantacy;"><b>DEPARTMENTWISE EMPLOYEE</b></h4>  
   <div id="chart" ></div>
  </div><br><br>

 
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>

<!-- DEP CHART SCRIPT-->
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'department',
 ykeys:['employee'],
 labels:['Employees'],
 hideHover:'auto',
 stacked:true,
 resize:true,
});
</script>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>