<?php
include('db.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<?php
require 'db.php';
$a=$_GET['id'];

$detail = "Select * FROM department WHERE department_id = $a";
$run_data = mysqli_query($con,$detail);
$row = mysqli_fetch_assoc($run_data);
$l=$row['location'];
$n=$row['name'];
$d=$row['description'];

$emp = "Select *,COUNT(id) AS total FROM employee where department = '$n'";
$run = mysqli_query($con,$emp);
$emprow = mysqli_fetch_assoc($run);
$e=$emprow['total'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>MONITASK</title>
</head>
<style>
h3{
	color: black;
	font: Arial;
	padding: 8px;
}
</style>
<body>
<div class=container-fluid>
<div class = "content-wrapper">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
   <h1 class="h3 mb-0 text-gray-800">Department Detail </h1>
   <a href="department_List.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i 
   class="fas fa-caret-square-right"></i>-</a>
 </div>

	
<hr>
	<h3>Department Name	&nbsp &nbsp :  &nbsp<?php echo $n ?></h3>
	<h3>location &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp:  &nbsp<?php echo $l ?></h3>
	<h3>Description	&nbsp	&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp:  &nbsp<?php echo $d ?></h3>
	<h3>Total Employees	&nbsp &nbsp &nbsp &nbsp :  &nbsp<?php  echo $e ?></h3>
</div>
</div>
</body>
</html>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>