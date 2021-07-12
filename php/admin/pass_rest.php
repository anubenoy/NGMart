<?php
session_start();
include("../dbconnection.php");
$old_pass = $_POST['old_pass'];
$new_pass = mysqli_real_escape_string($con,$_POST['password']);
$password = password_hash($new_pass,PASSWORD_DEFAULT); 
$id=$_SESSION['id'];
$sql = "SELECT * FROM login_tbl WHERE login_id=$id and status=1";

if($result = mysqli_query($con,$sql))
  { 
    if(mysqli_num_rows($result)==1)
    {
      $row = mysqli_fetch_array($result);
      $db_pass = $row['password']; 
      if(password_verify($old_pass,$db_pass))
      { #function deshashes and check password
          // if "password correct" redirect
        $sql="UPDATE login_tbl SET password='$password' WHERE login_id=$id";
        if($result = mysqli_query($con,$sql))
        {           
          session_destroy();
          ?>
            <script>alert("Password changed. \n Login to continue!"); window.location.href="../../login_reg.php";</script>
          <?php 
        }
      }
      else
      {?>
        <script>alert("Old password doesn't match!");window.location.href="adminUser.php";</script>
        <?php
      } 
    }
  }
  else{
    echo "query error";
  }

?>