<?php

session_start();
if(isset($_SESSION['reg_id'])){
    include("../dbconnection.php");
    $reg_id=$_SESSION['reg_id'];
    $add_id=$_GET['add'];
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <link href="../../style/order.css" rel="stylesheet"/> 
</head>
<body>
<div class="order_main">
        <img src="../../images/logo.png" id="d_logo" onclick="location.href='../../index.php'"/>

        <!-- // CURRENT STATUS -->
        <div class="status">
            <hr class="logo_hr">
            <hr class="hr_progress">
            <p>SIGN IN </p>
            <p>DELIVERY & PAYMENT</p>
            <p>PLACE ORDER</p>
            <p>COMPLETE PAYMENT</p>
        </div>
        <!-- CURRENT STATUS ENDS HERE  -->
        <br>

        <div class="ship_add">

            <h4>Shipping Address</h4>

            <div class="loca_box"><div class="loca_logo">
            <img src="../../images/logo_loca.png" width="20px" height="25px">
            </div></div>

            <?php
                $sql="SELECT * FROM address_tbl WHERE add_id=$add_id ";
                $result=mysqli_query($con,$sql);
                while($row=mysqli_fetch_array($result))
                {
                    $country_id=$row['add_country_id'];
                    $state_id=$row['add_state_id'];
                    $cities_id=$row['add_cities_id'];
                   

                    $sql2="SELECT co.*,st.*,ci.* FROM countries_tbl AS co,states_tbl AS st,cities_tbl AS ci,address_tbl AS ad  WHERE ci.cities_state_id=st.state_id AND ci.cities_country_id=co.country_id AND ci.cities_id=$cities_id ";
                    // $sql2="SELECT * FROM countries_tbl WHERE country_id=$country_id";
                    $result2=mysqli_query($con,$sql2);
                    $row2=mysqli_fetch_array($result2);

                        echo '<div class="addr_box">';
                           
                                echo '<p style="font-weight:bold;">'.$row['add_full_name']."</p>";
                                echo "<p>".$row['add_mobile_no']."</p>";
                                echo "<p>".$row['add_house_name'].", ".$row['add_area'].", ".$row2['cities_name']."</p>";
                                echo "<p>".$row2['state_name'].", ".$row2['country_name'].", ".$row['add_pincode']."</p>";
                            
                        echo "</div>";

                        echo "<div class='edit_btn'>";
                            echo '<a href="editAdd.php?add_id='.$row['add_id'].'"><button  class="deliver_btn">Edit</button></a>';
                        echo "</div>";   
                }
                 ?>
         </div>
        
    <div class="orders">
            <h4>Order Summary</h4>
            <?php
            $subtotal=0;
            $item_count=0;
            $delivery_charge=20;
            
            $sql="select * from cart_tbl where customerreg_id=$reg_id";
            $result=mysqli_query($con,$sql);
            while($row=mysqli_fetch_array($result))
            {
        
                $item_id=$row["ps_id"];
                // $q="select * from product_seller_tbl where ps_id=$item_id";
                $sql2="select *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$item_id and ps.ps_total_stock>0";

                $resulti=mysqli_query($con,$sql2);
                $rowi=mysqli_fetch_array($resulti);
                $image="../../images/".$rowi['ps_image'];
                ?>
                <div class="cartitems">
                    <a href=""><img src="../../images/<?php echo $rowi['ps_image'] ?>">
                    <div class="dis">
                        <h2 style="margin-bottom:0px;"><?php echo $rowi['prod'] ?></h2>
                        <div class="seller">Sold by <?php echo $rowi['seller'] ?></div>
                        <div class="pr">&#8377 <?php echo $rowi['ps_price']?></div>
                        <a href="deleteupdate.php?add_id=<?php echo $add_id ?> &order_final=true&id=<?php echo $row['cart_id']?>&ps_id=<?php echo $row['ps_id'] ?>"><button style="width:240px;">Save for later</button></a>
                    </div>
                    <div class="more"> x <?php echo $row['cart_qty'] ?> </div>
                    <div class="del_item"><a href="delete_cartitems.php?id=<?php echo $row['cart_id'] ?>"><button class="del ">x</button></a></div>    
                </div>  
                
        <?php 
        $item_count+=$row['cart_qty'];
        $subtotal+= $rowi['ps_price']*$row['cart_qty'];
        } 
        $tax = (10/100) * $subtotal; 
        $total =  $subtotal + $delivery_charge + $tax;
        ?>

    </div>

    <div class="pay_summary">
        <h4>Payment Summary</h4>
        <table>
            <tr>
                <td class="pay_head">Subtotal <label class="sub_head">(<?php echo $item_count?> items) </label></td>
                <td class="pay_price">&#8377 <?php echo $subtotal ?></td> <!-- &#8377 - ruppee symbol-->
            </tr>
            <tr>
                <td class="pay_head">Delivery</td>
                <td>&#8377 20.00</td>
            </tr>
            <tr>
                <td class="pay_head">Tax <label class="sub_head"> GST 10% (included)</label></td>
                <td>&#8377 <?php echo $tax ?></td>
            </tr>
            <tr>
                <td class="pay_head">Total paid by customer</td>
                <td>&#8377 <?php echo $total ?></td>
            </tr>
        </table>
                
    </div>
    <div class="pay_btn">
        <button  onclick="" class="deliver_btn1" style="font-size: 11px; width:100px;">Pay</button> <br><br>

    </div>
    
    <?php //require_once("footer.php"); ?>
</div>
    
</body>
</html>
<?php 
}
else
{?>
   <script>
   alert("Already Logout! \n Login to continue.");
   window.location.href="../../login_reg.php";
   </script>
   
   <?php
}?>
