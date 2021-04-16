
<?php
session_start();
include("../dbconnection.php");


//disable enable a user server side
 if(isset($_GET['id']) ){
    $wish_id=$_GET["id"];
    $sql="DELETE FROM wish_tbl WHERE wish_id=$wish_id";

        if($result=mysqli_query($con,$sql)){
            if(isset($_GET['cat_id'])) {
                $cat_id=$_GET['cat_id'];
                header("location:wishlist.php?id=$cat_id");
            }
            else{
                header("location:wishlist.php");
            }

            
        }
}


?>