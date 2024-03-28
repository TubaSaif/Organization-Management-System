<?php

include('db.php');
$i = $_GET['id'];
$delete = "DELETE FROM employee WHERE id = $i";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:employee_List.php');
}else{
	echo "Donot Delete";
}


?>