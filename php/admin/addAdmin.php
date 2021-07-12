<?php
    include("../dbconnection.php");
    $nm=$_POST['nme'];
    $email= $_POST["email"];
    // echo $nm;
    $password = $_POST["password"];
    //used coz each time give dffrnt hash value unlike md5 (converts 72chars encryption code)
    $password = password_hash($password,PASSWORD_DEFAULT); 

    $sql="select email from login_tbl where email='$email'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)<1)
        {
            $sql1="insert into login_tbl (email,password,user_type) values ('$email','$password','admin')";
            mysqli_query($con,$sql1);
            $n=mysqli_insert_id($con);
            $sql2="insert into customerreg_tbl (login_id,name,cust_location_id,cust_district) values ('$n','$nm',0,0)";
            mysqli_query($con,$sql2);
            header("location:adminUser.php");
        }
    else
        { 
    ?>
        <script>alert("already a user!");</script>
    <?php 
        header("location:adminUser.php");
        }
    mysqli_close($con);
?> 
