<?php
include('db.php');

if(isset($_POST['submit'])){
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
	$password = $_POST['firstname'];
	$cpassword = $_POST['firstname'];
	
	//image upload

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "upload_images/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}


  	$insert_data = "INSERT INTO employee (empid, Salary, firstname, lastname, cnicno, address, type, designation, image, department, gender, nationality, dob, email, emergencyno, phone,uploaded) VALUES ('$empid','$salary', '$firstname', '$lastname', '$cnicno', '$address', '$type', '$designation', '$image', '$department', '$gender', '$nationality', '$dob', '$email', '$emergencyno', '$phone',NOW())";
  	$run_data = mysqli_query($con,$insert_data);

  	if($run_data){
  		header('location:employee_Form.php');
  	}
	else{
		header('location:employee_Form.php');
		echo 'data not inserted';
	    }
	}
	
	//888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888
	$insert_register = "INSERT INTO register (id, username, email , password , confirmpassword , usertype,empid) VALUES ('$empid','$firstname', '$email', '$password', '$cpassword','employee','$empid')";
	$run_register = mysqli_query($con,$insert_register);
	//8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888

?>