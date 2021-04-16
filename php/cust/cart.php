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
    <link href="../../style/cart_style.css" rel="stylesheet" />
    
</head>
<body>
    <div class="topblack">
		<div class="leftblock"><p>For enquiry call 911 | email on <a style="color:rgba(255, 255, 255, 0.851);" href="mailto:admin@gmail.com"> admin@gmail.com </a></p></div>
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
            
                ?>
                <a href="wishlist.php" style="margin-right:20px">Wishlist
                    <sup id="ss" style="background-color:red;border-radius:100%;z-index:3;padding:2px 4px;"><?php echo $rown['count2']?> </sup>
                </a>	
                <a href="../logout.php">Logout</a>
		
			<!-- <a href="">About us</a> -->
			
			
		</div>
	</div>	
<!-- --------------------------------top nav bar done  -->
<div class="item_display">
<div class="margin" style="margin-top: 10px;">
        <div class="checkout"> 
            <div class="toppart">
                <p>Part of your order qualifies for FREE Delivery. </p>
            </div>
            <div class="bottompart">
            <!-- // total cost --------------------------------- -->
            <?php
                $total=0;
            
                $sql="select count(ps_id) as count from cart_tbl where customerreg_id=$reg_id";
                $result=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($result);
                    $l="select * from cart_tbl where customerreg_id=$reg_id";
                    $r1=mysqli_query($con,$l);
                    while($row1=mysqli_fetch_array($r1)){
                        $ps=$row1['ps_id'];
                        $sub="select price from product_seller_tbl where ps_id=$ps";
                        $r2=mysqli_query($con,$sub);
                        $row2=mysqli_fetch_array($r2);
                        $total+=$row2['price']*$row1['cart_qty'];
                    }
            // ?> 
            <!-- --------------------------------- -->
                <b> Subtotal (<?php echo $row['count'] ?>) : <i style="color:brown"> Rs. <?php echo $total ?> </i></b>

               <center> <a href="update.html"><button > Proceed to buy </button> </a></center>
            </div>

        </div>


<div class="head"><h3>Shopping Cart</h3><br></div>

        <hr>
        <?php
            
            $sql="select * from cart_tbl where customerreg_id=$reg_id";
            
            $result=mysqli_query($con,$sql);
            while($row=mysqli_fetch_array($result))
            {
        
                $item_id=$row["ps_id"];
                // $q="select * from product_seller_tbl where ps_id=$item_id";
                $sql2="select *,p.name as prod,s.name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.seller_id=l.login_id and p.id=ps.product_id and s.login_id=l.login_id and ps_id=$item_id";

                $resulti=mysqli_query($con,$sql2);
                $rowi=mysqli_fetch_array($resulti);
                $image="../../images/".$rowi['image'];
                ?>
                <div class="cartitems">
                <a href=""><img src="../../images/<?php echo $rowi['image'] ?>">
                    <div class="dis"><h2 style="margin-left:20px;"><?php echo $rowi['prod'] ?></h2>
                    <div class="seller">Sold by <?php echo $rowi['seller'] ?></div>
                    <div class="more">Click here to learn more</div></a>
                    <div class="pr">Rs <?php echo $rowi['price']*$row['cart_qty']?></div>
                    <div class="more"><?php echo $row['cart_qty'] ?> kg</div>
                    <a href="delete_cartitems.php?id=<?php echo $row['cart_id'] ?>"><button>Delete</button></a>
                    <a href="deleteupdate.php?id=<?php echo $row['cart_id']?>&ps_id=<?php echo $row['ps_id'] ?>"><button style="width:240px;">Add to wishlist and delete from cart</button></a>
                </div>
        </div>
                    
                <?php
            }
        ?> 
    </div>
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