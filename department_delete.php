<?php

include('db.php');
$i = $_GET['id'];
$delete = "DELETE FROM department WHERE department_id = $i";
$run_data = mysqli_query($con,$delete);

if($run_data){
	header('location:department_List.php');
	alert("DEPARTMENT DELETED SUCCESSFULLY..");
}else{
	echo "Donot Delete";
}

?>