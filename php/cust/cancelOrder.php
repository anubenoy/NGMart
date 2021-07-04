<?php
include("../dbconnection.php");
$o_id=$_GET['o_id'];

  // update order tbl cart items status to cancelled.
  $sql1="UPDATE order_tbl SET order_status='cancelled' WHERE order_id=$o_id;";
  if(mysqli_query($con,$sql1))
  {
      $sql2="SELECT * FROM order_tbl WHERE order_id=$o_id";
      $result2=mysqli_query($con,$sql2);
      $order=mysqli_fetch_array($result2);
      $ps_id=$order['order_ps_id'];
      $product_seller_id=$order['order_product_seller_id'];
      $inventory_stock=$order['order_quantity'];
      $inventory_id=$order['order_inventory_id'];
      
      $sql3="SELECT * FROM inventory_tbl WHERE inventory_ps_id=$ps_id";
      $result3=mysqli_query($con,$sql3); 
      $row3=mysqli_fetch_array($result3); 
      $o_date=$row3['inventory_date']; 
      $expdate=$row3['inventory_expiry_date'];
      
      //update product qty to back inventory.
       $sql4="UPDATE inventory_tbl SET inventory_status='c' WHERE inventory_id=$inventory_id";
       if(mysqli_query($con,$sql4))
       {
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

           $sql5="UPDATE product_seller_tbl SET ps_total_stock = $remaining_stock  WHERE ps_id=$ps_id";
           if(mysqli_query($con,$sql5)){header("location:orderHistory.php");}
         }
  }
else
{
    echo "error!";
}
?>