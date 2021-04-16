
<?php
session_start();
include("../dbconnection.php");


//disable enable a user server side
 if(isset($_GET['id']) ){
    $cart_id=$_GET["id"];
    $sql="DELETE FROM cart_tbl WHERE cart_id=$cart_id";
    if($result=mysqli_query($con,$sql)){
    header("location:cart.php");
    }
}

?>