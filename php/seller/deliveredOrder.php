<?php
session_start();
include("../dbconnection.php");
$o_id=$_GET['o_id'];
$sql="UPDATE order_tbl SET order_status='delivered' WHERE order_id=$o_id";
if(mysqli_query($con,$sql)){
    
}


?>