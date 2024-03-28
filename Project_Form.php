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
<body>

<form action="depadd.php" method="POST" enctype="multipart/form-data">
<div class="container">
<h3> Department </h3>
<label for="designation">Name: </label>
<input type="text" class="form-control" name="name" placeholder="">

<label for="designation">Location: </label>
<input type="text" class="form-control" name="location" placeholder="">

<label for="type">Description: </label>
<input type="text" class="form-control" name="description" placeholder="Enter Description">

<br>
<input class="btn btn-primary" type="submit" name="ADD" class="btn btn-info btn-large" value="Submit">   

<br><br><br>

</div>   	
</form>

</body>
</html>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>