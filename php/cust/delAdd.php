<?php
include('../dbconnection.php');
if(isset($_GET['add_id']))
    {
        $add_id=$_GET['add_id'];
        $sql="DELETE FROM address_tbl WHERE add_id=$add_id";
        if(mysqli_query($con,$sql)){ header("location:deliveryAdd.php"); }
    }

   

?>