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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home page</title>
	<link href="../../style/style.css" rel="stylesheet" />
	<link href="../../style/seller_style.css" rel="stylesheet" />
	<style>
		.addInput .p{
			margin:17px 0px 0px 7px;
			width:90px;
			position:relative;
			float:right;
			font-size: 13px;
			color:grey;
			white-space: nowrap;
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
</head>
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
		<?php 
		if($_GET['id']==-1){
			echo '<a href="../reportGen/pdf.php?from=view&id=<?php echo $id?>" target="new"><button> View PDF </button></a>
				<a href="../reportGen/pdf.php?from=download&id=<?php echo $id?>" target="new"><button> Download PDF</button></a>';
		}
		?>
		<a href="shopOrders.php?id=1">Orders</a>
		<a href="../logout.php">Logout</a>	
		</div>
	</div>

	<div class="topbar_bottom">
		<center>
			<a href="seller.php?id=-2" <?php if($_GET['id']==-2) echo"class=active" ?> >Dashboard</a>
			<a href="seller.php?id=-1" <?php if($_GET['id']==-1) echo"class=active" ?> >Inventory</a>
			<?php
			$sql="select * from categories_tbl where status=1";
			if($result=mysqli_query($con,$sql))
			{
				while($row=mysqli_fetch_array($result))
				{
					?>
					<a href="seller.php?id=<?php echo $row['id'] ?>" <?php if($row['id']==$_GET['id']) echo "class=active"; ?> > <?php echo $row['categories'] ?> </a>
			
				<?php
				}
		}
		?>
		</center>
	</div>
<!-- ------------------------------------------top nav bar done ------------------------------------------------->

<?php
if(isset($_GET['ps_id']))
{ 
	$ps_id=$_GET['ps_id'];
?>
	
	<div class="additembox">
	<div class="left">
	
	<!-- edit product form -->
	<form id="addProduct" action="editProduct.php?id=<?php echo $ps_id ?>" method="POST" style="padding:20px;" enctype="multipart/form-data">
		<?php
		$ps_id=$_GET['ps_id'];
		$sql="select p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id and ps_id=$ps_id";

		if($result=mysqli_query($con,$sql))
		{
			$row=mysqli_fetch_array($result);
		}

		?>
		<div >
				
					<img src="../../images/<?php echo $row['ps_image']?>" class="img" alt="no image">
					<div onclick="upload()" class="img_upload"><center><p style="color:white;font-size:15px;">Upload an image</p></center></div>
                	<input id="upload" style="visibility:hidden;cursor:pointer" type="FILE" accept="image/x-png,image/jpeg" name='file'>

				</div>
		</div>
		<script>
	
			function upload(){
				document.getElementById('upload').click();
			}

			function update_discount(perct,input_ps_id){
				let discount_perct = parseInt(perct.value);
				let org_price = document.getElementById('price').value;
				let discount_price = 1;
				discount_price = org_price-(discount_perct/100*org_price);
				
				var url= "../../AJAX/discount_update.php?ps_id="+input_ps_id+"&perct="+discount_perct
        
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						if (this.responseText == "success"){
							document.getElementById('discount_price').value= discount_price;
						}
					}
				};
				xhttp.open("GET", url, true);
				xhttp.send();
			}
		
		</script>


	<div class="right" style="margin-top:60px;">
		
	<form id="addProduct" action="editProduct.php?id=<?php echo $cat_id?>" method="POST" style="padding:20px;" enctype="multipart/form-data">

		<label class="labels"> Product Name :</label> 
		<div class="addInput">
			<input type="text" id="name" name="name" value="<?php echo $row['prod_name']?>" pattern="[A-Za-z\-\s]{3,}" disabled>
		</div> <br>

		<label class="labels"> Orginal Price :</label> 
		<label class="labels" style="margin-left:26px;">Offer Price :</label>
		<div class="addInput" >	
		<div class="p">Rupees</div>
			<input type="text" style="width:83px" name="price" id="price" min="1" value="<?php echo $row['ps_price']?>" pattern="^\d+(\.\d{1,2})?" required>
		
			<input type="text" style="width:83px" name="discount_price" id="discount_price" min="1" value="<?php echo $row['ps_price']-($row['ps_discount_perct']/100*$row['ps_price'])?>" pattern="^\d+(\.\d{1,2})?" disabled>
		</div> <br>

		<label class="labels">Discount Percentage (eg: 10%) :</label> 
		<div class="addInput" >
		<div class="p">%</div>
			<input type="text" style="width:200px" name="discount_perct" id="discount_perct" value="<?php echo $row['ps_discount_perct']?>" onblur="update_discount(this,<?php echo $ps_id ?>)" pattern="^[0-9]+$">
		</div> <br>

		<label class="labels">Remaining Stock :</label> 
		<div class="addInput" >
		<div class="p">Bundles </div>
			<input type="text" style="width:200px" name="qty" id="qty" min="1" value="<?php echo $row['ps_total_stock']?>" pattern="^[0-9]+$" disabled>
		</div> <br>

		<label class="labels">Product Desc:</label> 
		<div class="addInput">
			<input type="text" name="desc" id="desc" value="<?php echo $row['ps_desc']?>" pattern="[A-Za-z0-9\s\.\-]{3,}" required> 
		</div> 
		

		<input type="submit" class="btn" value="Edit Product">
	</form>
	<div style="color:red; float:right">Can't update stock since it will clash with product expiry only can be added as new product stock in add products interface</div>

	</div>

	</div>

