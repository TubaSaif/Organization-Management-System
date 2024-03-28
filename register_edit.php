<?php
include('security.php');
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


  <div class="card-body">
  
  <?php

if(isset($_POST['edit_btn']))
{
    $id = $_POST['edit_id'];
    
    $query = "SELECT * FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>

            <form action="code.php" method="POST">
                <h2>Edit Details</h2>
                <br>

                <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                <div class="form-group">
                    <label> Username </label>
                    <input type="text" name="edit_username" value="<?php echo $row['username'] ?>" class="form-control"
                        placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="edit_email" value="<?php echo $row['email'] ?>" class="form-control"
                        placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="edit_password" value="<?php echo $row['password'] ?>"
                        class="form-control" placeholder="Enter Password">
                </div>

                <a href="register.php" class="btn btn-danger"> CANCEL </a>
                <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>

            </form>
            <?php
    }
}
?>

    
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>