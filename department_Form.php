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
<style>
p {
  color: red;
}
</style>
<body>


<form name="myform" action="department_add.php" onsubmit="return validate()" method="POST" enctype="multipart/form-data">
<div class="container">
<h1> Department </h1>
<hr><br>
<label for="designation">Name: </label>
<input type="text" class="form-control" name="name" placeholder="Name">
<p id="nerror" ></p>

<label for="designation">Location: </label>
<input type="text" class="form-control" name="location" placeholder="Location">
<p id="lerror" ></p>

<label for="type">Description: </label>
<input type="text" class="form-control" name="description" placeholder="Enter Description">
<p id="derror" ></p>

<br><input class="btn btn-primary" type="submit" name="submit" class="btn btn-info btn-large" value="Submit">   
<br><br><br>
</div>   	
</form>

<!--************************** VALIDATION FUNCTION *****************************-->
<script type="text/javascript">




function validate() {
 var name = document.forms["myform"]["name"].value;
 if(name=="") {
  error = " *Username cannot be blank. ";
  document.getElementById( "nerror" ).innerHTML = error;
  return false;
 }
 else { 
  document.getElementById( "nerror" ).innerHTML = " ";
 }
 var location = document.forms["myform"]["location"].value;
 if(location==""){
  error = " *You Have To Write location. ";
  document.getElementById( "lerror" ).innerHTML = error;
  return false;
 }
 else {
  document.getElementById( "lerror" ).innerHTML = " ";
 }
 var description = document.forms["myform"]["description"].value;
 if(description==""){
  error = " *You Have To Write description. ";
  document.getElementById( "derror" ).innerHTML = error;
  return false;
 }
 else {
  document.getElementById( "lerror" ).innerHTML = " ";
  return true;
 }
 
}
</script>


</body>
</html>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>