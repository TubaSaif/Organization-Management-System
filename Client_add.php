<?php

include('db.php');

if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
	$description = $_POST['description'];
	


  	$insert_data = "INSERT INTO client(cname, ccontact , caddress, cdescription) VALUES ('$name','$contact','$address','$description')";
  	$run_data = mysqli_query($con,$insert_data);

  	if($run_data){
  		header('location:Client_List.php');
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
