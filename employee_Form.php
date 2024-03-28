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
    <link rel="stylesheet" href="css/form.css">
</head>
<body>

<form action="employee_add.php" method="POST" enctype="multipart/form-data">

<h4 class="modal-title text-center">Add Employee</h4>
</div>
<div class="modal-body">
<form action="add.php" method="POST" enctype="multipart/form-data">

<div class="form-row">
<div class="form-group col-md-6">
<label for="empid">Employee Id.</label>
<input type="text" class="form-control" name="empid" placeholder="Enter employee id" maxlength="15" required>
</div>
<div class="form-group col-md-6">
<label for="phone">Mobile No.</label>
<input type="phone" class="form-control" name="phone" placeholder="Enter Mobile no." maxlength="11" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="firstname">First Name</label>
<input type="text" class="form-control" name="firstname" placeholder="Enter First Name">
</div>
<div class="form-group col-md-6">
<label for="lastname">Last Name</label>
<input type="text" class="form-control" name="lastname" placeholder="Enter Last Name">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="department">Department</label>
<select name="department">
  <?php
  $query = "SELECT * FROM department ORDER BY department_id";
  $query_run = mysqli_query($con,$query);
  while($row=mysqli_fetch_array($query_run))
  {
  ?>
  <option><?php echo $row["name"];?></option>
    <?php
    }
    ?> 
</select>
</div>
<div class="form-group col-md-6">
<label for="designation">Designation</label>
<input type="text" class="form-control" name="designation" placeholder="">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="email">Email Id</label>
<input type="email" class="form-control" name="email" placeholder="Enter Email id">
</div>
<div class="form-group col-md-6">
<label for="emergencyno">Emergency Number</label>
<input type="text" class="form-control" name="emergencyno" placeholder="Enter emergency number">
</div>
</div>


<div class="form-row">
<div class="form-group col-md-6">
<label for="inputState">Gender</label>
<select id="inputState" name="gender" class="form-control">
  <option selected>Choose...</option>
  <option>Male</option>
  <option>Female</option>
  <option>Other</option>
</select>
</div>
<div class="form-group col-md-6">
<label for="dob">Date of Birth</label>
<input type="date" class="form-control" name="dob" placeholder="Date of Birth">
</div>
</div>


<div class="form-group">
<label for="address">Address</label>
    <textarea class="form-control" name="address" rows="3"></textarea>
</div>


<div class="form-group">
<label for="type">Type</label>
<input type="text" class="form-control" name="type" placeholder="Enter type">
</div>

<div class="form-row">
<div class="form-group col-md-7">
<label for="cnicno">CNIC No</label>
<input type="text" class="form-control" name="cnicno">
</div>
<div class="form-group col-md-5">
<label for="inputState">Nationality</label>
<select name="nationality" class="form-control">
  <option selected>Choose...</option>
  <option value="Pakistani">Pakistani</option>
</select>
</div>
</div>		

<div class="form-group">
        <label>Image</label>
        <input type="file" name="image" class="form-control" >
</div>

<div class="form-group col-md-6">
<label for="lastname">Salary</label>
<input type="text" class="form-control" name="salary" placeholder="Enter Salary">
</div>

<br>      	
<input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">
        	
</form>


</body>
</html>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>