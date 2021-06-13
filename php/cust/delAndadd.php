<?php
session_start();
include("../dbconnection.php");

$userid=$_SESSION['reg_id'];
$ps_id=$_GET['ps_id'];
$seller_id=$_GET['seller_id'];

$sql="delete FROM cart_tbl WHERE customerreg_id=$userid";
mysqli_query($con,$sql);
$sql5="INSERT INTO cart_tbl (customerreg_id, ps_id) VALUES ($userid,$ps_id)";
if(mysqli_query($con,$sql5)){
    header("location:cart.php");
}

?>