<?php
include('includes/header.php'); 
include('includes/navbarmanager.php'); 
include('db.php'); 
?>

<!-- CHART-->
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
                echo '<h4>'.$row.'</h4>';
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
              <div class="h5 mb-0 font-weight-bold text-gray-800">--</div>
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
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">-</div>
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

 <!-- CHART-->
  <div class="container" style="width:990px;">
   <h3>DEPARTMENTWISE EMPLOYEE</h3>  
   <div id="chart"></div>
  </div>

 </body>
</html>

<!-- CHART SCRIPT-->
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