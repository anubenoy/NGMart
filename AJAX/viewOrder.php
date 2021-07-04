<?php
include("../php/dbconnection.php");
$o_id=$_GET['o_id'];
// $o_id=1;
$sql="SELECT * FROM order_tbl WHERE order_id=$o_id";
$result=mysqli_query($con,$sql);
while($orders=mysqli_fetch_array($result)){
    
            $ps_id=$orders['order_ps_id'];
			$sql2="SELECT *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$ps_id";
			$result2= mysqli_query($con,$sql2);
			$prod=mysqli_fetch_array($result2);

			$addr_id=$orders['order_add_id'];
			$sql3="SELECT * FROM address_tbl WHERE add_id=$addr_id";
			$result3=mysqli_query($con,$sql3);
            $addr=mysqli_fetch_array($result3);     
            // $country_id=$addr['add_country_id'];
            // $state_id=$addr['add_state_id'];
            $cities_id=$addr['add_cities_id'];
			
                   
            $sql4="SELECT co.*,st.*,ci.* FROM countries_tbl AS co,states_tbl AS st,cities_tbl AS ci WHERE ci.cities_state_id=st.state_id AND ci.cities_country_id=co.country_id AND ci.cities_id=$cities_id ";
            // $sql2="SELECT * FROM countries_tbl WHERE country_id=$country_id";
            $result4=mysqli_query($con,$sql4);
            $row4=mysqli_fetch_array($result4);

            // data pack  
            
            echo "<span class='close' onclick='closediv()'>&times;</span>";
            echo "<center><img src='../../images/".$prod['ps_image']."' alt=''></center>";
            echo "<table width=100% style='margin-bottom:10px; border:none'>";
            echo"<tr><th colspan = 2> Order-ID: #".$orders['order_transaction_id']."</th></tr>";
            echo "<tr><td><div class='product_details'>";
			echo "<p><b>".$prod['prod_name']."</b></p>";
            if($prod['ps_price']!=$orders['order_price']){
                echo "<p style='font-size:17px;'><s style='color:grey; font-size:15px;'>₹".$prod['ps_price']."</s> ₹".$orders['order_price']."</p>";
            }else{
                echo "<p style='font-size:18px;'>₹".$prod['ps_price']."</p>";
            }
			
			echo "<p style='font-size:17px;'>Qty:".$orders['order_quantity']."</p>";
			// echo "<td>".$orders['order_quantity']*$orders['order_price']."</td>";
			// echo "<td>".$orders['order_date']."</td>";
			// echo "<td>".$orders['order_status']."</td>";
            echo "</div></td>";

            echo "<td><div class='shipping_add'>";
            echo "<p><b>Shipping Address:</b></p>";
            echo "<p>".$addr['add_full_name']."</p>";
            echo "<p>".$addr['add_house_name']."</p>";
            echo "<p>".$addr['add_area']."</p>";
            echo "<p>".$row4['cities_name'].",".$row4['state_name']."</p>";
            echo "<p>".$addr['add_pincode'].",".$row4['country_name']."</p>";
            echo "<p>".$addr['add_mobile_no']."</p>";
            
            
            echo "</div></td></tr><table>";

}
// <!-- data pack  -->
// 	<img src="../../images/veg1.png" alt="">
	// <table width=100% style="margin-bottom:10px; border:none">
	// 	<tr>
	// 		<div class="shipping_add">
	// 			<p>ORDER-ID: #</p>
	// 		</div>
	// 	</tr>
	// 	<tr>
	// 		<td>
	// 			<div class="product_details">
	// 				<p>Product name</p>
	// 				<p>₹20</p>
	// 				<!-- <p> 25/12/21</p> -->
	// 			</div>
	// 		</td>
	// 		<td>
	// 			<div class="shipping_add">
	// 				<p><b>Shipping Address:</b></p>
	// 				<p>alansmathew,</p>
	// 				<p>kanjirakattu (H),</p>
	// 				<p>kadayanickadu (po),</p>
	// 				<p>ullayam, kottayam, kerala</p>
	// 			</div>
	// 		</td>
	// 	</tr>
	// </table>

// 	<!-- data pack  -->
?>