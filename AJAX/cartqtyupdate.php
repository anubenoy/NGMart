<?php
include("../php/dbconnection.php");
    $cartid=$_GET['cartid'];
    $qty=$_GET['qty'];
    $sql="UPDATE cart_tbl SET cart_qty=$qty where cart_id=$cartid";
    if(mysqli_query($con,$sql)){
        echo "sucess";
    }
?>