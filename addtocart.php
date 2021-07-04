<?php
session_start();
include("php/dbconnection.php");
$userid=$_SESSION['reg_id'];
$ps_id=$_GET['id'];
$seller_id=$_GET['seller_id'];

    // check if a person has cart items
    $sql="SELECT * FROM cart_tbl WHERE customerreg_id=$userid";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    if(mysqli_num_rows($result)<1) //insert if no cart items for a cust
    {   
        $sql2="INSERT INTO cart_tbl (customerreg_id, ps_id) VALUES ($userid,$ps_id)";
        mysqli_query($con,$sql2);
        
        //update cart_qty in index page
        $sqlc="select count(ps_id) as count from cart_tbl where customerreg_id=$userid"; 
        $resultc=mysqli_query($con,$sqlc);
        $rowc=mysqli_fetch_array($resultc);
        echo $rowc['count'];

    }
    else
    {  //if cart item present
        $cart_ps_id=$row['ps_id'];
        $sql3="SELECT * FROM product_seller_tbl WHERE ps_id=$cart_ps_id";
        $result3=mysqli_query($con,$sql3);
        $row3=mysqli_fetch_array($result3);
        $ps_seller_id=$row3['ps_seller_id'];
        if($seller_id == $ps_seller_id)
        { //check if adding prod of same seller

            $sql4="SELECT * FROM product_seller_tbl as ps,cart_tbl as c WHERE c.ps_id=ps.ps_id AND ps.ps_id=$ps_id";
            $result4=mysqli_query($con,$sql4);
            $row4=mysqli_fetch_array($result4);
            $cart_qty=$row4['cart_qty'];
            $ps_stock=$row4['ps_total_stock'];
            if($cart_qty <= $ps_stock)
            { 
                // echo "can add" ;
                 
                $sql6="SELECT * FROM cart_tbl WHERE customerreg_id=$userid and ps_id=$ps_id";
                $result6=mysqli_query($con,$sql6);

                if(mysqli_num_rows($result6)<1) //update qty if product of a seller already prsnt else insert new prod of same seller 
                { 
                    $sql5="INSERT INTO cart_tbl (customerreg_id, ps_id) VALUES ($userid,$ps_id)";
                    mysqli_query($con,$sql5);
                    // echo true;
                    // update cart_qty in index page
                    $sqlc="select count(ps_id) as count from cart_tbl where customerreg_id=$userid"; 
                    $resultc=mysqli_query($con,$sqlc);
                    $rowc=mysqli_fetch_array($resultc);
                    echo $rowc['count'];

                }
                else{
                    $sql5="UPDATE cart_tbl SET cart_qty=cart_qty+1 where customerreg_id=$userid AND ps_id=$ps_id";
                    mysqli_query($con,$sql5);
                    // echo true;
                    // update cart_qty in index page
                    $sqlc="select count(ps_id) as count from cart_tbl where customerreg_id=$userid"; 
                    $resultc=mysqli_query($con,$sqlc);
                    $rowc=mysqli_fetch_array($resultc);
                    echo $rowc['count'];
                 }   
            
            } 
           
        }
        else
        {
            echo false;
            // echo "this is an error";
        }
    
     
    }



?>


