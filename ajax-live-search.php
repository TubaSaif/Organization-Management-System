<?php
include('db.php');

$search_value = $_POST["search"];

$sql = "SELECT * FROM advance WHERE aamount LIKE '%{$search_value}%' OR adescription LIKE '%{$search_value}%'";
$result = mysqli_query($con, $sql) or die("SQL Query Failed.");
$output = "";
if(mysqli_num_rows($result) > 0 ){
  $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
              <tr>
                <th width="60px">Id</th>
                <th>Name</th>
                <th width="90px">Edit</th>
                <th width="90px">Delete</th>
              </tr>';

              while($row = mysqli_fetch_assoc($result)){
                $output .= "<tr>
                <td align='center'>{$row["id"]}</td>
                <td>{$row["aamount"]} {$row["adescription"]}</td>
                <td align='center'><button class='edit-btn' data-eid='{$row["id"]}'>Edit</button></td>
                <td align='center'><button Class='delete-btn' data-id='{$row["id"]}'>Delete</button></td>
                </tr>";
              }
    $output .= "</table>";

    mysqli_close($con);

    echo $output;
}else{
    echo "<h2>No Record Found.</h2>";
}

?>
