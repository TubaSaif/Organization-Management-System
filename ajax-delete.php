<?php
include('db.php');


$id = $_POST["id"];


$sql = "DELETE FROM advance WHERE id = {$id}";

if(mysqli_query($con, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
