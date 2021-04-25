<?php
	date_default_timezone_set("Asia/Kolkata");
    include("../dbconnection.php");
    $id=$_GET['id'];

	echo '<div class="sessions"> <h4>Remaining Stock:</h4> <hr>';
		echo '<table>';
		echo '<tr>
			<th >#</th>
			<th>Item</th>
			<th>Price</th>
			<th>Stock</th>
			<th>Total Price</th>
			<th>Expiry Date</th>
			<th style="border-right: 0px solid black">Expiry Due</th>
			</tr>';
		$i=0;
		$sq1 = "select * from inventory_tbl where inventory_status=1 and inventory_seller_id='$id'";
		//an item in product_seller table will always be same but in inventory table it might appear defferent because of the different expairy and manfu date.
		$rst1 = mysqli_query($con, $sq1);
		$totalstock=0;
		$totalprice=0;
		while ($ro1 = mysqli_fetch_array($rst1)) {
			$inv_id = $ro1['inventory_ps_id'];
			$sq2 = "SELECT * FROM product_seller_tbl where ps_id='$inv_id' and ps_seller_id=$id";
			$rst2 = mysqli_query($con, $sq2);
			while ($ro2 = mysqli_fetch_array($rst2)) {
				$product_id = $ro2['ps_product_id'];
				$sq3 = "SELECT * FROM product_tbl where product_id='$product_id'";
				$rst3 = mysqli_query($con, $sq3);
				while ($ro3 = mysqli_fetch_array($rst3)) {
					$totalstock+=$ro1['inventory_stock'];
					$totalprice+=$ro2['ps_price']*$ro1['inventory_stock'];
					$i++;
					echo "<tr class='leftone'>";
					echo "<td>$i</td>";
					echo "<td >".$ro3['prod_name']."</td>";
					echo "<td >".$ro2['ps_price']."</td>";
					echo "<td >".$ro1['inventory_stock']."</td>";
					echo "<td >".$ro1['inventory_stock']*$ro2['ps_price']."</td>";
					echo "<td >".$ro1['inventory_expiry_date']."</td>";
					$expdate = new DateTime(date($ro1['inventory_expiry_date']));
					$diffBtwTodayAndExpiry = $expdate->diff(new DateTime(date('y-m-d h:i:s')));
					echo "<td style='border-right: 0px solid black'>$diffBtwTodayAndExpiry->days days $diffBtwTodayAndExpiry->h hrs $diffBtwTodayAndExpiry->i min </td>";
					echo "</tr>" ;
				}
			}
		}
		echo "<tr > <td colspan=3 class='none'>Total</td> <td class='none'>$totalstock</td> <td class='none' >$totalprice</td> </tr>";
		echo "</table>";
	echo '</div>';


	// second section
	echo '<div class="sessions"> <h4>Expaired Stock:</h4> <hr>';
		echo '
		<table>
		<tr>
			<th style="padding:10px 20px">#</th>
			<th style="padding:10px 20px">Item</th>
			<th style="padding:10px 20px">Price</th>
			<th style="padding:10px 20px">Stock</th>
			<th style="padding:10px 20px">Total Price</th>
			<th style="padding:10px 20px">Expiry Date</th>
			<th style="border-right: 0px solid black; padding:10px 20px">Expired</th>
		</tr>';
		$totalstock=0;
		$totalprice=0;
		$sql2="SELECT * FROM inventory_tbl WHERE inventory_status=0";
		$result2=mysqli_query($con,$sql2);
		while($row2=mysqli_fetch_array($result2))
		{
			$ps_id=$row2['inventory_ps_id'];
			$expdate = new DateTime(date($row2['inventory_expiry_date']));
			$diffBtwTodayAndExpiry = $expdate->diff(new DateTime(date('y-m-d h:i:s')));
			
			$sql4="SELECT sum(inventory_stock) as s FROM inventory_tbl GROUP BY inventory_date,inventory_ps_id";
			$result4=mysqli_query($con,$sql4);
			$row4=mysqli_fetch_array($result4);

			$sql3="SELECT DISTINCT ps.ps_id,p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id and  ps.ps_seller_id=$id and ps.ps_id=$ps_id order by p.product_id desc";
			if($result3=mysqli_query($con,$sql3))
			{
				$i=0;
				while($row=mysqli_fetch_array($result3))
				{	
					$totalstock+=$row4['s'];
					$totalprice+=$row4['s']*$row['ps_price'];
					$i=$i+1;
					?>
					<tr>
					<td style="padding:10px 20px"><?php echo $i?></td>
					<td style="padding:10px 20px"><?php echo $row['prod_name']?></td>
					<td style="padding:10px 20px"><?php echo $row['ps_price']?></td>
					<td style="padding:10px 20px"><?php echo $row2['inventory_stock'] //actually display sum of stock of same ps_id and manu_date?> </td> 
					<td style="padding:10px 20px"><?php echo $row4['s']*$row['ps_price']?></td>
					<td style="padding:10px 20px"><?php echo $row2['inventory_expiry_date']?></td>
					<td style="border-right: 0px solid black; padding:10px 20px"><?php echo $diffBtwTodayAndExpiry->days.' days' ?></td>
					
					</tr>                        
				
				<?php
						
				}
			}
		}
		echo "<tr > <td colspan=3 class='none' style='padding:10px 20px'>Total</td> <td class='none' style='padding:10px 20px'>$totalstock</td> <td class='none' style='padding:10px 20px' >$totalprice</td> </tr>";

		echo '</table> ';

	echo '</div>'
?>