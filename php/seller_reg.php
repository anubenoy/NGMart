<?php
include("dbconnection.php");
$name= $_POST["name"];
$email= $_POST["email"];
$password= $_POST["password"];
//$time1=$_POST["timeone"];
//$time2=$_POST["timetwo"];
$password= password_hash("$password",PASSWORD_DEFAULT);

$sql="select email from login_tbl where email='$email'";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)<1)
 	{
        $sql1="insert into login_tbl (email,password,user_type) values ('$email','$password','seller')";
        mysqli_query($con,$sql1);
        $n=mysqli_insert_id($con);
        // echo $n ,$name;
        $sql2="insert into sellerreg_tbl (seller_login_id,seller_name) values($n,'$name')";
        if(mysqli_query($con,$sql2))
        {
            session_start();
            $_SESSION['temp_id']=$n;
            // echo $_SESSION['id'];
            // header("location:seller/seller.php?id=-1");
            header("location:seller/shopDetails.php");

        }
        //check redirection later
     }
else
	{ 
?>
		<script>alert("already a user!");</script>
<?php 
      header("location:../login_reg.php#page3");  
	}
mysqli_close($con);
?> 