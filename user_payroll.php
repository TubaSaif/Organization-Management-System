<?php
include('db.php');
include('includes/header.php'); 
include('includes/navbaruser.php'); 
?>

<?php
    $range_to = date('m/d/Y');
    $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>

<!DOCTYPE html>
<html>
<head>
	<title>MONITASK</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  	<link rel="stylesheet" href="css/heading.css"> 
</head>
<body>

<div class="container-fluid">
<div class="content-wrapper">
<?php
require 'db.php';
$a=$_SESSION['username'];
$detail = "SELECT * FROM register WHERE email = '$a' ";
$run_data = mysqli_query($con,$detail);
$row = mysqli_fetch_assoc($run_data);
$n=$row['empid'];

$employee_detail = "SELECT * FROM employee WHERE empid = '$n' ";
$run = mysqli_query($con,$employee_detail);
$emprow = mysqli_fetch_assoc($run);
$eid=$emprow['id'];
?>
 <!-- Page Heading -->
 <div class="box-header with-border">
              <div class="pull-left">
              <h1 class="h3 mb-0 text-gray-800">Payroll : <?php echo $eid=$emprow['firstname']; ?></h1>
              </div>

              <div class="pull-right">
                <form method="POST" class="form-inline">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-13" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">&nbsp;
                  </div>
                  <a href="PayrollGenerate.php"><button type="button" class="btn btn-success btn-sm btn-flat" id="payroll"><span class="glyphicon glyphicon-print"></span> Payroll Report</button></a>&nbsp;
                  <a href="PayrollGenerate.php"><button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Payslip</button></a>&nbsp;
                </form>
              </div>
  </div>
<br><br>
<hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
                  <th>Employee Name</th>
                  <th>Employee ID</th>
                  <th>Gross</th>
                  <th>Deductions</th>
                  <th>Cash Advance</th>
                  <th>Net Pay</th>
                  <th>range</th>
			</tr>
		</thead>
    
    <?php
                  /* *******************Deductions********************** */
                    $sql = "SELECT *, SUM(damount) as total_amount FROM deduction";
                    $query = $con->query($sql);
                    $drow = $query->fetch_assoc();
                    $deduction = $drow['total_amount'];
  
                    
                    $to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }
                  /* *******************Fetch Record From Attendance********************** */
require 'db.php';
$a=$_SESSION['username'];
$detail = "SELECT * FROM register WHERE email = '$a' ";

$run_data = mysqli_query($con,$detail);
$row = mysqli_fetch_assoc($run_data);
$n=$row['empid'];

                  $sql = "SELECT * from employee where empid = '$n'";

                  $query = $con->query($sql);
                  $total = 0;
                  while($row = $query->fetch_assoc()){
                  $empid = $row['id'];
                  /* **************** Cash Advance ********************* */
                      $casql = "SELECT *, SUM(aamount) AS cashamount FROM advance WHERE id='$empid' AND adate BETWEEN '$from' AND '$to'";
                      
                      $caquery = $con->query($casql);
                      $carow = $caquery->fetch_assoc();
                      $cashadvance = $carow['cashamount'];

                      $gross = $row['Salary'] ;
                      $total_deduction = $deduction + $cashadvance;
                      $net =  $gross - $total_deduction ;
                      
                      echo "
                        <tr>
                        
                          <td>".$row['firstname']."-".$row['lastname']."</td>
                          <td>".$row['empid']."</td>
                          <td>".number_format($gross, 2)."</td>
                          <td>".number_format($deduction, 2)."</td>
                          <td>".number_format($cashadvance, 2)."</td>
                          <td>".number_format($net, 2)."</td>
                          <td>".$from."-".$to. "</td>
                        </tr>
                      ";
                  }
                  ?>
		</table>
	</div>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<script>
$(function(){
  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    console.log(range);
    window.location = 'user_payroll.php?range='+range;
  });

});
</script>

<!--*************************************Date Range Picker**************************************************************-->


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 


<script>
  
$(function() {

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range as a button
  $('#reservation').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
    },
    function (start, end,label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    }
  )

});
</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<!--*************************************Data Table**************************************************************-->
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
</script>


</body>
</html>

<?php
// include('includes/scripts.php');
include('includes/footer.php');
?>