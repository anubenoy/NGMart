<?php
session_start();
if(isset($_SESSION['id']))
{
	$id=$_SESSION['id'];
	include("../dbconnection.php");
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
		 <col style="width:12%">
		 <col style="width:12%">
		 <col style="width:12%">
		 <col style="width:12%">
		 <col style="width:22%">
		 <col style="width:12%">
		 <col style="width:18%">


	
      <thead>
      <caption>
		  <h3> Inventory </h3>
      </caption>
	  
	  <tr>
		 <th>#</th>
		 <th>Image</th>
	     <th>Item</th>
		 <th>Price</th>
		 <th>Qty</th>
		 <th>Desc</th>
		 <th>Total Price</th>
	     <th> </th>	
      </tr>
	  </thead>
	  
      <tbody> 
	  <?php
        $sql="select p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id and ps.ps_seller_id=$id order by p.product_id desc";
        if($result=mysqli_query($con,$sql))
        {
            $i=0;
            while($row=mysqli_fetch_array($result))
            {
                    
                $i=$i+1;
                ?>
                <tr>
				 <td><?php echo $i?></td>
				 <td><img src="../../images/<?php echo $row['ps_image']?>" style="border-radius:50%;height:40px;width:40px;"/></td>
                 <td><?php echo $row['prod_name']?></td>
                 <td><?php echo $row['ps_price']?></td>
				 <td><?php echo $row['ps_total_stock']?></td>
                 <td><?php echo $row['ps_desc']?></td>
                 <td><?php echo $row['ps_total_stock']*$row['ps_price']?></td>
				 
                <td> 
                <!-- edit button -->
                 <a href="?id=<?php echo $row['prod_categories_id'];?>&ps_id=<?php echo $row['ps_id'];?>"><button style="background-color:green;padding:7px;border:none;color:white;">Edit</button></a>
                <!-- delete button -->
                 <a href="delProduct.php?delete=true&id=<?php echo $row['ps_id'];?>"><button style="background-color:red;padding:7px;border:none;color:white;">Delete</button></a> 
                </td>
				
				</tr>                        
			
			<?php
                       
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