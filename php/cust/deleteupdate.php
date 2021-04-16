
<?php
session_start();
include("../dbconnection.php");
$reg_id=$_SESSION['reg_id'];
$ps_id=$_GET['ps_id'];

//disable enable a user server side
 if(isset($_GET['id']) )
 {
    $cart_id=$_GET["id"];
    $sql="DELETE FROM cart_tbl WHERE cart_id=$cart_id";
   
    if(mysqli_query($con,$sql))
    {
        $sql="SELECT * FROM wish_tbl WHERE customerreg_id=$reg_id and ps_id=$ps_id";
        $result=mysqli_query($con,$sql);
        
        if(mysqli_num_rows($result)<1)
        {   
            //update wishlist tbl
            $sql2="INSERT INTO wish_tbl (customerreg_id, ps_id) VALUES ($reg_id, $ps_id)";

            if($result=mysqli_query($con,$sql2)){
                header("location:cart.php");
            }
        }
    }
}

?>