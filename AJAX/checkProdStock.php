<?php
session_start();
include("../php/dbconnection.php");
$userid=$_SESSION['reg_id'];



    // check if a person has cart items
    $sql="SELECT * FROM cart_tbl WHERE customerreg_id=$userid";
    $result=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($result))
    // if(mysqli_num_rows($result)>1) //proceed to buy if  cart  has atleast one item for a cust
    {   
            $ps_id=$row['ps_id'];
            $sql4="SELECT * FROM product_seller_tbl as ps,cart_tbl as c WHERE c.ps_id=ps.ps_id AND ps.ps_id=$ps_id";
            $result4=mysqli_query($con,$sql4);
            $row4=mysqli_fetch_array($result4);
            $cart_qty=$row4['cart_qty'];
            $ps_stock=$row4['ps_total_stock'];
            if($cart_qty <= $ps_stock)
            { 
                
                header("location:../php/cust/deliveryAdd.php");
           
            }
    
     
    }

?>


