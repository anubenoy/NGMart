<?php
session_start();
include("dbconnection.php");
//fetching data from login form
$password = $_POST['login_pass'];
$email = mysqli_real_escape_string($con,$_POST['login_email']);
$user_homepg;
        
//check login tbl
$sql = "SELECT * FROM login_tbl WHERE email='$email' and status=1";
            
// Return the number of rows in result set
    if($result = mysqli_query($con,$sql))
    { 
      // $rows = mysqli_fetch_assoc($result); #as key value pairs/ if array - gives both key and index pos for each val
        if(mysqli_num_rows($result)==1)
        {
            $row = mysqli_fetch_array($result);
            $db_pass = $row['password']; 

             if(password_verify($password,$db_pass)){ #function deshashes and check password
                
                  $_SESSION['id'] = $row['login_id'];

                  // if "password correct" redirect
                  if($row['user_type']=='admin'){ $user_homepg = 'admin/dashboard.php'; }
                  else if($row['user_type']=='customer'){ $user_homepg = 'cust/products.php'; }
                  else if($row['user_type']=='seller'){ $user_homepg = 'seller/seller.php?id=-1'; }
                  else{ echo"not a valid user";}
                  header("location:$user_homepg" );
            
                }else{echo "wrong password";}
        
        }else{echo "Please enter the correct login details";}//redirect this to index.php and show there  

    }else{echo "query error";}

?>
