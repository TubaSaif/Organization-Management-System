<?php
include('db.php');
include('includes/header.php'); 
include('includes/navbaruser.php'); 
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
    <link rel="stylesheet" href="css/attendance.css">
    <link rel="stylesheet" href="css/heading.css">
</head>

<body>
<div class="container-fluid">
<?php
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
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Attendance:<?php echo $eid=$emprow['firstname']; ?></h1>
    
  </div>
<br>
</a>
<!--****************************************** Take Attendance *************************************************-->
<form method="POST">
<table id="myTable">
<thead>
  <tr>
    <th>Date</th>
    <th>Status</th>
    <th>Time in</th> 
    <th>Time out</th> 
  </tr>
</head>
<tbody>
<?php
$a=$_SESSION['username'];
$detail = "SELECT * FROM register WHERE email = '$a' ";
$run_data = mysqli_query($con,$detail);
$row = mysqli_fetch_assoc($run_data);
$n=$row['empid'];

$employee_detail = "SELECT * FROM employee WHERE empid = '$n' ";
$run = mysqli_query($con,$employee_detail);
$emprow = mysqli_fetch_assoc($run);
$eid=$emprow['id'];

$employee_detaila = "SELECT * FROM attendance WHERE id = '$eid' ";
$result=$con->query($employee_detaila);


while($show=$result->fetch_assoc()){
?>


  <tr>
    <td><?php echo $show['date']?></td>
    <td><?php echo $show['value']?></td>
    <td><?php echo $show['timein']?></td>
    <td><?php echo $show['timeout']?></td>
    
  </tr>

<?php 
} 
?>
<tbody>

</table>
</form>
</div>




<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
</script>

</body>
</html>

<?php
//include('includes/scripts.php'); 
include('includes/footer.php');
?>