<?php 
}
//-------------------------------- edit seller products-------------------------------->
else
{

if($_GET['id'] >= 1)
{ ?>

	<div class="additembox">
	<div class="left">
		<?php
		$cat_id=$_GET['id'];
		$sql="select * from categories_tbl where id=$cat_id and status=1";
		if($result=mysqli_query($con,$sql))
		{
			$row=mysqli_fetch_array($result);
		}

		?>
		<div class="img_sec">
				<img src="../../images/<?php echo $row['image']?>" class="img" alt="no image">
		</div>
	</div>


	<div class="right" style="margin-top:40px;">
		<!-- add product form -->
	<form id="addProduct" action="addProduct.php?id=<?php echo $cat_id?>" method="POST" style="padding:20px;" enctype="multipart/form-data">
		
		<div class="addInput">
			<input type="text" id="name" name="name" placeholder="Product name (eg:Carrot 1kg)" pattern="[A-Za-z0-9\s\-]{3,}" required>
		</div> 

		<div class="addInput">
		<div class="p">Rupees</div>
			<input type="number" style="width:200px" name="price" id="price" min="1" placeholder="Price" required>
		</div> 
		
		<div class="addInput">
		<div class="p">Bundles</div>
			<input type="number" style="width:200px" name="qty" id="qty" min="1" placeholder="Available Stock" required>
		</div> 

		<div class="addInput">
			<input type="text" name="desc" id="desc" placeholder="Short description" pattern="[A-Za-z0-9\s\.\-]{3,}" required> 
		</div> 
		
		<div class="addInput">
			<input type="FILE" name="file" id="file" accept="image/x-png,image/jpeg" required>
		</div>

		<input type="submit" class="btn" value="Add Product">
	</form>
	</div>

	</div>

<?php 
 }
}
	// <!-- -------------------sellers's add product- daily invntory(del inventory) done--------------------->

