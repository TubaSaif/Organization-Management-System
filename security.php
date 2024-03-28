<?php

include('database/dbconfig.php');
session_start();
if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: database/dbconfig.php");
}

if(!$_SESSION['username'])
{
    header('Location: login.php');
}
?>