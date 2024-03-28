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


<div class="container">
<h3>Add Client</h3>


<form action="Client_add.php" method="POST" enctype="multipart/form-data">

<div class="form-row">
<div class="form-group col-md-6">
<label for="empid">Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter employee id" maxlength="15" required>
</div>
<div class="form-group col-md-6">
<label for="phone">Contact</label>
<input type="phone" class="form-control" name="contact" placeholder="Enter Mobile no." maxlength="11" required>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="firstname">Address</label>
<input type="text" class="form-control" name="address" placeholder="Enter First Name">
</div>
<div class="form-group col-md-6">
<label for="lastname">Description</label>
<input type="text" class="form-control" name="description" placeholder="Enter Last Name">
</div>
</div>
<br>      	
<input type="submit" name="submit" class="btn btn-info btn-large" value="Submit">       	
</div>       	
</form>

</div>

</div><!-- Model body -->
</div>


</form>

</body>
</html>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>