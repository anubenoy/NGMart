<?php
session_start();
if(isset($_SESSION['id']))
{
	date_default_timezone_set("Asia/Kolkata");
	$id=$_SESSION['id'];
	include("../dbconnection.php");
	del();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Orders</title>
</head>
    <link href="../../style/style.css" rel="stylesheet" />
	<link href="../../style/seller_style.css" rel="stylesheet" />
	<style>
		.order_table a{
			text-decoration: underline;
			color:rgb(9, 188, 219);
		}
		.addInput .p{
			margin:17px 0px 0px 7px;
			width:90px;
			position:relative;
			float:right;
			font-size: 13px;
			color:black;
			/* background-color: brown; */

		}
		td{
			font-size:15px;
		}
		.topgreen_right button{
			background-color: rgba(255, 255, 255, 0);
			padding:10px;
			border-radius: 9px;
			border: .5px solid green ;
			color:white;
			cursor: pointer;
			margin:2px;
			transition: .2s ease-in-out;
		}
		.topgreen_right button:hover{
			padding: 12px;
			margin:0px;
			color:rgb(250, 250, 250);
		}

	</style>
<body>
<div class="topblack">
		<div class="leftblock"><p>For enquiry call 123 | email on <a style="color:rgba(255, 255, 255, 0.851);" href="mailto:admin@gmail.com"> admin@gmail.com </a></p></div>
		<div class="rightblack">
		<?php 
         $sql="SELECT * FROM login_tbl WHERE login_id=$id";
         $result=mysqli_query($con,$sql);
         $row=mysqli_fetch_array($result);                
        ?>
        <p style="float:right;padding:1%;"><?php echo $row['email'];?></p> 		
		</div>
	</div>

	<div class="topbargreen">
		<p><a href="seller.php?id=-1" style="color:white;"> NGMART</a></p>
		<div class="topgreen_right" style="margin-right:140px;">
		<a href="product_review.php?id=1">Complaints</a>
		<a href="../logout.php">Logout</a>	
		</div>
	</div>
	<div class="topbar_bottom">
		<center>
			<a href="shopOrders.php?id=1" <?php if($_GET['id']==1) echo"class=active" ?>>All</a>
			<a href="shopOrders.php?id=2" <?php if($_GET['id']==2) echo"class=active" ?>>Pending</a>
			<a href="shopOrders.php?id=3" <?php if($_GET['id']==3) echo"class=active" ?>>Cancelled</a>
			<a href="shopOrders.php?id=4" <?php if($_GET['id']==4) echo"class=active" ?>>Delivered</a>
			
		</center>
	</div>
<!-- ------------------------------------------top nav bar done ------------------------------------------------->
<?php
if($_GET['id']==1)
{?>
	<div class="order_table" style="padding:26px 26px;"><center>

	    	 <!-- listing all orders -->

	    <table width="100%">
			 <col style="width:4%">
			 <col style="width:15%">
			 <col style="width:13%">
			 <!-- <col style="width:10%"> -->
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:10%">
			 <!-- <col style="width:15%"> -->

	      <thead>
	      <caption >
			  <h3 > Orders recieved</h3>
	      </caption>
		  <tr>
			 <th>#</th>
			 <th>Order No.</th>
		     <th>Order Date</th>
			 <th>Customer</th>
			 <!-- <th>Payment Method</th> -->
			 <th>Retail Price</th>
			 <th>Order Status</th>
			 <th>Order Qty</th>
			 <th>Subtotal</th>
		     
	      </tr>
		  </thead>

	      <tbody> 
			<?php
		  	$i=0;
			  $sql="SELECT * FROM order_tbl";
			  $result= mysqli_query($con,$sql);
			  while($orders=mysqli_fetch_array($result))
			  {
				$ps_id=$orders['order_ps_id'];
				$sql2="SELECT *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$ps_id";
				$result2= mysqli_query($con,$sql2);
				$prod=mysqli_fetch_array($result2);

				$cust_id=$orders['order_customer_id'];
				$sql3="SELECT * FROM customerreg_tbl WHERE customerreg_id=$cust_id";
				$result3=mysqli_query($con,$sql3);
	            $cust=mysqli_fetch_array($result3);     
	            
				$i++;
				echo "<tr>";
				echo "<td>$i</td>";
				echo "<td style='text-decoration: underline; color:rgb(9, 188, 219);' onclick='displayOrderDetails(".$orders['order_id'].");'>#".$orders['order_transaction_id']."</td>";
				echo "<td>".$orders['order_date']."</td>";
				echo "<td>".$cust['name']."</td>";
				// echo "<td>"."COD"."</td>";
				echo "<td>".'₹'.$orders['order_price']."</td>";
				echo "<td>".$orders['order_status']."</td>";
				echo "<td>".$orders['order_quantity']."</td>";
				echo "<td>".'₹'.$orders['order_quantity']*$orders['order_price']."</td>";
				?>
				</tr>
			 <?php
			 }
			?>
	       </tbody>
	    </table></center>
	</div>

	
 <?php
}
?>

	<?php if($_GET['id']==3){?>
	
		<div style="padding:26px 26px;"><center>

<!-- listing all  cancelled orders -->

<table width="100%">
<col style="width:4%">
<col style="width:15%">
<col style="width:13%">
<!-- <col style="width:10%"> -->
<col style="width:10%">
<col style="width:10%">
<col style="width:10%">
<col style="width:10%">
<col style="width:10%">
<col style="width:15%">

<thead>
<caption >
 <h3 > Orders recieved</h3>
</caption>
<tr>
<th>#</th>
<th>Order No.</th>
<th>Order Date</th>
<th>Customer</th>
<!-- <th>Payment Method</th> -->
<th>Retail Price</th>
<th>Order Status</th>
<th>Order Qty</th>
<th>Subtotal</th>
<th> </th>	
</tr>
</thead>

<tbody> 
	<?php
	 $i=0;
	 $sql="SELECT * FROM order_tbl WHERE order_status='cancelled'";
	 $result= mysqli_query($con,$sql);
	 while($orders=mysqli_fetch_array($result))
	 {
	   $ps_id=$orders['order_ps_id'];
	   $sql2="SELECT *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$ps_id";
	   $result2= mysqli_query($con,$sql2);
	   $prod=mysqli_fetch_array($result2);

	   $cust_id=$orders['order_customer_id'];
	   $sql3="SELECT * FROM customerreg_tbl WHERE customerreg_id=$cust_id";
	   $result3=mysqli_query($con,$sql3);
	   $cust=mysqli_fetch_array($result3);     
	
	   $i++;
	   echo "<tr>";
	   echo "<td>$i</td>";
	   echo "<td class='order_id' onclick='displayOrderDetails(".$orders['order_id'].");'>#".$orders['order_transaction_id']."</td>";
	   echo "<td>".$orders['order_date']."</td>";
	   echo "<td>".$cust['name']."</td>";
	   // echo "<td>"."COD"."</td>";
	   echo "<td>".'₹'.$orders['order_price']."</td>";
	   echo "<td>".$orders['order_status']."</td>";
	   echo "<td>".$orders['order_quantity']."</td>";
	   echo "<td>".'₹'.$orders['order_quantity']*$orders['order_price']."</td>";
	   ?>
		   <td>
		   	   <a href="?id=<?php echo $orders['order_id']; ?>&ps_id=<?php echo $orders['order_ps_id']; ?>"><button style="background-color:#3366ff;padding:7px;border:none;color:white;">Refund</button></a>
		   </td>
	   </tr>
	<?php
	}
	?>
</tbody>
</table></center>
</div>

	<?php
	}
	?>
	
<?php
if($_GET['id']==2)
{?>
	<div style="padding:26px 26px;"><center>

	    	 <!-- listing all pending orders -->

	    <table width="100%">
			 <col style="width:4%">
			 <col style="width:15%">
			 <col style="width:13%">
			 <!-- <col style="width:10%"> -->
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:15%">

	      <thead>
	      <caption >
			  <h3 > Orders recieved</h3>
	      </caption>
		  <tr>
			 <th>#</th>
			 <th>Order No.</th>
		     <th>Order Date</th>
			 <th>Customer</th>
			 <!-- <th>Payment Method</th> -->
			 <th>Retail Price</th>
			 <th>Order Status</th>
			 <th>Order Qty</th>
			 <th>Subtotal</th>
		     <th> </th>	
	      </tr>
		  </thead>

	      <tbody> 
			<?php
		  	$i=0;
			  $sql="SELECT * FROM order_tbl WHERE order_status='paid'";
			  $result= mysqli_query($con,$sql);
			  while($orders=mysqli_fetch_array($result))
			  {
				$ps_id=$orders['order_ps_id'];
				$sql2="SELECT *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$ps_id";
				$result2= mysqli_query($con,$sql2);
				$prod=mysqli_fetch_array($result2);

				$cust_id=$orders['order_customer_id'];
				$sql3="SELECT * FROM customerreg_tbl WHERE customerreg_id=$cust_id";
				$result3=mysqli_query($con,$sql3);
	            $cust=mysqli_fetch_array($result3);     
	            
				$i++;
				echo "<tr>";
				echo "<td>$i</td>";
				echo "<td onclick='displayOrderDetails(".$orders['order_id'].");'>#".$orders['order_transaction_id']."</td>";
				echo "<td>".$orders['order_date']."</td>";
				echo "<td>".$cust['name']."</td>";
				// echo "<td>"."COD"."</td>";
				echo "<td>".'₹'.$orders['order_price']."</td>";
				echo "<td>".$orders['order_status']."</td>";
				echo "<td>".$orders['order_quantity']."</td>";
				echo "<td>".'₹'.$orders['order_quantity']*$orders['order_price']."</td>";
				?>
					<td>
						<a href="cancelOrder.php?o_id=<?php echo $orders['order_id']; ?>"><button style="background-color:#ff3300;padding:7px;border:none;color:white;">Cancel</button></a>
						<a href="deliveredOrder.php?id=<?php echo $orders['order_id']; ?>"><button style="background-color:#3366ff;padding:7px;border:none;color:white;">Delivered</button></a>
					</td>
				</tr>
			 <?php
			 }
			?>
	       </tbody>
	    </table></center>
	</div>	
 <?php
}
?>
<?php
if($_GET['id']==4)
{?>
	<div style="padding:26px 26px;"><center>

	    	 <!-- listing all delivered orders -->

	    <table width="100%">
			 <col style="width:4%">
			 <col style="width:15%">
			 <col style="width:13%">
			 <!-- <col style="width:10%"> -->
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:10%">
			 <col style="width:15%">

	      <thead>
	      <caption >
			  <h3> Orders recieved</h3>
	      </caption>
		  <tr>
			 <th>#</th>
			 <th>Order No.</th>
		     <th>Order Date</th>
			 <th>Customer</th>
			 <!-- <th>Payment Method</th> -->
			 <th>Retail Price</th>
			 <th>Order Status</th>
			 <th>Order Qty</th>
			 <th>Subtotal</th>
		     <th> </th>	
	      </tr>
		  </thead>

	      <tbody> 
			<?php
		  	$i=0;
			  $sql="SELECT * FROM order_tbl WHERE order_status='delivered'";
			  $result= mysqli_query($con,$sql);
			  while($orders=mysqli_fetch_array($result))
			  {
				$ps_id=$orders['order_ps_id'];
				$sql2="SELECT *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$ps_id";
				$result2= mysqli_query($con,$sql2);
				$prod=mysqli_fetch_array($result2);

				$cust_id=$orders['order_customer_id'];
				$sql3="SELECT * FROM customerreg_tbl WHERE customerreg_id=$cust_id";
				$result3=mysqli_query($con,$sql3);
	            $cust=mysqli_fetch_array($result3);     
	            
				$i++;
				echo "<tr>";
				echo "<td>$i</td>";
				echo "<td onclick='displayOrderDetails(".$orders['order_id'].");'>#".$orders['order_transaction_id']."</td>";
				echo "<td>".$orders['order_date']."</td>";
				echo "<td>".$cust['name']."</td>";
				// echo "<td>"."COD"."</td>";
				echo "<td>".'₹'.$orders['order_price']."</td>";
				echo "<td>".$orders['order_status']."</td>";
				echo "<td>".$orders['order_quantity']."</td>";
				echo "<td>".'₹'.$orders['order_quantity']*$orders['order_price']."</td>";
				?>
					<td>
						<a href="productReview.php?id=<?php echo $orders['order_id']; ?>&ps_id=<?php echo $orders['order_ps_id']; ?>"><button style="background:linear-gradient(to bottom right, rgb(240, 120, 55),rgb(242, 85, 73));padding:7px;border:none;color:white;width:120px;">Product Review</button></a>
					</td>
				</tr>
			 <?php
			 }
			?>
	       </tbody>
	    </table></center>
	</div>	
 <?php
}
?>

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" id="returning_data">
    <!-- <span class="close">&times;</span> -->

	<!-- data pack  -->
	<!-- <img src="../../images/veg1.png" alt="">
	<table width=100% style="margin-bottom:10px; border:none">
		<tr>
			<div class="shipping_add">
				<p>ORDER-ID: #</p>
			</div>
		</tr>
		<tr>
			<td>
				<div class="product_details">
					<p>Product name</p>
					<p>₹20</p>

				</div>
			</td>
			<td>
				<div class="shipping_add">
					<p><b>Shipping Address:</b></p>
					<p>alansmathew,</p>
					<p>kanjirakattu (H),</p>
					<p>kadayanickadu (po),</p>
					<p>ullayam, kottayam, kerala</p>
				</div>
			</td>
		</tr>
	</table> -->

	<!-- data pack  -->

  </div>

</div>


<script>

var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];
	// When the user clicks on <span> (x), close the modal
function closediv() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// ajax here 
function displayOrderDetails(x) {
	var url = "../../AJAX/viewOrder.php?&o_id=" + x;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(this.responseText != false){
				modal.style.display = "block";
				document.getElementById('returning_data').innerHTML=this.responseText;
			}
			else{
				console.log("something went wrong!!")
			}
		}
	};
	xhttp.open("GET", url, true);
	xhttp.send();
}


</script>

</body>
</html>
<?php  }
	else
 	{ ?>
		<script>
		alert("Already Logout! \n Login to continue.");
		window.location.href="../../login_reg.php";
		</script>
		
	<?php
	} ?>