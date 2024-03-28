<?php
include('db.php');

$id = $_POST["id"];

$sql = "SELECT * FROM advance WHERE id = '$id' ";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){

  while($row = mysqli_fetch_assoc($result)){
    $output .= "<tr>
      <td width='90px'>First Name</td>
      <td><input type='text' id='edit-fname' value='{$row["adescription"]}'>
          <input type='text' id='edit-id' hidden value='{$row["id"]}'>
      </td>
    </tr>
    <tr>
      <td>Last Name</td>
      <td><input type='text' id='edit-lname' value='{$row["aamount"]}'></td>
    </tr>
    <tr>
      <td></td>
      <td><input type='submit' id='edit-submit' value='save'></td>
    </tr>";

  }

    mysqli_close($con);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>
