<?php
session_start();
include("../php/dbconnection.php");
$old_pass = $_GET['old_pass'];
$id=$_SESSION['id'];
$sql = "SELECT * FROM login_tbl WHERE login_id=$id and status=1";
if($result = mysqli_query($con,$sql))
{
  if(mysqli_num_rows($result)==1)
  {
    $row = mysqli_fetch_array($result);
    $db_pass = $row['password']; 
    if(password_verify($old_pass,$db_pass))
    { 
      echo "true";
    }
    else{echo "false"; }
  }else{ echo "false"; }
}else{ echo "false"; }

?>