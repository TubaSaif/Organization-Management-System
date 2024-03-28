<?php
include('db.php');


$id = $_POST["id"];
$amount = $_POST["amount"];
$description = $_POST["description"];
$date = $_POST["date"];


$sql = "UPDATE advance SET adate = '{$date}', aamount = '{$amount}', adescription = '{$description}' WHERE id = {$id}";

if(mysqli_query($con, $sql)){
  echo 1;
}else{
  echo 0;
}

?>
