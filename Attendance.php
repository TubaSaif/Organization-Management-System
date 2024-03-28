<?php
include('db.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>
<!DOCTYPE html>
<html>

<head>
	<title>MONITASK</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/attendance.css">
    <link rel="stylesheet" href="css/heading.css">
</head>

<body>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Attendance</h1>
    <a href="employee_Form.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus fa-sm text-white-50"></i> View Attendance</a>
  </div>
<br>
</a>
<!--****************************************** Take Attendance *************************************************-->
<form method="POST">
<table id="myTable">
<thead>
  <tr>
    <th>Name</th>
    <th>Emloyee ID</th>
    <th>Status</th>
    <th>Time in</th> 
    <th>Time out</th> 
  </tr>
</head>
<tbody>
<?php
$query= "select * from employee";
$result=$con->query($query);
while($show=$result->fetch_assoc()){
?>


  <tr>
  
  <td><a href='Particular_Attendance.php?id=<?php echo $show['id'] ?>'><?php echo $show['firstname']?></a></td>
    <td><?php echo $show['empid']?></td>
    <td>
        Present <input required type="radio" name="attendance[<?php echo $show['id']?>]" value="Present">
        Absent<input required type="radio" name="attendance[<?php echo $show['id']?>]" value="Absent" type="text">
    </td>
    <td>
        <input  type="time" name="ti[<?php echo $show['id']?>]">
    </td>
    <td>
        <input  type="time" name="to[<?php echo $show['id']?>]">
    </td>
  </tr>

<?php } 
?>
<tbody>


<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
  $att = $_POST['attendance'];
  $date= date('Y-m-d');
  

  $query = "select distinct date from attendance";
  $result= $con->query($query);
  $b= false;
  if($result->num_rows>0){
  while($check=$result->fetch_assoc()){
    if($date==$check['date']){
    $b= true;
    echo "<div class='alert alert-danger'>
      
      Attendance already taken today.;

    </div>";
    }
    }
  }
    if(!$b){
      foreach($att as $key => $value){
    
        if($value=="Present"){

          $query="insert into attendance(value,id,date) values('Present',$key,'$date')";
          $insertResult=$con->query($query);
        }
        else{
          $query="insert into attendance(value,id,date) values('Absent',$key,'$date')";
          $insertResult=$con->query($query);
        }
      }
      if($insertResult){
        echo "<div class='alert alert-success'>
      
        Attendance taken successfully.;
  
       </div>";
      }
    }


  
  }

?>
</table>
<br><br>
<input class="btn btn-primary" type="submit" value="Mark Attendance" />
<br><br><br>
</form>
</div>




<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
</script>

</body>
</html>

<?php
/*include('includes/scripts.php');*/
include('includes/footer.php');
?>

