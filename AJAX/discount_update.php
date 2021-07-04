<?php
include("../php/dbconnection.php");
    $ps_id=$_GET['ps_id'];
    $discount=$_GET['perct'];
    $sql="UPDATE product_seller_tbl SET ps_discount_perct=$discount WHERE ps_id=$ps_id";
    if(mysqli_query($con,$sql)){
        echo "success";
    }
?>