if($_GET['id'] == -1)
{ 
?>
<div style="padding:26px 26px;">
	<center>
	
    	 <!-- listing all products -->
	
    <table width="100%">
		 <col style="width:4%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:6%">
		 <col style="width:10%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:10%">
		 <col style="width:14%">


	
      <thead>
      <caption>
		  <h3> Inventory </h3>
      </caption>
	  
	  <tr>
		 <th>#</th>
		 <th>Image</th>
	     <th>Item</th>
		 <th>Price</th>
		 <th>Stock</th>
		 <th>Desc</th>
		 <th>Total Price</th>
		 <th>Manufacture Date</th>
		 <th>Expiry Date</th>
		 <th>Expiry Due</th>
	     <th> </th>	
      </tr>
	  </thead>
	  
      <tbody> 
	  
	  <?php
		$i=0;
		$sq1 = "select * from inventory_tbl where inventory_status='1' and inventory_seller_id='$id'";
		//an item in product_seller table will always be same but in inventory table it might appear defferent because of the different expairy and manfu date.
		$rst1 = mysqli_query($con, $sq1);
		while ($ro1 = mysqli_fetch_array($rst1)) {
			// echo $ro1['inventory_ps_id'];
			$inv_id = $ro1['inventory_ps_id'];
			$sq2 = "SELECT * FROM product_seller_tbl where ps_id='$inv_id' and ps_seller_id=$id";
			$rst2 = mysqli_query($con, $sq2);

			while ($ro2 = mysqli_fetch_array($rst2)) {
				$product_id = $ro2['ps_product_id'];
				$offer_price=$ro2['ps_price']-($ro2['ps_discount_perct']/100*$ro2['ps_price']);
				$sq3 = "SELECT * FROM product_tbl where product_id='$product_id'";
				$rst3 = mysqli_query($con, $sq3);

				while ($ro3 = mysqli_fetch_array($rst3)) {
					
					$i++;
					// echo $ro3['prod_name'];
					echo "<tr>";
					echo "<td>$i</td>";
					echo "<td><img src='../../images/".$ro2['ps_image']."' style='border-radius:50%;height:40px;width:40px;' /></td>";
					echo "<td>".$ro3['prod_name']."</td>";
					if($offer_price!=$ro2['ps_price']){		echo "<td><s><h5 style='color:grey;'>".'₹'.$ro2['ps_price']."</h5></s> ₹".$offer_price."</td>";
					}else{	echo "<td>".'₹'.$ro2['ps_price']."</td>";
					}
					echo "<td>".$ro2['ps_total_stock']."</td>";
					echo "<td>".$ro2['ps_desc']."</td>";
					echo "<td>".'₹'.$ro2['ps_total_stock']*$ro2['ps_price']."</td>";
					echo "<td>".$ro1['inventory_date']."</td>";
					echo "<td>".$ro1['inventory_expiry_date']."</td>";
					$expdate = new DateTime(date($ro1['inventory_expiry_date']));
					$diffBtwTodayAndExpiry = $expdate->diff(new DateTime(date('y-m-d h:i:s')));
					echo "<td>$diffBtwTodayAndExpiry->days days $diffBtwTodayAndExpiry->h hrs $diffBtwTodayAndExpiry->i min </td>";

				?>
				<td>
					<a href="?id=<?php echo $ro3['prod_categories_id']; ?>&ps_id=<?php echo $ro2['ps_id']; ?>"><button style="background-color:green;padding:7px;border:none;color:white;">Edit</button></a>
					<a href="delProduct.php?delete=true&id=<?php echo $ro1['inventory_id'].'&ps_id='.$inv_id ?>"><button style="background-color:red;padding:7px;border:none;color:white;">Delete</button></a>
				</td>
				</tr>
				<?php
			}
		}
	}
	?>
            
    </tbody>
    </table>
	<br><br>
	<!-- listing expired products  -->

	<table width="100%">
		 <col style="width:4%">
		 <col style="width:12%">
		 <col style="width:15%">
		 <col style="width:11%">
		 <col style="width:8%">
		 <col style="width:10%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:12%">


	
      <thead width="100%">
      <caption width="100%">
		  <h3 width="100%"> Expired & Unsold products</h3>
      </caption>
	  
	  <tr>
		 <th>#</th>
		 <th>Image</th>
	     <th>Item</th>
		 <th>Price</th>
		 <th>Stock</th>
		 <th>Total price</th>
		 <th>Manufacture Date</th>
		 <th>Expiry Date</th>
		 <th>Expired</th>
	     <th> </th>	
      </tr>
	  </thead>
	  
      <tbody> 
	  <?php
	  $i=0;
	  $sql2="SELECT *,sum(inventory_stock) as s FROM inventory_tbl WHERE inventory_status='0' GROUP BY inventory_expiry_date,inventory_ps_id";
	  $result2=mysqli_query($con,$sql2);
	  while($row2=mysqli_fetch_array($result2))
	  {
		  if($row2['inventory_stock']>0)
		  {
			$ps_id=$row2['inventory_ps_id'];
			$expdate = new DateTime(date($row2['inventory_expiry_date']));
			$diffBtwTodayAndExpiry = $expdate->diff(new DateTime(date('y-m-d h:i:s')));
			
			$sql3="SELECT DISTINCT ps.ps_id,p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id and  ps.ps_seller_id=$id and ps.ps_id=$ps_id  order by p.product_id desc";
        	if($result3=mysqli_query($con,$sql3))
        	{
			
        	    while($row=mysqli_fetch_array($result3))
        	    {
				
        	        $i=$i+1;
        	        ?>
        	        <tr>
					 <td><?php echo $i?></td>
					 <td><img src="../../images/<?php echo $row['ps_image']?>" style="border-radius:50%;height:40px;width:40px;"/></td>
        	         <td><?php echo $row['prod_name']?></td>
        	         <td><?php echo '₹'.$row['ps_price']?></td>
					 <td><?php echo $row2['s'] //actually display sum of stock of same ps_id and manu_date?> </td> 
					 <td><?php echo '₹'.$row2['s']*$row['ps_price']?></td>
        	         <td><?php echo $row2['inventory_date']?></td>
					 <td><?php echo $row2['inventory_expiry_date']?></td>
					 <td><?php echo $diffBtwTodayAndExpiry->days.' days' ?></td>

				
        	         <!-- <td><?php echo $row4['s']*$row['ps_price']?></td> -->

        	        <td> 
        	        <!-- edit button -->
        	         <button style="background-color:grey;padding:7px;border:none;color:white;">Edit</button>
        	        <!-- delete button -->
        	         <button style="background-color:grey;padding:7px;border:none;color:white;">Delete</button>
        	        </td>

					</tr>                        
				
				<?php
	
        	    }
			}
		  }
		
	}
		
        ?> 
	
        
            </tbody>
    </table>

	<br><br>
	<!-- sold out products  -->

	<table width="100%">
		 <col style="width:4%">
		 <col style="width:12%">
		 <col style="width:15%">
		 <col style="width:11%">
		 <col style="width:8%">
		 <col style="width:10%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:9%">
		 <col style="width:12%">
      <thead>
      <caption>
		  <h3> Sold out products </h3>
      </caption>
	  <tr>
		 <th>#</th>
		 <th>Image</th>
	     <th>Item</th>
		 <th>Price</th>
		 <th>Stock</th>
		 <th>Total Price</th>
		 <th>Sold Date</th>
		 <th>Expiry Date</th>
		 <th>Expired</th>
	     <th> </th>	
      </tr>
	  </thead>
	  
      <tbody> 
	  <?php
	  $i=0;
	  $sql2="SELECT *,ABS(sum(inventory_stock)) as s FROM inventory_tbl WHERE inventory_status='0' AND inventory_stock<=0 GROUP BY inventory_expiry_date,inventory_ps_id";
	  $result2=mysqli_query($con,$sql2);
	  while($row2=mysqli_fetch_array($result2))
	  {
		$ps_id=$row2['inventory_ps_id'];
		$expdate = new DateTime(date($row2['inventory_expiry_date']));
		$diffBtwTodayAndExpiry = $expdate->diff(new DateTime(date('y-m-d h:i:s')));
		
		$sql3="SELECT DISTINCT ps.ps_id,p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id and  ps.ps_seller_id=$id and ps.ps_id=$ps_id order by p.product_id desc";
        if($result3=mysqli_query($con,$sql3))
        {
            
            while($row=mysqli_fetch_array($result3))
            {
                    
                $i=$i+1;
                ?>
                <tr>
				 <td><?php echo $i?></td>
				 <td><img src="../../images/<?php echo $row['ps_image']?>" style="border-radius:50%;height:40px;width:40px;"/></td>
                 <td><?php echo $row['prod_name']?></td>
                 <td><?php echo '₹'.$row['ps_price']?></td>
				 <td><?php echo $row2['s'] //actually display sum of stock of same ps_id and manu_date?> </td> 
				 <td><?php echo '₹'.$row2['s']*$row['ps_price']?></td>
                 <td><?php echo $row2['inventory_date']?></td>
				 <td><?php echo $row2['inventory_expiry_date']?></td>
				 <td><?php echo $diffBtwTodayAndExpiry->days.' days' ?></td>		 
                <td> 
                <!-- edit button -->
                 <button style="background-color:grey;padding:7px;border:none;color:white;">Edit</button>
                <!-- delete button -->
                 <button style="background-color:grey;padding:7px;border:none;color:white;">Delete</button>
                </td>
				</tr>                        
			
			<?php          
            }
		}
	}
        ?> 
        </tbody>
    </table></center>
</div>

<?php
}?>

 <!-- dash board  -->

 <?php
