<?php
session_start();
if(isset($_SESSION['id'])){
    include("../dbconnection.php");
    if(isset($_SESSION['reg_id'])) $reg_id=$_SESSION['reg_id'];
    // echo $_SESSION['reg_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wishlist</title>
	<link href="../../style/style.css" rel="stylesheet"/>
</head>
<body>
    <div class="topblack">
		<div class="leftblock"><p>For enquiry call 123 | email on <a style="color:rgba(255, 255, 255, 0.851);" href="mailto:admin@gmail.com"> admin@gmail.com </a></p></div>
		<div class="rightblack">
			<?php 

				$sql="SELECT * FROM customerreg_tbl WHERE customerreg_id=$reg_id";
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
			$sql="select count(ps_id) as count from cart_tbl where customerreg_id=$reg_id";
			$result=mysqli_query($con,$sql);
			$row=mysqli_fetch_array($result);
			
			?>
			<a href="cart.php" style="margin-right:20px">Cart
				<sup id="ss" style="background-color:red;border-radius:100%; padding:2px 4px;"><?php echo $row['count']?> </sup>
			</a>
			<a href="../logout.php">Logout</a>
						
			<!-- <a href="">About us</a> -->
			
			
		</div>
	</div>	
<!-- --------------------------------top nav bar done  -->


	<div class="topbar_bottom">
		<center>
			<a href="wishlist.php" <?php if(!isset($_GET['id'])) echo"class=active" ?> >All</a>
			<?php
			$sql="select * from categories_tbl where status=1";
			if($result=mysqli_query($con,$sql))
			{
				while($row=mysqli_fetch_array($result))
				{
					?>
					<a href="wishlist.php?id=<?php echo $row['id'] ?>" <?php if(isset($_GET['id'])){ if($row['id']==$_GET['id']) echo "class=active"; } ?> > <?php echo $row['categories'] ?> </a>
			
				<?php
				}
		}
		?>
		</center>
	</div>
<!-- ---------------------------- categories done -->

<?php 
if(!isset($_GET['id'])){
	?>
<div class="container_body">
	<center>
		<div class="bdy">
			<!-- <p>Frequent Bought</p> -->
			
    <?php
     $sql_main="select * from wish_tbl where customerreg_id=$reg_id";
     if($result_main=mysqli_query($con,$sql_main))
     {
        while($row_main=mysqli_fetch_array($result_main))
        {
            $ps_id=$row_main['ps_id'];  
			
			$sql="select p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id and ps_id=$ps_id";
			
			if($result=mysqli_query($con,$sql))
			{
				while($row=mysqli_fetch_array($result))
				{
					$ps_id=$row['ps_id'];
					$s_id=$row['ps_seller_id'];
					$sql2="select s.* from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l where ps.ps_seller_id=l.login_id and s.seller_login_id=l.login_id and ps_id=$ps_id;";
					
					if($result2=mysqli_query($con,$sql2))
					{
						$row2=mysqli_fetch_array($result2);
						$seller_id = $row2['seller_login_id'];
			?>

			<div class="itembox">
				<div class="img_sec">
				<a href="items.php?seller_id=<?php echo $s_id ?>&ps_id=<?php echo $ps_id ?>"><img src="../../images/<?php echo $row['ps_image'] ?>" alt=""></a>
				</div>
				<div class="btm_sec">
					<h1><?php echo $row['prod_name'] ?></h1>
					<p><?php echo $row2['seller_name'] ?></p>
					<h2>Rs.<?php echo $row['ps_price'] ?> /kg</h2>
					<?php 
						
							echo '<button onclick="purchase('.$ps_id.','.$seller_id.')">Add to cart</button>';	
                    ?>
                    <br><a href="deletewish.php?id=<?php echo $row_main['wish_id']?>" style="font-size:12px;color:gray;">Remove</a>
				</div>
			</div>
			
			<?php 
					}
				}
            } 
        }
    }
			?>
		
		</div>
	</center>
</div>
<?php 
}
else if(isset($_GET['id'])){
	$id=$_GET['id'];
	?>

<div class="container_body">
	<center>
		<div class="bdy">
			<!-- <p>Frequent Bought</p> -->
			
	<?php  
			
    $sql_main="select * from wish_tbl where customerreg_id=$reg_id";
     if($result_main=mysqli_query($con,$sql_main))
	{
		while($row_main=mysqli_fetch_array($result_main))
		{
			    $ps_id=$row_main['ps_id'];
            
            $sql="select p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id and p.prod_categories_id=$id and ps_id=$ps_id";
			
			if($result=mysqli_query($con,$sql))
			{
				while($row=mysqli_fetch_array($result))
				{
					$ps_id=$row['ps_id'];
					$sql2="select s.* from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l where ps.ps_seller_id=l.login_id and s.seller_login_id=l.login_id and ps_id=$ps_id;";

					if($result2=mysqli_query($con,$sql2))
					{
						$row2=mysqli_fetch_array($result2);
						$seller_id = $row2['seller_login_id'];
			?>
			
			<div class="itembox">
				<div class="img_sec">
					<img src="../../images/<?php echo $row['ps_image'] ?>" alt="">
				</div>
				<div class="btm_sec">
					<h1><?php echo $row['prod_name'] ?></h1>
					<p><?php echo $row2['seller_name'] ?></p>
					<h2>Rs.<?php echo $row['ps_price'] ?></h2>
					<?php 
							echo '<button onclick="purchase('.$ps_id.','.$seller_id.')">Add to cart</button>';
							// echo '<button onclick="">Remove from wishlist</button>';
							
                    ?>
                    <br><a href="deletewish.php?id=<?php echo $row_main['wish_id'].'&cat_id='.$id?>" style="font-size:12px;color:gray;">Remove</a>
					
				</div>
			</div>
			
				<?php 
					}
				}
            }
        }
    } 
			?>
		
		</div>
	</center>
</div>



<?php 
}
?>

<div class="tick" id="tic">
    <div class="check icon"></div>
</div>
<!-- <--- category wise sorted prod only if id iseet-->


<script>

	function diss(){
        document.getElementById("tic").style.display="none";
    }

	var xmlhttp = new XMLHttpRequest();
    function purchase(x,y){
		var sup=document.getElementById("ss");
        var url="../../addtocart.php?seller_id=" + y + "&id=" + x;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				if(this.responseText == false){
					window.location="cart.php?alert=true&seller_id="+y+"&ps_id="+x;
				}
				else{
					sup.innerHTML = this.responseText;
					document.getElementById("tic").style.display="block";
            		setTimeout(diss, 700);
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