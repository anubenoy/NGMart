<?php
session_start();
if(isset($_SESSION['id'])){
    include("../dbconnection.php");
    $reg_id=$_SESSION['reg_id'];
    
    // cart_del_expired products

    $sqlcart="SELECT * from cart_tbl as c,product_seller_tbl as ps  where c.ps_id=ps.ps_id AND customerreg_id=$reg_id";   
    $resultcart=mysqli_query($con,$sqlcart);
     if(mysqli_num_rows($resultcart)>=1){ //proceed to buy if  cart  has atleast one item for a cust

        while($rowcart=mysqli_fetch_array($resultcart))
        {
            $cart_id=$rowcart['cart_id'];
            $cart_qty=$rowcart['cart_qty'];
            $ps_stock=$rowcart['ps_total_stock'];
            // echo $cart_qty;
            // echo $ps_stock;
				
                if($ps_stock==0)
                {
                    echo "delelted";
                    //  delete cart item if it goes out of stock
                    $sqldel="DELETE FROM cart_tbl WHERE cart_id=$cart_id";
                    mysqli_query($con,$sqldel);
                }
        }
    }

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
            
                ?>
                <a href="wishlist.php" style="margin-right:20px">Wishlist
                    <sup id="ss" style="background-color:red;border-radius:100%;z-index:3;padding:2px 4px;"><?php echo $rown['count2']?> </sup>
                </a>	
                <a href="../logout.php">Logout</a>
		
			<!-- <a href="">About us</a> -->
			
			
		</div>
	</div>	


<!-- //popup box -->
<?php 
    if(isset($_GET['alert'])){
        ?>
        <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <p>The selected items are not from the same seller. You can either delete current cart items and add products from this seller or cancel the item to add.</p>
            <center><div class="bottom_buttons">
                <a href="cart.php"><button style="color:black;background:linear-gradient( #CFD7CF 0%,#E3E3E3 45%,#D8D8D8 50%,#E3E3E3 55%,#CFD7CF 100%);">Cancel</button></a>
                <a href="delAndadd.php?seller_id=<?php echo($_GET['seller_id']) ?>&ps_id=<?php echo($_GET['ps_id']) ?>"><button style="background-color:#05CE91">Delete and Add</button></a>
            </div></center>
        </div>
        </div>
    <?php 
    }
?>

<!-- pop up box ends here  -->


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
                $cart_count=0;
            
                $sql="select count(ps_id) as count from cart_tbl where customerreg_id=$reg_id";
                $result=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($result);
                    $l="select * from cart_tbl where customerreg_id=$reg_id";
                    $r1=mysqli_query($con,$l);
                    while($row1=mysqli_fetch_array($r1)){
                        $ps=$row1['ps_id'];
                        
                        $sub="select * from product_seller_tbl where ps_id=$ps";
                        $r2=mysqli_query($con,$sub);
                        $row2=mysqli_fetch_array($r2);

                        // dynamic price entered while ordering
		                $discount=$row2['ps_discount_perct'];
                        $org_price=$row2['ps_price']; 
		                $offer_price=$org_price-($discount/100)*$org_price;
		                $total+= $offer_price*$row1['cart_qty'];
                       
		                
                        $cart_count=$row['count'];
                    }
            // ?> 
            <!-- --------------------------------- -->
                <b> Subtotal (<?php echo $row['count'] ?>) : <i style="color:brown"> &#8377 <?php echo $total ?> </i></b>
                    <?php if($cart_count>0 )
                    {?>
                        <center> <a href="deliveryAdd.php"><button> Proceed to buy </button> </a></center>
            <?php   }
                    else{ ?>
                        <center> <a href="#"><button> Proceed to buy </button> </a></center>
                        <script> alert("Cart empty! Add items to proceed!"); </script>
                   <?php } ?>
            </div>

        </div>


        <div class="head"><h3>Shopping Cart</h3><br><br></div>

        <!-- <hr> -->
        <?php
            
        $sql="select * from cart_tbl where customerreg_id=$reg_id";   
        $result=mysqli_query($con,$sql);
         if(mysqli_num_rows($result)>=1){ //proceed to buy if  cart  has atleast one item for a cust

            while($row=mysqli_fetch_array($result))
            {
                $cart_id=$row['cart_id'];
                $item_id=$row["ps_id"];
                // echo $item_id;
               
                $sql2="SELECT ps.*,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$item_id";

                $resulti=mysqli_query($con,$sql2);
                $rowi=mysqli_fetch_array($resulti);
                $image="../../images/".$rowi['ps_image'];
                $discount=$rowi['ps_discount_perct'];
                $org_price=$rowi['ps_price'];
				$offer_price=$org_price-($discount/100)*$org_price;
                // $cart_qty=$row['cart_qty'];
                // $ps_stock=$rowi['ps_total_stock'];
				
                // if($cart_qty < $ps_stock)
                // {
                ?>
                <div class="cartitems">
                    <img src="../../images/<?php echo $rowi['ps_image'] ?>">
                    <div class="dis"><h2 style="margin-left:20px;"><?php echo $rowi['prod'] ?></h2>
                    <div class="seller">Sold by <?php echo $rowi['seller'] ?></div>
                    <!-- dynamic pricing display -->
					<?php if($offer_price < $org_price)
					{?>
                        <div class="price">
                        <h4 style="color:grey; float:left;">Price : <s>&#8377 <?php echo $rowi['ps_price']; ?> </s> &nbsp;</h4>
						<h4 style="color:red;"> &#8377 <?php echo $offer_price;?> &nbsp;<label style="background-color:yellow; opacity: 0.7; width:30%; color:black"><?php echo $discount?>%  Offer</label></h4>
                        </div>
                        <div class="pr">&#8377 <?php echo $offer_price*$row['cart_qty']?></div>
			  <?php } 
			  		else{?>
                        <div class="price">
						<h4 style="color:grey;">Price : &#8377 <?php echo $rowi['ps_price'];?> </h4>
                        </div>
                        <div class="pr">&#8377 <?php echo $rowi['ps_price']*$row['cart_qty']?></div>
					   <?php }?>
                    
                    <div class="more" style="font-size:14px;">Qty :  <input type="number" name="qty" class="qty_box" value="<?php echo $row['cart_qty'] ?>" min="1" max="<?php echo $rowi['ps_total_stock']?>" onchange="updateqty(this,<?php echo $row['cart_id']?>)" style="font-size:15px;"></div>
                    <a href="delete_cartitems.php?id=<?php echo $row['cart_id'] ?>"><button>Delete</button>
                    <a href="deleteupdate.php?id=<?php echo $row['cart_id']?>&ps_id=<?php echo $row['ps_id'] ?>"><button style="width:240px;">Add to wishlist and delete from cart</button></a>
                </div>
        </div>
                    
                <?php
                // }
                // else if($ps_stock==0){
                //     //delete cart item if it goes out of stock
                //     $sqldel="DELETE FROM cart_tbl WHERE cart_id=$cart_id";
                //     mysqli_query($con,$sqldel);

                    
                // }
            }
        }
        ?> 
    </div>
 </div>
    
 <script>
    // function checkValue(sender) {
    //      let min = sender.min;
    //      let max = sender.max;
    //      // here we perform the parsing instead of calling another function
    //      let value = parseInt(sender.value);
    //      if (value>max) {
    //          value=max
    //           sender.value = max;
    //      } else if (value<min) {
    //          value=min
    //           sender.value = min;
    //      }
    // }
    function updateqty(textbox,cartid){
        let min = textbox.min;
        let max = textbox.max;
         // here we perform the parsing instead of calling another function
        let value = parseInt(textbox.value);
        if (value>max) {
            textbox.value = max;
        } else if (value<min) {
             textbox.value = min;
         }
        value= textbox.value
        // console.log(value,cartid)
        var url= "../../AJAX/cartqtyupdate.php?cartid="+cartid+"&qty="+value
        
    				var xhttp = new XMLHttpRequest();
    				xhttp.onreadystatechange = function() {
    					if (this.readyState == 4 && this.status == 200) {
    						// alert(this.responseText);
                            // console.log(this.responseText)
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