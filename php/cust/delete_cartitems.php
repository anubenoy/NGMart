
<?php
session_start();
include("../dbconnection.php");


//disable enable a user server side
 if(isset($_GET['id']) ){
    $cart_id=$_GET["id"];
    $sql="DELETE FROM cart_tbl WHERE cart_id=$cart_id";
    if($result=mysqli_query($con,$sql))
    {
        //check if redirection from cart pg or order summary pg
        if(isset($_GET['order_final']))
        {
            if(isset($_GET['add_id']))
            {
                $add_id=$_GET['add_id']; echo $add_id;
                header("location:order.php?add=$add_id");  
            }
        }
        else{ header("location:cart.php"); }
                    
    }
    
}

?>