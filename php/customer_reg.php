<?php
include("dbconnection.php");
$name= $_POST["name"];
$email= $_POST["email"];
$password = $_POST["password"];
//used coz each time give dffrnt hash value unlike md5 (converts 72chars encryption code)
$password = password_hash($password,PASSWORD_DEFAULT); 


$sql="select email from login_tbl where email='$email'";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)<1)
 	{
         
        $sql1="insert into login_tbl (email,password,user_type) values ('$email','$password','customer')";
        mysqli_query($con,$sql1);
        $n=mysqli_insert_id($con);
        $sql2="insert into customerreg_tbl(login_id,name) values($n,'$name')";
        if(mysqli_query($con,$sql2))
        { 
            session_start();
            $_SESSION['id']=$n;

            $sql="SELECT customerreg_id FROM customerreg_tbl WHERE login_id=$n";
            $result=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($result);
            $_SESSION['reg_id'] = $row['customerreg_id']; //for easy fetching cutomer details

            header("location:../index.php");}
    }
else
	{ 
?>
		<script>alert("already a user!");</script>
<?php 
	}
mysqli_close($con);
?> 