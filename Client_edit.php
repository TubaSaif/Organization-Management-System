<?php

include('db.php');

if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$location = $_POST['location'];
	$description = $_POST['description'];
	


  	$insert_data = "INSERT INTO department(name, location, description) VALUES ('$name','$location','$description')";
  	$run_data = mysqli_query($con,$insert_data);

  	if($run_data){
  		header('location:department.php');
          echo "successful";
		  ?>
		  <script>
			  alert("Added");
		  </script>
  <?php	}else{
  		echo "Data not insert";
  	}
}
?>
