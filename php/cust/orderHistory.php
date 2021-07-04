<?php
session_start();
if(isset($_SESSION['id'])){
    include("../dbconnection.php");
    $reg_id=$_SESSION['reg_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home page</title>

    <link href="../../style/orderHistory.css" rel="stylesheet" />
    
</head>
<body>
    <div class=pg_navbar>
    <div class="topblack">
		<div class="leftblock"><p>For enquiry call 123 | email on <a style="color:rgba(255, 255, 255, 0.851);" href="mailto:admin@gmail.com"> admin@gmail.com </a></p></div>
		<div class="rightblack">
			<?php 
                
                $sql="SELECT name FROM customerreg_tbl WHERE customerreg_id=$reg_id";
                $result=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($result); 
                echo '<a href="#">'.$row['name'].'</a>';
            
			?>
			
		</div>
	</div>
	<div class="topbargreen">
		<p onclick="location.href='../../index.php'">NGMART</p>
		<div class="topgreen_right">
                
            <?php 	
                $sqln="select count(wish_id) as count2 from wish_tbl where customerreg_id=$reg_id";
                $resultn=mysqli_query($con,$sqln);
                $rown=mysqli_fetch_array($resultn);
                
                $sql = "select count(ps_id) as count from cart_tbl where customerreg_id=$reg_id";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($result);
                ?>
                
                <a href="wishlist.php" style="margin-right:18px">Wishlist
                    <sup id="ss" style="background-color:red;border-radius:100%;z-index:3;padding:2px 4px;"><?php echo $rown['count2']?> </sup>
                </a>
                <a href="cart.php" style="margin-right:18px">Cart
					<sup id="ss" style="background-color:red;border-radius:100%;z-index:3; padding:2px 4px;"><?php echo $row['count'] ?> </sup>
				</a>	
                <a href="../logout.php">Logout</a>
		
			<!-- <a href="">About us</a> -->	
		</div>
	</div>

    </div>
    
   
    <div class="orders_main">
   
        <h2> Your Orders </h2><br><br>

            <?php
            $sql="SELECT * FROM order_tbl ORDER BY order_status DESC";
            $result= mysqli_query($con,$sql);
            while($orders=mysqli_fetch_array($result))
            {
              $ps_id=$orders['order_ps_id'];
              $sql2="SELECT *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$ps_id";
              $result2= mysqli_query($con,$sql2);
              $prod=mysqli_fetch_array($result2);
  
              $addr_id=$orders['order_add_id'];
              
              $sql3="SELECT * FROM address_tbl WHERE add_id=$addr_id";
              $result3=mysqli_query($con,$sql3);
              $addr=mysqli_fetch_array($result3);     
              $country_id=$addr['add_country_id'];
              $state_id=$addr['add_state_id'];
              $cities_id=$addr['add_cities_id'];
             
            //   $sql4="SELECT co.*,st.*,ci.* FROM countries_tbl AS co,states_tbl AS st,cities_tbl AS ci WHERE ci.cities_state_id=st.state_id AND ci.cities_country_id=co.country_id AND ci.cities_id=$cities_id ";
            //   $result4=mysqli_query($con,$sql4);
            //   $row4=mysqli_fetch_array($result4);
            //   echo $row4['country_name'];
              
            ?>
            <div class="orders">
            
                <div class="order_img"><image src="../../images/<?php echo $prod['ps_image']; ?>"></div>

                <div class="order_data">
                    <div class="order_id"><p>Order-ID: #<?php echo $orders['order_transaction_id']; ?></p></div>
                    <div class="prod"><b><?php echo $prod['prod'];?></b></div>
                    <div class="details">
                        Ordered Qty : <?php echo $orders['order_quantity']?><br>
                        Total Price : &#8377 <?php echo $orders['order_quantity']*$orders['order_price']?><br>
                        Sold By : <?php echo $prod['seller'];?><br>
                        Ordered On : <?php echo $orders['order_date'];?><br>
                        Order Status : <?php echo $orders['order_status'];?><br>
                    </div>
                </div>

                <div class="order_btn">
                    <div style="width:160px">
                        <a href=""><button class="deliver_btn2">Post Complaint</button></a>
                        <a href=""><button class="deliver_btn1">Add Review</button></a>
                        <?php if($orders['order_status']!="cancelled"){?>
                        <a href="cancelOrder.php?o_id=<?php echo $orders['order_id'];?>"><button class="deliver_btn3">Cancel</button></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <?php
            }
            ?>

           
    </div>
    
    </body>

</html>

<!--session logout!-->
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