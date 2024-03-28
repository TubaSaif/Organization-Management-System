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
    <link rel="stylesheet" href="css/form.css">
</head>
<body>

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
$eid=$emprow['empid'];
$fn=$emprow['firstname'];
$ln=$emprow['lastname'];
$cn=$emprow['cnicno'];
$add=$emprow['address'];
$ty=$emprow['type'];
$desig=$emprow['designation'];
$img=$emprow['image'];
$dep=$emprow['department'];
$gen=$emprow['gender'];
$nati=$emprow['nationality'];
$dob=$emprow['dob'];
$em=$emprow['email'];
$en=$emprow['emergencyno'];
$phone=$emprow['phone'];
$salary=$emprow['Salary'];
?>


<form action="user_update.php" method="POST" enctype="multipart/form-data">

<h4 class="modal-title text-center">Profile</h4>
</div>
<div class="modal-body">
<form action="user_update.php" method="POST" enctype="multipart/form-data">
<!--####################################################-->
<div class="form-row">
<div class="form-group col-md-4">
<label for="firstname">Employee ID</label>
<input type="text" class="form-control" name="firstname" value="<?php echo $eid ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="empid">First Name</label>
<input type="text" class="form-control" name="empid" value="<?php echo $fn ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="phone">Last Name</label>
<input type="phone" class="form-control" name="phone" value="<?php echo $ln ?>" readonly>
</div>
</div>
<!--##################################################-->
<!--####################################################-->
<div class="form-row">
<div class="form-group col-md-4">
<label for="firstname">CNIC</label>
<input type="text" class="form-control" name="firstname" value="<?php echo $cn ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="empid">Address</label>
<input type="text" class="form-control" name="empid" value="<?php echo $add ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="phone">Type</label>
<input type="phone" class="form-control" name="phone" value="<?php echo $ty ?>" readonly>
</div>
</div>
<!--##################################################-->
<!--####################################################-->
<div class="form-row">
<div class="form-group col-md-4">
<label for="firstname">Designation</label>
<input type="text" class="form-control" name="firstname" value="<?php echo $desig ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="empid">Department</label>
<input type="text" class="form-control" name="empid" value="<?php echo $dep ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="phone">Gender</label>
<input type="phone" class="form-control" name="phone" value="<?php echo $gen ?>" readonly>
</div>
</div>
<!--##################################################-->
<!--####################################################-->
<div class="form-row">
<div class="form-group col-md-4">
<label for="firstname">Nationality</label>
<input type="text" class="form-control" name="firstname" value="<?php echo $nati ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="empid">Date of Birth</label>
<input type="text" class="form-control" name="empid" value="<?php echo $dob ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="phone">Email</label>
<input type="phone" class="form-control" name="phone" value="<?php echo $em ?>" readonly>
</div>
</div>
<!--##################################################-->
<!--####################################################-->
<div class="form-row">
<div class="form-group col-md-4">
<label for="firstname">Emergency Number</label>
<input type="text" class="form-control" name="firstname" value="<?php echo $en ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="empid">Phone</label>
<input type="text" class="form-control" name="empid" value="<?php echo $phone ?>" readonly>
</div>
<div class="form-group col-md-4">
<label for="phone">Salary</label>
<input type="phone" class="form-control" name="phone" value="<?php echo $salary ?>" readonly>
</div>
</div>
<!--##################################################-->


<br>      	
<input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">
        	
</form>


</body>
</html>





<?php
include('includes/scripts.php');
include('includes/footer.php');
?>