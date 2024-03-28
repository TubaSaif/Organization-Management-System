<?php
include('db.php');

$id = $_GET['id'];

if(isset($_POST['submit']))
{
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$cnicno = $_POST['cnicno'];
	$address = $_POST['address'];
	$type = $_POST['type'];
	$designation = $_POST['designation'];
	$department = $_POST['department'];
	$gender = $_POST['gender'];
	$nationality = $_POST['nationality'];
	$dob = $_POST['dob'];
	$email = $_POST['email'];
	$emergencyno = $_POST['emergencyno'];
	$phone = $_POST['phone'];
	$salary = $_POST['salary'];
	$empid = $_POST['empid'];
	
	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "upload_images/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

	$update = "UPDATE employee SET firstname='$firstname', Salary ='$salary', lastname = '$lastname', cnicno = '$cnicno', address = '$address', type = '$type', designation = '$designation', department = '$department', nationality = '$nationality', gender = '$gender', dob = '$dob', email = '$email', emergencyno = '$emergencyno', phone = '$phone', empid = '$empid', image = '$image' WHERE id=$id ";
	$run_update = mysqli_query($con,$update);

	if($run_update){
		header('location:employee_List.php');
	}else{
		echo "Data not update";
	}
}

?>