if($_GET['id'] == -2)
{ ?>

<div style="padding:26px 26px;">

<!-- graph to show in dashboard  -->
<div class="graph">

	<?php 
		$product_name = array();
		$product_total_stock = array();
		$product_sold_out = array();
		$product_color = array();

		// $sqldata = "select p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id and ps.ps_seller_id = $id and ps_total_stock > 0"; 
		$sqldata = "select DISTINCT(i.inventory_ps_id), p.*,ps.*,i.* from product_tbl as p,product_seller_tbl as ps,inventory_tbl as i where p.product_id=ps.ps_product_id and ps.ps_id=i.inventory_ps_id and ps.ps_seller_id = $id and i.inventory_status = '1'"; 

		$resultdata = mysqli_query($con,$sqldata);
		if (mysqli_num_rows($resultdata)>0){
			while ($rowdata=mysqli_fetch_array($resultdata)){
				// echo $rowdata['prod_name'];
				$ps_id_data = $rowdata['ps_id'];
				$ps_seller_id_data = $rowdata['ps_seller_id'];
				array_push($product_name,$rowdata['prod_name']);
				// inventory_seller_id
				$sqlsum = "SELECT SUM(inventory_stock) as sum FROM inventory_tbl WHERE inventory_ps_id = $ps_id_data and inventory_seller_id = $ps_seller_id_data and inventory_status = '1'";
				$resultsum = mysqli_query($con,$sqlsum);
				$rowsum = mysqli_fetch_array($resultsum);
				// echo ($rowsum['sum']);
				array_push($product_total_stock ,$rowsum['sum']);

				$sqlsold = "SELECT ABS(SUM(inventory_stock)) as sum FROM inventory_tbl WHERE inventory_ps_id = $ps_id_data and inventory_seller_id = $ps_seller_id_data and inventory_status = '0' and inventory_stock<0";
				$resultsold = mysqli_query($con,$sqlsold);
				$rowsold = mysqli_fetch_array($resultsold);
				$row_sold_number = $rowsold['sum'];
				if($row_sold_number == null){ $row_sold_number = "0" ;  }
				// echo ($rowsold['sum']);
				array_push($product_sold_out, $row_sold_number);
				$color = "rgb(".rand(0,255).','.rand(0,255).','.rand(0,255).')';
				array_push($product_color,$color);


			}
		}
		$product_sold_out_percentage = array();
		for ($x = 0 ; $x < count($product_sold_out) ; $x++ ){
			$temp_percentage = $product_sold_out[$x] / $product_total_stock[$x] ; 
			array_push($product_sold_out_percentage , $temp_percentage);
		}
	?>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

	<canvas id="myChart" style="max-width:850px"></canvas>

	<script>
		var xValues = <?php echo json_encode($product_name)?>;
		var yValues = <?php echo json_encode($product_sold_out_percentage)?>;
		var barColors = <?php echo json_encode($product_color)?>;

		new Chart("myChart", {
		type: "bar",
		data: {
			labels: xValues,
			datasets: [{
			backgroundColor: barColors,
			data: yValues
			}]
		},
		options: {
			legend: {display: false},
			title: {
			display: true,
			text: "Total sales"
			},
			scales: {
				yAxes: [{
					display: true,
					ticks: {
						beginAtZero: true, 
						min: 0,
						max: 1.0,
						stepSize: 0.1
					}
				}]
			}
		}
		});
	</script>

</div>

<center>
<div style="background-color:white;width:91%">
	<div class="circleview">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<?php 
	for($x=0 ; $x < count($product_name) ; $x++)
	{    
		$doc = 'doc'.$x;
		
		?>
		<div id="<?php echo $doc ?>" style=" max-width:300px; height:200px;"> </div>

		<script>
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			function drawChart() {
				var data = google.visualization.arrayToDataTable([
					['Contry', 'Mhl'],
					['Sold', <?php echo($product_sold_out[$x]) ?>],
					['Left',<?php echo($product_total_stock[$x] - $product_sold_out[$x]) ?>],
					]);
				var options = {
				title:"<?php echo($product_name[$x])?>",
				is3D:true
				};

				var chart = new google.visualization.PieChart(document.getElementById('<?php echo $doc ?>'));
				chart.draw(data, options);
			}
		</script>
		<?php 
	}
	?>
	</div>

</div>
</center>

<!-- graph engs here  -->

</div>



	<?php
}

?>

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