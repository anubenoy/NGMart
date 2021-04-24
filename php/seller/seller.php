<?php
session_start();
if(isset($_SESSION['id']))
{
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
			color:black;
			/* background-color: brown; */

		}
		td{
			font-size:15px;
		}

	</style>
</head>
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
		<a href="../logout.php">Logout</a>	
		</div>
	</div>

	<div class="topbar_bottom">
		<center>
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
		</script>


	<div class="right">
		
		
		<div class="addInput">
			<input type="text" id="name" name="name" value="<?php echo $row['prod_name']?>" pattern="[A-Za-z\-\s]{3,}" disabled>
		</div> 

		<div class="addInput" >
		<div class="p">Rs/kg</div>
			<input type="text" style="width:200px" name="price" id="price" min="1" value="<?php echo $row['ps_price']?>" pattern="^[0-9]+(\.[0-9]{1,2})?{1,}$" required>
		</div> 
		
		<div class="addInput" >
		<div class="p">Availale kg</div>
			<input type="text" style="width:200px" name="qty" id="qty" min="1" value="<?php echo $row['ps_total_stock']?>" pattern="^[0-9]+(\.[0-9]{1,2})?{1,}$" required>
		</div> 

		<div class="addInput">
			<input type="text" name="desc" id="desc" value="<?php echo $row['ps_desc']?>" pattern="[A-Za-z0-9\s\.\-]{3,}" required> 
		</div> 
		

		<input type="submit" class="btn" value="Edit Product">
	</form>
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


	<div class="right">
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
							$sq1 = "select * from inventory_tbl where inventory_status=1 and inventory_seller_id='$id'";
							//an item in product_seller table will always be same but in inventory table it might appear defferent because of the different expairy and manfu date.
							$rst1 = mysqli_query($con, $sq1);
							while ($ro1 = mysqli_fetch_array($rst1)) {
								// echo $ro1['inventory_ps_id'];
								$inv_id = $ro1['inventory_ps_id'];
								$sq2 = "SELECT * FROM product_seller_tbl where ps_id='$inv_id' and ps_seller_id=$id";
								$rst2 = mysqli_query($con, $sq2);

								while ($ro2 = mysqli_fetch_array($rst2)) {
									$product_id = $ro2['ps_product_id'];
									$sq3 = "SELECT * FROM product_tbl where product_id='$product_id'";
									$rst3 = mysqli_query($con, $sq3);

									while ($ro3 = mysqli_fetch_array($rst3)) {
										$i++;
										// echo $ro3['prod_name'];
										echo "<tr>";
										echo "<td>$i</td>";
										echo "<td><img src='../../images/".$ro2['ps_image']."' style='border-radius:50%;height:40px;width:40px;' /></td>";
										echo "<td>".$ro3['prod_name']."</td>";
										echo "<td>".$ro2['ps_price']."</td>";
										echo "<td>".$ro1['inventory_stock']."</td>";
										echo "<td>".$ro2['ps_desc']."</td>";
										echo "<td>".$ro2['ps_price']*$ro2['ps_price']."</td>";
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
		 <col style="width:11%">
		 <col style="width:13%">
		 <col style="width:11%">
		 <col style="width:11%">
		 <col style="width:11%">
		 <col style="width:11%">
		 <col style="width:11%">
		 <col style="width:16%">


	
      <thead>
      <caption>
		  <h3> Expired products </h3>
      </caption>
	  
	  <tr>
		 <th>#</th>
		 <th>Image</th>
	     <th>Item</th>
		 <th>Price</th>
		 <th>Stock</th>
		 <th>Manufacture Date</th>
		 <th>Expiry Date</th>
		 <th>Expired</th>
	     <th> </th>	
      </tr>
	  </thead>
	  
      <tbody> 
	  <?php
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
                    
                $i=$i+1;
                ?>
                <tr>
				 <td><?php echo $i?></td>
				 <td><img src="../../images/<?php echo $row['ps_image']?>" style="border-radius:50%;height:40px;width:40px;"/></td>
                 <td><?php echo $row['prod_name']?></td>
                 <td><?php echo $row['ps_price']?></td>
				 <td><?php echo $row2['inventory_stock'] //actually display sum of stock of same ps_id and manu_date?> </td> 
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
		
        ?> 
	
        
            </tbody>
    </table>

    	 </center>
</div>

<?php
}?>
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