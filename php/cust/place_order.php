<?php
session_start();
include("../dbconnection.php");
$userid=$_SESSION['reg_id'];
$trans_ftail="#qlk2021";
$trans_btail=1;

$response = true;

    // check if a person has cart items
    $sql="SELECT * FROM cart_tbl WHERE customerreg_id=$userid";
    $result=mysqli_query($con,$sql);
    while($row=mysqli_fetch_array($result))
    {
        if(mysqli_num_rows($result)>1) //proceed to buy if  cart  has atleast one item for a cust
        {   
            $ps_id=$row['ps_id'];
            $sql4="SELECT * FROM product_seller_tbl as ps,cart_tbl as c WHERE c.ps_id=ps.ps_id AND ps.ps_id=$ps_id";
            $result4=mysqli_query($con,$sql4);
            $row4=mysqli_fetch_array($result4);
            $cart_qty=$row4['cart_qty'];
            $ps_stock=$row4['ps_total_stock'];
            if($cart_qty > $ps_stock)
            {
                $response = false;
                if($response == 'false'){break;}//see redirection after breaking
                // $product_id = $row4['ps_product_id'];
                // $sqlForPrdName="SELECT * FROM product_tbl where product_id = $product_id";
                // $resultForPrdName=mysqli_query($con,$sqlForPrdName);
                // $rowForPrdName = mysqli_fetch_array($resultForPrdName);

                // $product_name= $rowForPrdName['prod_name'];
                // echo $product_name;
                // echo $row4['ps_total_stock'];
                
            }
        }
        else{
            echo "cart have no items.";
            //come back to order summary pg need add_id
            header("location:order.php?add=<?php echo $add_id ?> ");
            
        }
    }
    
    //executed only if all products has enough stock matching users demand qty
    if($response)
    {
        
        //adding each item in cart to order tbl 
        $sql2="SELECT * FROM cart_tbl WHERE customerreg_id=$userid";
        $result2=mysqli_query($con,$sql2);
        while($row2=mysqli_fetch_array($result2))
        {
            $trans_btail+=1; //to be generated only if payment done.
            $transaction_id=$trans_ftail.$trans_btail;
        
            date_default_timezone_set("Asia/Kolkata");
            $o_date=date('y-m-d h:i:s');
           
            //checking if paid or not
            $order_status="";
            if(isset($transaction_id)){$order_status="paid";}
            else{$order_status="pending";}
           
            $ps_id=$row2['ps_id'];
            $cart_qty=$row2['cart_qty'];
            $inventory_stock=-$cart_qty;
            // echo $inventory_stock;

            //get price of prod.
            $sql3="SELECT * FROM product_seller_tbl WHERE ps_id=$ps_id";
            $result3=mysqli_query($con,$sql3);
            $row3=mysqli_fetch_array($result3);
            $product_seller_id=$row3['ps_seller_id'];
            $current_price=$row3['ps_price'];

            $sql7="SELECT * FROM inventory_tbl WHERE inventory_ps_id=$ps_id";
            $result7=mysqli_query($con,$sql7);
            $row7=mysqli_fetch_array($result7);
            $expdate=$row7['inventory_expiry_date'];
           
            //deduct product from inventory bfr adding products to order tbl.
            $sql4="INSERT INTO inventory_tbl (inventory_ps_id,inventory_seller_id,inventory_stock,inventory_date,inventory_expiry_date,inventory_status) VALUES ($ps_id,$product_seller_id,$inventory_stock,'$o_date','$expdate',0)";
            if(mysqli_query($con,$sql4))
            {
                $sql6="UPDATE product_seller_tbl SET ps_total_stock=(SELECT sum(inventory_stock) FROM inventory_tbl WHERE inventory_ps_id=$ps_id) WHERE ps_id=$ps_id";
                if(mysqli_query($con,$sql6))
                {
                      // insert into order tbl cart items only if prod deducted from inventory tbl.
                    $sql5="INSERT INTO order_tbl (order_transaction_id,order_date,order_status,order_customer_id,order_product_seller_id,order_ps_id,order_quantity,order_price) VALUES ('$transaction_id','$o_date','$order_status',$userid,$product_seller_id,$ps_id,$cart_qty,$current_price)";
                    $result5=mysqli_query($con,$sql5);
                    echo "sucess";
                }
   
            }
            else
            {
                echo "inventory_tbl insertion error!";
            }
             
           
           

        }

        
        
    }

?>



