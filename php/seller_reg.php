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
        echo $n ,$name;
        $sql2="insert into sellerreg_tbl (login_id,name) values($n,'$name')";
        if(mysqli_query($con,$sql2))
        {
            session_start();
            $_SESSION['id']=$n;
            header("location:seller/seller.php?id=-1");
        }
        //check redirection later
     }
else
	{ 
?>
		<script>alert("already a user!");</script>
<?php 
	}
mysqli_close($con);
?> 