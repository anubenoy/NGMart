<?php
session_start();
require('pconfig.php');
include("../dbconnection.php");
if(isset($_POST['stripeToken'])){
	\Stripe\Stripe::setVerifySslCerts(false);

	$token=$_POST['stripeToken'];

	$data=\Stripe\Charge::create(array(
		"amount"=>1000,
		"currency"=>"inr",
		"description"=>"Purchase with NGMart",
		"source"=>$token,
	));

	$userid=$_SESSION['reg_id'];
	$add_id=$_SESSION['addr_id'];
	//transaction id random gen
	//transaction id random gen
	$seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
	shuffle($seed);
	$rand = '';
	foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];
	$seed2 = str_split('0123456789');
	shuffle($seed2);
	$rand2 = 0;
	foreach (array_rand($seed2, 8) as $k) $rand2 .= $seed2[$k];
	$rand=$rand.$rand2;
	
	//adding each item in cart to order tbl 
	$sql2="SELECT * FROM cart_tbl WHERE customerreg_id=$userid";
	$result2=mysqli_query($con,$sql2);
	while($row2=mysqli_fetch_array($result2))
	{
		date_default_timezone_set("Asia/Kolkata");
		$o_date=date('y-m-d h:i:s');
	   
		//checking if paid or not
		$order_status="";
		if(isset($rand)){$order_status="paid";}
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

		// dynamic price entered while ordering
		$current_price=0;
		$discount=$row3['ps_discount_perct'];
		$org_price=$row3['ps_price'];
		$offer_price=$org_price-($discount/100)*$org_price;
		
		$current_price=$offer_price;
		

		$sql7="SELECT * FROM inventory_tbl WHERE inventory_ps_id=$ps_id";
		$result7=mysqli_query($con,$sql7);
		$row7=mysqli_fetch_array($result7);
		$manufacture_date=$row7['inventory_date']; 
		$expdate=$row7['inventory_expiry_date'];
	   
		//deduct product from inventory bfr adding products to order tbl.
		$sql4="INSERT INTO inventory_tbl (inventory_ps_id,inventory_seller_id,inventory_stock,inventory_date,inventory_expiry_date,inventory_status) VALUES ($ps_id,$product_seller_id,$inventory_stock,'$manufacture_date','$expdate','0')";
		if(mysqli_query($con,$sql4))
		{
				$inventory_id=mysqli_insert_id($con);
			    $sqlsum = "SELECT SUM(inventory_stock) as sum FROM inventory_tbl WHERE inventory_ps_id = $ps_id and inventory_seller_id = $product_seller_id and inventory_status = '1'";
				$resultsum = mysqli_query($con,$sqlsum);
				$rowsum = mysqli_fetch_array($resultsum);
				$total_stock = $rowsum['sum'];
			
				$sqlsold = "SELECT ABS(SUM(inventory_stock)) as sum FROM inventory_tbl WHERE inventory_ps_id = $ps_id and inventory_seller_id = $product_seller_id and inventory_status = '0' and inventory_stock<0";
				$resultsold = mysqli_query($con,$sqlsold);
				$rowsold = mysqli_fetch_array($resultsold);
				$row_sold_number = $rowsold['sum'];
				if($row_sold_number == null){ $row_sold_number = "0" ;  };
				$remaining_stock = $total_stock - $row_sold_number;
				
				$sql6="UPDATE product_seller_tbl SET ps_total_stock = $remaining_stock  WHERE ps_id=$ps_id";
				if(mysqli_query($con,$sql6))
				{
					  // insert into order tbl cart items only if prod deducted from inventory tbl.
					$sql5="INSERT INTO order_tbl (order_transaction_id,order_date,order_status,order_customer_id,order_inventory_id,order_product_seller_id,order_ps_id,order_quantity,order_price,order_add_id) VALUES ('$rand','$o_date','$order_status',$userid,$inventory_id,$product_seller_id,$ps_id,$cart_qty,$current_price,$add_id)";
					$result5=mysqli_query($con,$sql5);
				
				}
			

		}
		else
		{
			echo "inventory_tbl insertion error!";
		}
		 
	   
	   

	}
	//echo "sucess";
	$sql="delete FROM cart_tbl WHERE customerreg_id=$userid";
	if(mysqli_query($con,$sql)){
		header("location:../cust/success.php");
	}

}
else{
	echo "transaction error";
}
?>