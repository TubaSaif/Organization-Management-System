<?php
include('db.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<!DOCTYPE html>
<html>
<head>
	<title>MONITASK</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/heading.css">
</head>
<style>
</style>

<body>

<?php
    $mrange_to = date('Y-m-d');
    $mrange_from = date('Y-m-d', strtotime('-200 day', strtotime($mrange_to)));
	
	$wrange_to = date('Y-m-d');
    $wrange_from = date('Y-m-d', strtotime('-700 day', strtotime($wrange_to)));

	$drange_to = date('Y-m-d');
    $drange_from = date('Y-m-d', strtotime('-100 day', strtotime($drange_to)));

require 'db.php';
$a=$_GET['id'];

$detail = "Select * FROM employee WHERE id = $a";
$run_data = mysqli_query($con,$detail);
$row = mysqli_fetch_assoc($run_data);
$EMPLOYEEID=$row['id'];
$name=$row['firstname'];

$attendance = "Select * FROM attendance where id = '$EMPLOYEEID' order by 1 desc";
$run = mysqli_query($con,$attendance);
$attemprow = mysqli_fetch_assoc($run);

$mattendance = "Select * FROM attendance where id = '$EMPLOYEEID' and date BETWEEN '$mrange_from' and '$mrange_to' order by 1 desc";
$mrun = mysqli_query($con,$mattendance);
$mattemprow = mysqli_fetch_assoc($mrun);


$wattendance = "Select * FROM attendance where id = '$EMPLOYEEID' and date BETWEEN '$wrange_from' and '$wrange_to' order by 1 desc";
$wrun = mysqli_query($con,$wattendance);
$wattemprow = mysqli_fetch_assoc($wrun);

$dattendance = "Select * FROM attendance where id = '$EMPLOYEEID' and date BETWEEN '$drange_from' and '$drange_to' order by 1 desc";
$drun = mysqli_query($con,$dattendance);
$dattemprow = mysqli_fetch_assoc($drun);

?>
<!-- ************************************************************** CARD ***************************************************************-->
<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="card">
<!-- ********************************************************** CARD NAVBAR ************************************************************-->
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#all" role="tab" aria-controls="description" aria-selected="true">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#month" role="tab" aria-controls="deals" aria-selected="false">Month</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#week" role="tab" aria-controls="deals" aria-selected="false">Week</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#day" role="tab" aria-controls="deals" aria-selected="false">Day</a>
            </li>
          </ul>
        </div>
<!-- ******************************************************** CARD BODY **************************************************************-->
        <div class="card-body">
         <!-- <h4 class="card-title">Bologna</h4>
          <h6 class="card-subtitle mb-2">Emilia-Romagna Region, Italy</h6>
         -->

          <div class="tab-content mt-3">
<!-- .................... ALL .........................-->
        	<div class="tab-pane active" id="all" role="tabpanel">
				<h4>Attendance:<?php echo "$name"; ?></h4>
<!-- $$$$$$$########  TABLE  ########$$$$$$$$$$$$$$$$$ -->
<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			   <th class="text-center" scope="col">S.No</th>
				<th class="text-center" scope="col">Date</th>
				<th class="text-center" scope="col">Description</th>
				<th class="text-center" scope="col">Status</th>
				<th class="text-center" scope="col">Edit</th>
				<th class="text-center" scope="col">Delete</th>
			</tr>
		</thead>
			<?php
			$i = 0;
        	while($attemprow = mysqli_fetch_assoc($run))
        	{
				if (empty($attemprow)) {
					echo "NO RECORD FOUND";
					break;
			   } else {
					
				$sl = ++$i;
				$id = $a;
				$date = $attemprow['date'];
				$des = $row['firstname'];
				$status = $attemprow['value'];


        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$date</td>
				<td class='text-left'>$des</td>
				<td class='text-left'>$status</td>

				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'>
					<i class='fa fa-pencil-square-o fa-lg'></i></a>
					</span>
          
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#del$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>
        		";
			}
        	}
        	?>			
		</table>
		<h4>Total Present:</h4>
		<h4>Total Absents:</h4>
		<h4>Points over taken sessions:</h4>
<!-- $$$$$$$########  TABLE TERMINATE ########$$$$$$$$$$$$$$$$$ -->
          	</div>

<!-- .................... MONTH ..........................................-->
<div class="tab-pane" id="month" role="tabpanel" >
              <p class="card-text">Monthwise attendance.</p>
          <!-- $$$$$$$########  TABLE  ########$$$$$$$$$$$$$$$$$ -->
<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			   <th class="text-center" scope="col">S.No</th>
				<th class="text-center" scope="col">Date</th>
				<th class="text-center" scope="col">Description</th>
				<th class="text-center" scope="col">Status</th>
				<th class="text-center" scope="col">Edit</th>
				<th class="text-center" scope="col">Delete</th>
			</tr>
		</thead>
			<?php

        	
			$i = 0;
        	while($mattemprow = mysqli_fetch_assoc($mrun))
        	{
				if (empty($mattemprow)) {
					echo "NO RECORD FOUND";
					break;
			   } else {
				$sl = ++$i;
				$id = $a;
				$date = $mattemprow['date'];
				$des = $row['firstname'];
				$status = $mattemprow['value'];


        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$date</td>
				<td class='text-left'>$des</td>
				<td class='text-left'>$status</td>

				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'>
					<i class='fa fa-pencil-square-o fa-lg'></i></a>
					</span>
          
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#del$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>
        		";
        	}
		}
        	?>			
		</table>
<!-- $$$$$$$########  TABLE TERMINATE ########$$$$$$$$$$$$$$$$$ -->
</div>
<!-- .................... WEEK ...........................................-->
            <div class="tab-pane" id="week" role="tabpanel" aria-labelledby="deals-tab">
              <p class="card-text">Attendance of this week.</p>
              <!-- $$$$$$$$$$$$########  TABLE  ########$$$$$$$$$$$$$$$$$ -->
<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			   <th class="text-center" scope="col">S.No</th>
				<th class="text-center" scope="col">Date</th>
				<th class="text-center" scope="col">Description</th>
				<th class="text-center" scope="col">Status</th>
				<th class="text-center" scope="col">Edit</th>
				<th class="text-center" scope="col">Delete</th>
			</tr>
		</thead>
			<?php

        	
			$i = 0;
        	while($wattemprow = mysqli_fetch_assoc($wrun))
        	{
				if (empty($wttemprow)) {
					echo "NO RECORD FOUND";
					break;
			   } else {
				$sl = ++$i;
				$id = $a;
				$date = $wattemprow['date'];
				$des = $row['firstname'];
				$status = $wattemprow['value'];


        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$date</td>
				<td class='text-left'>$des</td>
				<td class='text-left'>$status</td>

				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'>
					<i class='fa fa-pencil-square-o fa-lg'></i></a>
					</span>
          
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#del$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>
        		";
        	}
		}
        	?>			
		</table>
<!-- $$$$$$$########  TABLE TERMINATE ########$$$$$$$$$$$$$$$$$ -->
            </div>
<!-- .................... DAY ...........................................-->
            <div class="tab-pane" id="day" role="tabpanel" aria-labelledby="deals-tab">
              <p class="card-text">Today's attendance.</p>
<!-- $$$$$$$########  TABLE  ########$$$$$$$$$$$$$$$$$ -->
<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			    <th class="text-center" scope="col">S.No</th>
				<th class="text-center" scope="col">Date</th>
				<th class="text-center" scope="col">Description</th>
				<th class="text-center" scope="col">Status</th>
				<th class="text-center" scope="col">Edit</th>
				<th class="text-center" scope="col">Delete</th>
			</tr>
		</thead>
			<?php
			$i = 0;
        	while($dattemprow = mysqli_fetch_assoc($drun))
        	{
				if (empty($dattemprow)) {
					echo "NO RECORD FOUND";
					break;
			   } else {
				$sl = ++$i;
				$id = $a;
				$date = $dattemprow['date'];
				$des = $row['firstname'];
				$status = $dattemprow['value'];
        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$date</td>
				<td class='text-left'>$des</td>
				<td class='text-left'>$status</td>

				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'>
					<i class='fa fa-pencil-square-o fa-lg'></i></a>
					</span>
          
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#del$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>
        		";
        	}
		}
        	?>			
		</table>
<!-- $$$$$$$########  TABLE TERMINATE ########$$$$$$$$$$$$$$$$$ -->
            
            </div> 
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

</body>
</html>
<script>
$('#bologna-list a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
