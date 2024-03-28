<?php
include('db.php');
include('includes/header.php'); 
include('includes/navbaruser.php'); 
?>

<!-- CHART-->
<?php 
$sql = "SELECT * from department";

$query = $con->query($sql);
$chart_data = '';
while($row = $query->fetch_assoc())
{
$depname = $row['name'];

$casql = "SELECT *, COUNT(id) AS total,department FROM employee WHERE department='$depname' ";
$caquery = $con->query($casql);
$carow = $caquery->fetch_assoc();
$cashadvance = $carow['total'];
$chart_data .= "{ department:'".$row['name']."', employee :".$cashadvance."}, ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
 <!--
<?php
require 'db.php';
$a=$_SESSION['username'];
$detail = "SELECT * FROM register WHERE email = '$a' ";

$run_data = mysqli_query($con,$detail);
$row = mysqli_fetch_assoc($run_data);
$n=$row['empid'];

$employee_detail = "SELECT * FROM employee WHERE empid = '$n' ";
$run = mysqli_query($con,$employee_detail);
$emprow = mysqli_fetch_assoc($run);
$eid=$emprow['empid'];
$fn=$emprow['firstname'];
$ln=$emprow['lastname'];
$cn=$emprow['cnicno'];
$add=$emprow['address'];
$ty=$emprow['type'];
$desig=$emprow['designation'];
$img=$emprow['image'];
$dep=$emprow['department'];
$gen=$emprow['gender'];
$nati=$emprow['nationality'];
$dob=$emprow['dob'];
$em=$emprow['email'];
$en=$emprow['emergencyno'];
$phone=$emprow['phone'];
$salary=$emprow['Salary'];
?>

<h4>Employee Name	 &nbsp :  &nbsp<?php echo $a ?></h4>
<h4>Employee Name	 &nbsp :  &nbsp<?php echo $n ?></h4>

-->
<!-- 0000000000000000000000000000000000000000000000000000000000000000000000000000000000-->
<section>
    <div class="rt-container">
          <div class="col-rt-12">
              <div class="Scriptcontent">
              
<!-- Student Profile -->
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent text-center">
            <img class="profile_img" src="<?php echo $img ?>" alt="student dp">
            <h3><?php echo $fn ?></h3>
          </div>
          <div class="card-body">
            <p class="mb-0">ID : <strong class="pr-1"><?php echo $eid ?></strong></p>
            <p class="mb-0">Name : <strong class="pr-1"><?php echo $fn ?></strong></p>
            
          </div>
        </div>
      </div>
    </div>
    <hr> &nbsp
<div class="row">
      <div class="col-lg-6">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Profile</h3>
            <a href="user_edit.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-edit fa-sm text-white-50"></i> Edit Profile</a>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">CNIC NO</th>
                <td width="2%">:</td>
                <td><?php echo $cn ?></td>
              </tr>
              <tr>
                <th width="30%">Address</th>
                <td width="2%">:</td>
                <td><?php echo $add ?></td>
              </tr>
              <tr>
                <th width="30%">Date of Birth</th>
                <td width="2%">:</td>
                <td><?php echo $dob ?></td>
              </tr>
              <tr>
                <th width="30%">Emergency No</th>
                <td width="2%">:</td>
                <td><?php echo $en ?></td>
              </tr>
              <tr>
                <th width="30%">Phone</th>
                <td width="2%">:</td>
                <td><?php echo $phone ?></td>
              </tr>
            </table>
            <a href="employee_Form.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Show More</a>
          </div>
        </div></div>
          
          <div class="col-lg-6">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Attendance</h3>
          </div>
          <div class="card-body pt-0">
              <p>-.</p>
              <div id="chart"></div>
            </div>
        </div></div>
      
    </div>
  </div>
</div>
<!-- partial -->
           
    		</div>
		</div>
    </div>
</section>
<!-- 0000000000000000000000000000000000000000000000000000000000000000000000000000000000-->

 <!-- CHART-->
 <div class="container" style="width:990px;">

   <div id="chart"></div>
  </div>

</body>
</html>

<!-- CHART SCRIPT-->
<script>
Morris.Bar({
 element : 'chart',
 data:[<?php echo $chart_data; ?>],
 xkey:'department',
 ykeys:['employee'],
 labels:['Employees'],
 hideHover:'auto',
 stacked:true,
 resize:true,
});
</script>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>