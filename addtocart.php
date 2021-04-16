<?php
session_start();
include("php/dbconnection.php");
$userid=$_SESSION['reg_id'];
$ps_id=$_GET['id'];

// echo $userid;

$sql="SELECT * FROM cart_tbl WHERE customerreg_id=$userid and ps_id=$ps_id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
// echo mysqli_num_rows($result);

//
// echo $cart_id;

if(mysqli_num_rows($result)<1)
{   
    
    $sql2="INSERT INTO cart_tbl (customerreg_id, ps_id) VALUES ($userid,$ps_id)";
    mysqli_query($con,$sql2);
}
else{
        $cart_id=$row['cart_id']; 
    $sql3="UPDATE cart_tbl SET cart_qty=cart_qty+1 where cart_id=$cart_id";
    mysqli_query($con,$sql3);
    
}
$sqlc="select count(ps_id) as count from cart_tbl where customerreg_id=$userid";
$resultc=mysqli_query($con,$sqlc);
$rowc=mysqli_fetch_array($resultc);
echo $rowc['count'];


?>


