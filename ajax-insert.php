<?php
include('db.php');

$empid = $_POST["id"];
$amount = $_POST["amount"];
$description = $_POST["description"];
$date = $_POST["date"];


$sql = "INSERT INTO advance(id, aamount , adescription , adate) VALUES ('{$empid}','{$amount}','{$description}','{$date}')";

if(mysqli_query($con, $sql)){
  echo 1;
}else{
  echo 0;
}
?>
