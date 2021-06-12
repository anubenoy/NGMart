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
                        $sub="select ps_price from product_seller_tbl where ps_id=$ps";
                        $r2=mysqli_query($con,$sub);
                        $row2=mysqli_fetch_array($r2);
                        $total+=$row2['ps_price']*$row1['cart_qty'];
                    }
            // ?> 
            <!-- --------------------------------- -->
                <b> Subtotal (<?php echo $row['count'] ?>) : <i style="color:brown"> Rs. <?php echo $total ?> </i></b>

               <center> <a href="deliveryAdd.php"><button onclick="item_availability()"> Proceed to buy </button> </a></center>
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
                $sql2="select *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$item_id and ps.ps_total_stock>0";

                $resulti=mysqli_query($con,$sql2);
                $rowi=mysqli_fetch_array($resulti);
                $image="../../images/".$rowi['ps_image'];
                ?>
                <div class="cartitems">
                <a href=""><img src="../../images/<?php echo $rowi['ps_image'] ?>">
                    <div class="dis"><h2 style="margin-left:20px;"><?php echo $rowi['prod'] ?></h2>
                    <div class="seller">Sold by <?php echo $rowi['seller'] ?></div>
                    <div class="more">Click here to learn more</div>
                    <div class="pr">Rs <?php echo $rowi['ps_price']*$row['cart_qty']?></div>
                    <div class="more">Quantity :  <input type="number" name="qty" class="qty_box" value="<?php echo $row['cart_qty'] ?>" min="1" max="<?php echo $rowi['ps_total_stock']?>" oninput="checkValue(this);" onchange="updateqty(this,<?php echo $row['cart_id']?>)"> </div>
                    <a href="delete_cartitems.php?id=<?php echo $row['cart_id'] ?>"><button>Delete</button></a>
                    <a href="deleteupdate.php?id=<?php echo $row['cart_id']?>&ps_id=<?php echo $row['ps_id'] ?>"><button style="width:240px;">Add to wishlist and delete from cart</button></a>
                </div>
        </div>
                    
                <?php
            }
        ?> 
    </div>
 </div>
    
 <script>
    function checkValue(sender) {
         let min = sender.min;
         let max = sender.max;
         // here we perform the parsing instead of calling another function
         let value = parseInt(sender.value);
         if (value>max) {
             value=max
              sender.value = max;
         } else if (value<min) {
             value=min
              sender.value = min;
         }
    }
    function updateqty(textbox,cartid){
        value=textbox.value
        console.log(value,cartid)
        var url= "../../AJAX/cartqtyupdate.php?cartid="+cartid+"&qty="+value
        
    				var xhttp = new XMLHttpRequest();
    				xhttp.onreadystatechange = function() {
    					if (this.readyState == 4 && this.status == 200) {
    						// alert(this.responseText);
                            console.log(this.responseText)
                            if (this.responseText == "sucess"){
                                location.reload();
                            }
    					}
    				};
    				xhttp.open("GET", url, true);
    		xhttp.send();
                
    }
    </script>




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