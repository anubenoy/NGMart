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
		<div class="leftblock"><p>For enquiry call 911 | email on <a style="color:rgba(255, 255, 255, 0.851);" href="mailto:admin@gmail.com"> admin@gmail.com </a></p></div>
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
		<p>NGMART</p>
		<div class="topgreen_right" style="margin-right:140px;">
		<a href="shopOrders.php">Orders</a>
		<a href="../logout.php">Logout</a>	
		</div>
	</div>
<div style="padding:26px 26px;">
	<center>
	
    	 <!-- listing all orders -->
	
    <table width="100%">
		 <col style="width:4%">
		 <col style="width:8%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:6%">
		 <col style="width:10%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:14%">
		 <col style="width:10%">
		 <col style="width:10%">


	
      <thead>
      <caption >
		  <h3 > Orders</h3>
      </caption>
	  
	  <tr>
		 <th>#</th>
		 <th>Image</th>
	     <th>Item</th>
		 <th>Price</th>
		 <th>Quatity</th>
		 <th>Order Price</th>
		 <th>Total Price</th>
		 <th>Order Date</th>
		 <th>Shipping Address</th>
		 <th>Order Status</th>
	     <th> </th>	
      </tr>
	  </thead>
        
      <tbody> 
	  
	  
	
        
       </tbody>
    </table>

    	 </center>
</div>

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