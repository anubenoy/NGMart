
<?php
session_start();
include("../dbconnection.php");


//disable enable a user server side
 if(isset($_GET['delete'])=='true' && isset($_GET['id']) ){
    $id=$_GET["id"];
    $sql="DELETE FROM product_seller_tbl WHERE ps_id=$id";
    if($result=mysqli_query($con,$sql)){
    header("location:seller.php?id=-1");
    }
}

?>