<?php
include('db.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>
<style>
.card {
  /* Add shadows to create the "card" effect */
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}
</style>

<!DOCTYPE html>
<html>
<head>
	<title>MONITASK</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/depcardstyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,600;1,200;1,400;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/heading.css">
</head>
<body>

 
 

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex gap-2 align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Department</h1>
    <a href="department_Form.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> Add Department</a>
  </div>
    <div class = "row mt-4">
<?php


$query = "Select * FROM department";
$query_run = mysqli_query($con, $query);
$check_department = mysqli_num_rows($query_run)>0;
if($check_department)
{
  while($row = mysqli_fetch_assoc($query_run))
{
  $id=$row['department_id'];
?>
  <div class = "col-md-3 mt-3">
  <div class="card border-left-primary shadow h-100 py-2">
      <div class ="card-body" >

        <a href='department_detail.php?id=<?php echo $id; ?>'>
        <h3 class="card-title"> <?php echo $row['name']; ?> </h3>
        </a>
        <h4 class="card-title"> <?php echo $row['location']; ?> </h4>
        <p class="card-text">
          <?php echo substr($row['description'], 0, 50) ?>
        </p>
        <i class="material-icons" style="font-size:20px;color:rgb(0, 153, 255);">edit</i>
        <a href='department_delete.php?id=<?php echo $id; ?>'>
        <i class="material-icons" style="font-size:20px;color:rgb(0, 153, 255);">delete</i>
        </a>

        

</div>
</div>
</div>
<?php
}
}
else
{
  echo "no department found";
}
?>
</div>
</div>

</body>
</html>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>