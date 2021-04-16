<?php
    include("../dbconnection.php");
    $email= $_POST["email"];
    $password = $_POST["password"];
    //used coz each time give dffrnt hash value unlike md5 (converts 72chars encryption code)
    $password = password_hash($password,PASSWORD_DEFAULT); 


    $sql="select email from login_tbl where email='$email'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)<1)
        {
            $sql1="insert into login_tbl (email,password,user_type) values ('$email','$password','admin')";
            mysqli_query($con,$sql1);
            header("location:adminUser.php");
                  
        }
    else
        { 
    ?>
            <script>alert("already a user!");</script>
    <?php 
        }
    mysqli_close($con);
?> 
