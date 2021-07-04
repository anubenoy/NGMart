<?php
session_start();
include("php/dbconnection.php");
del();
if (isset($_SESSION['reg_id']))
{
	$reg_id = $_SESSION['reg_id'];

	// update wish_tbl if products already expired
	date_default_timezone_set("Asia/Kolkata");
	$now = new DateTime(date('y-m-d h:i:s'));

	$sql = "SELECT * FROM `inventory_tbl` as inv, wish_tbl as ws where ws.ps_id = inv.inventory_ps_id and ws.customerreg_id = $reg_id" ;
	$result = mysqli_query($con, $sql);

	while($row=mysqli_fetch_array($result)){

	    $wish_id = $row['wish_id'];
	    $ExpiryDate = new DateTime(date($row['inventory_expiry_date']));
	    $ManDate = new DateTime(date($row['inventory_date']));

	    $diffOfManWithExpiry = $ManDate -> diff($ExpiryDate);
	    $diffOfTodayWithExpiry = $ManDate -> diff($now);

	    if ($diffOfTodayWithExpiry->days < $diffOfManWithExpiry->days){
			
	        // delete query here ;
	        $sqlDelete = "DELETE FROM wish_tbl WHERE wish_id = $wish_id";
	        mysqli_query($con, $sqlDelete);
	    }
	
	}
	// update cart_tbl if products already expired
	// $sql = "SELECT * FROM `inventory_tbl` as inv, cart_tbl as c where c.ps_id = inv.inventory_ps_id and c.customerreg_id = $reg_id" ;
	// $result = mysqli_query($con, $sql);

	// while($row=mysqli_fetch_array($result)){

	//     $cart_id = $row['cart_id'];
	//     $ExpiryDate = new DateTime(date($row['inventory_expiry_date']));
	//     $ManDate = new DateTime(date($row['inventory_date']));

	//     $diffOfManWithExpiry = $ManDate -> diff($ExpiryDate);
	//     $diffOfTodayWithExpiry = $ManDate -> diff($now);

	//     if ($diffOfTodayWithExpiry->days < $diffOfManWithExpiry->days){
	//         // delete query here ;
	//         $sqlDelete = "DELETE FROM cart_tbl WHERE cart_id = $cart_id";
	//         mysqli_query($con, $sqlDelete);
	//     }
	
	// }

} 
// echo $_SESSION['reg_id'];
// echo $_SESSION['id'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home page</title>
	<link href="style/style.css" rel="stylesheet" />
	<script>
		function search_function() {
			term = document.getElementById('term').value;
			window.location.replace("index.php?id=100&search=" + term);
		}
		window.addEventListener('load', function() {
			document.getElementById("animationonload").style.cssText = "display:none";
		});
	</script>
</head>

<body>
	<div class="topblack">
		<div class="leftblock">
			<p>For enquiry call 123 | email on <a style="color:rgba(255, 255, 255, 0.851);" href="mailto:admin@gmail.com"> admin@gmail.com </a></p>
		</div>
		<div class="rightblack">
			<?php
			if (isset($_SESSION['id'])) {

				$sql = "SELECT * FROM customerreg_tbl WHERE customerreg_id=$reg_id";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($result);
				echo '<a href="#">' . $row['name'] . '</a>';
			} else {
				echo '<a href="login_reg.php">Sign up or Login</a>';
			}
			?>

		</div>
	</div>
	<div class="topbargreen">
		<p onclick="location.href='index.php'">NGMART</p>
		<div class="centerdiv">
			<input type="text" id='term' placeholder="Search products">
			<button onclick="search_function()">Search</button>
		</div>
		<div class="topgreen_right">
			<?php
			if (isset($_SESSION['id'])) {

				$sql = "select count(ps_id) as count from cart_tbl where customerreg_id=$reg_id";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($result);

				$sqln = "select count(wish_id) as count2 from wish_tbl where customerreg_id=$reg_id";
				$resultn = mysqli_query($con, $sqln);
				$rown = mysqli_fetch_array($resultn);

			?>
				
				<a href="php/cust/wishlist.php" style="margin-right:15px">Wishlist
					<sup id="wss" style="background-color:red;border-radius:100%; padding:2px 4px;"><?php echo $rown['count2'] ?> </sup>
				</a>
				<a href="php/cust/cart.php" style="margin-right:15px">Cart
					<sup id="ss" style="background-color:red;border-radius:100%; padding:2px 4px;"><?php echo $row['count'] ?> </sup>
				</a>
				<a href="php/cust/orderHistory.php" style="margin-right:15px">Orders</a>
				<a href="php/logout.php">Logout</a>
			<?php
			} else {
				// echo '<a href="login_reg.php">Cart</a>';
			}

			?>
			<!-- <a href="">About us</a> -->


		</div>
	</div>
	<!-- --------------------------------top nav bar done  -->


	<div class="topbar_bottom">
		<center>
			<a href="index.php" <?php if (!isset($_GET['id'])) echo "class=active" ?>>All</a>
			<?php
			$sql = "select * from categories_tbl where status=1";
			if ($result = mysqli_query($con, $sql)) {
				while ($row = mysqli_fetch_array($result)) {
			?>
					<a href="index.php?id=<?php echo $row['id'] ?>" <?php if (isset($_GET['id'])) {
																		if ($row['id'] == $_GET['id']) echo "class=active";
																	} ?>> <?php echo $row['categories'] ?> </a>

			<?php
				}
			}
			?>
		</center>
	</div>
	<!-- ---------------------------- categories done -->

	<?php

	if (!isset($_GET['id'])) {
	?>


		<div class="mvgbackground">
			<div class="cover" style="position:abslolute;top:164px">
				<p data-animation-offset="1.2">Fresh <br> Vegetables <br> </p>
			</div>

			<div class="node">
				<img src="images/supermarket-banner.jpg" alt="" srcset="">
				<div class="cover">
					<p data-animation-offset="1.2">Shop <br> from Anywhere <br> </p>
				</div>
			</div>

			<div class="node">
				<img src="images/basket.jpg" alt="" srcset="">
				<div class="cover">
					<p data-animation-offset="1.3">Collect<br> from nearest shop <br> </p>
				</div>
			</div>

			<div class="node">
				<img src="images/image1.jpg" alt="" srcset="">
				<div class="cover">
					<p data-animation-offset="1.4">Delivered <br> at door step <br> </p>
				</div>
			</div>
		</div>


		<!-- ---------------------------- moving background done -->



		<div class="container_body">
			<center>
				<div class="bdy">
					<!-- <p>Frequent Bought</p> -->

					<?php
					$sql;
					// SELECT seller_login_id FROM sellerreg_tbl as s,customerreg_tbl as c,login_tbl as l WHERE s.seller_login_id=l.login_id AND c.customerreg_id=l.login_id AND s.seller_location_id=c.cust_location_id AND s.seller_dist_id=c.cust_district
					if (isset($_SESSION['id'])) {
						$sql1 = "SELECT seller_login_id FROM sellerreg_tbl WHERE seller_location_id=(SELECT cust_location_id FROM customerreg_tbl WHERE customerreg_id=$reg_id) AND seller_dist_id=(SELECT cust_district FROM customerreg_tbl WHERE customerreg_id=$reg_id)"; //set only for category status=1
						$result1 = mysqli_query($con, $sql1);
						while ($row = mysqli_fetch_array($result1)) {
							$seller_id = $row['seller_login_id'];
							$sql = "SELECT p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id AND ps.ps_seller_id=$seller_id AND ps.ps_total_stock>0 "; //set only for category status=1
							if ($result = mysqli_query($con, $sql)) {
								while ($row = mysqli_fetch_array($result)) {
									$ps_id = $row['ps_id'];
									$seller_id=$row['ps_seller_id'];
									$sql2 = "select * from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l where ps.ps_seller_id=l.login_id and s.seller_login_id=l.login_id and ps_id=$ps_id;";

									if ($result2 = mysqli_query($con, $sql2)) {
										$row2 = mysqli_fetch_array($result2);
										
										$org_price=$row2['ps_price'];
										$discount=$row2['ps_discount_perct'];
										$offer_price=$org_price-($discount/100)*$org_price;
										
					?>
										<!-- part where displays stuff  -->

										<div class="itembox">
											<div class="img_sec">
												<img src="images/<?php echo $row['ps_image'] ?>" alt="" loading="lazy">
											</div>
											<div class="btm_sec">
												<h1><?php echo $row['prod_name'] ?></h1>
												<p><?php echo $row2['seller_name'] ?></p>
												<!-- dynamic pricing display -->
												<?php if($offer_price < $org_price)
												{?>
											
													<h2 style="color:red"> &#8377 <?php echo $offer_price;?> &nbsp;<label style="background-color:yellow; opacity: 0.7; width:30%; color:black"><?php echo $discount?>%  Offer</label></h2>
													<h5 style="color:grey"><s>&#8377 <?php echo $row['ps_price']; ?> </s></h5>

										  <?php } 
										  		else{?>
											
													<h2> &#8377 <?php  echo $row['ps_price'];?> </h2>
													<h5 style="visibility:hidden">...</h5>

											   <?php }?>
										  

												<?php
												if (isset($_SESSION['id'])) {

													// echo '<a href="php/cust/cart.php?ps_id='.$ps_id.'"><button onclick="purchase($ps_id)>Add to cart</button></a>';
													echo '<button onclick="purchase(' . $ps_id . ','.$seller_id.')">Add to cart</button>';
												} else {
													echo '<a href="login_reg.php"><button> Add to cart</button></a>';
												}

												?>
											</div>
										</div>

										<!-- ------------------------------------------ -->

									<?php
									}
								}
							}
						}
					} else {
						$sql = "SELECT p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id AND ps.ps_total_stock>0 "; //set only for category status=1
						if ($result = mysqli_query($con, $sql)) {
							while ($row = mysqli_fetch_array($result)) {
								$ps_id = $row['ps_id'];
								$sql2 = "select * from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l where ps.ps_seller_id=l.login_id and s.seller_login_id=l.login_id and ps_id=$ps_id;";

								if ($result2 = mysqli_query($con, $sql2)) {
									$row2 = mysqli_fetch_array($result2);
									$org_price=$row2['ps_price'];
									$discount=$row2['ps_discount_perct'];
									$offer_price=$org_price-($discount/100)*$org_price;
									
									?>
									<!-- part where displays stuff  -->

									<div class="itembox">
										<div class="img_sec">
											<img src="images/<?php echo $row['ps_image'] ?>" alt="" loading="lazy">
										</div>
										<div class="btm_sec">
											<h1><?php echo $row['prod_name'] ?></h1>
											<p><?php echo $row2['seller_name'] ?></p>
											<!-- dynamic pricing display -->
											<?php if($offer_price < $org_price)
											{?>
										
												<h2 style="color:red"> &#8377 <?php echo $offer_price;?> &nbsp;<label style="background-color:yellow; opacity: 0.7; width:30%; color:black"><?php echo $discount?>%  Offer</label></h2>
												<h5 style="color:grey"><s>&#8377 <?php echo $row['ps_price']; ?> </s></h5>

									  <?php } 
											  else{?>
										
												<h2> &#8377 <?php  echo $row['ps_price'];?> </h2>
												<h5 style="visibility:hidden">...</h5>

										   <?php }?>
											
											<?php
											if (isset($_SESSION['id'])) {

												// echo '<a href="php/cust/cart.php?ps_id='.$ps_id.'"><button onclick="purchase($ps_id)>Add to cart</button></a>';
												echo '<button onclick="purchase(' . $ps_id .','.$seller_id.')">Add to cart</button>';
											} else {
												echo '<a href="login_reg.php"><button> Add to cart</button></a>';
											}

											?>
										</div>
									</div>

									<!-- ------------------------------------------ -->
					<?php
								}
							}
						}
					} // else part if user is not logged in, user can see all items (without location) -> ends here 

					// $sql = "select p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id"; //set only for category status=1


					?>

				</div>
			</center>
		</div>
	<?php
	}

	//  ----------------------------- products  done but only if home page 👆🏻  -->

	else if (isset($_GET['id'])) {
		$id = $_GET['id'];
	?>

		<div class="container_body">
			<center>
				<div class="bdy">
					<!-- <p>Frequent Bought</p> -->

					<?php

					if (isset($_SESSION['id'])) {
						$sql1 = "SELECT seller_login_id FROM sellerreg_tbl WHERE seller_location_id=(SELECT cust_location_id FROM customerreg_tbl WHERE customerreg_id=$reg_id) AND seller_dist_id=(SELECT cust_district FROM customerreg_tbl WHERE customerreg_id=$reg_id)"; //set only for category status=1
						$result1 = mysqli_query($con, $sql1);
						while ($row = mysqli_fetch_array($result1)) {
							$seller_id = $row['seller_login_id'];
							$sql = "SELECT p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id AND ps.ps_seller_id=$seller_id and p.prod_categories_id=$id AND ps.ps_total_stock>0 "; //set only for category status=1
							if ($result = mysqli_query($con, $sql)) {
								while ($row = mysqli_fetch_array($result)) {
									$ps_id = $row['ps_id'];
									$sql2 = "select * from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l where ps.ps_seller_id=l.login_id and s.seller_login_id=l.login_id and ps_id=$ps_id;";

									if ($result2 = mysqli_query($con, $sql2)) {
										$row2 = mysqli_fetch_array($result2);
										$org_price=$row2['ps_price'];
										$discount=$row2['ps_discount_perct'];
										$offer_price=$org_price-($discount/100)*$org_price;
										?>
										<!-- part where displays stuff  -->

										<div class="itembox">
											<div class="img_sec">
												<img src="images/<?php echo $row['ps_image'] ?>" alt="" loading="lazy">
											</div>
											<div class="btm_sec">
												<h1><?php echo $row['prod_name'] ?></h1>
												<p><?php echo $row2['seller_name'] ?></p>
												<!-- dynamic pricing display -->
												<?php if($offer_price < $org_price)
												{?>
											
													<h2 style="color:red"> &#8377 <?php echo $offer_price;?> &nbsp;<label style="background-color:yellow; opacity: 0.7; width:30%; color:black"><?php echo $discount?>%  Offer</label></h2>
													<h5 style="color:grey"><s>&#8377 <?php echo $row['ps_price']; ?> </s></h5>

										  <?php } 
										  		else{?>
											
													<h2> &#8377 <?php  echo $row['ps_price'];?> </h2>
													<h5 style="visibility:hidden">...</h5>

											   <?php }?>


												<?php
												if (isset($_SESSION['id'])) {

													// echo '<a href="php/cust/cart.php?ps_id='.$ps_id.'"><button onclick="purchase($ps_id)>Add to cart</button></a>';
													echo '<button onclick="purchase(' . $ps_id .','.$seller_id. ')">Add to cart</button>';
												} else {
													echo '<a href="login_reg.php"><button> Add to cart</button></a>';
												}

												?>
											</div>
										</div>

										<!-- ------------------------------------------ -->

									<?php
									}
								}
							}
						}
					} else {
						$sql = "select p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id and p.prod_categories_id=$id AND ps.ps_total_stock>0 ";

						if ($result = mysqli_query($con, $sql)) {
							while ($row = mysqli_fetch_array($result)) {
								$ps_id = $row['ps_id'];
								$sql2 = "select * from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l where ps.ps_seller_id=l.login_id and s.seller_login_id=l.login_id and ps_id=$ps_id;";

								if ($result2 = mysqli_query($con, $sql2)) {
									$row2 = mysqli_fetch_array($result2);
									$org_price=$row2['ps_price'];
									$discount=$row2['ps_discount_perct'];
									$offer_price=$org_price-($discount/100)*$org_price;
									
									?>
									<!-- part where displays stuff  -->
									<div class="itembox">
										<div class="img_sec">
											<img src="images/<?php echo $row['ps_image'] ?>" alt="" loading="lazy">
										</div>
										<div class="btm_sec">
											<h1><?php echo $row['prod_name'] ?></h1>
											<p><?php echo $row2['seller_name'] ?></p>
											<!-- dynamic pricing display -->
											<?php if($offer_price < $org_price)
											{?>
										
												<h2 style="color:red"> &#8377 <?php echo $offer_price;?> &nbsp;<label style="background-color:yellow; opacity: 0.7; width:30%; color:black"><?php echo $discount?>%  Offer</label></h2>
												<h5 style="color:grey"><s>&#8377 <?php echo $row['ps_price']; ?> </s></h5>
									  <?php } 
									  		else{?>
										
												<h2> &#8377 <?php  echo $row['ps_price'];?> </h2>
												<h5 style="visibility:hidden">...</h5>
										   <?php }?>

											<?php
											if (isset($_SESSION['id'])) {

												// echo '<a href="php/cust/cart.php?ps_id='.$ps_id.'"><button>Add to cart</button></a>';
												echo '<button onclick="purchase(' . $ps_id .','.$seller_id. ')">Add to cart</button>';
											} else {
												echo '<a href="login_reg.php"><button>Add to cart</button></a>';
											}

											?>

										</div>
									</div>

					<?php
								}
							}
						}
					}
					?>

				</div>
			</center>
		</div>

		<div class="container_body">
			<center>
				<div class="bdy">

					<?php

					if ($_GET['id'] == 100) {
						$temp_term = $_GET['search'];
						$term = '%' . $_GET['search'] . '%';
						$sqlsearch = "SELECT * FROM product_tbl where prod_name like '$term'";
						$resultsearch = mysqli_query($con, $sqlsearch);
						$numbersofitems = mysqli_num_rows($resultsearch);
						if ($numbersofitems > 0) {

							echo '<P class="noofitem">Items found for the corresponding search :' . $temp_term . '<BR></P>';

							if (isset($_SESSION['id'])) {
								$sql1 = "SELECT seller_login_id FROM sellerreg_tbl WHERE seller_location_id=(SELECT cust_location_id FROM customerreg_tbl WHERE customerreg_id=$reg_id) AND seller_dist_id=(SELECT cust_district FROM customerreg_tbl WHERE customerreg_id=$reg_id)"; //set only for category status=1
								$result1 = mysqli_query($con, $sql1);
								while ($row = mysqli_fetch_array($result1)) {
									$seller_id = $row['seller_login_id'];
									$sql = "SELECT p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id AND ps.ps_seller_id=$seller_id AND ps.ps_total_stock>0 and p.prod_name like '$term'"; //set only for category status=1
									if ($result = mysqli_query($con, $sql)) {
										while ($row = mysqli_fetch_array($result)) {
											$ps_id = $row['ps_id'];
											$sql2 = "select s.seller_name from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l where ps.ps_seller_id=l.login_id and s.seller_login_id=l.login_id and ps_id=$ps_id;";

											if ($result2 = mysqli_query($con, $sql2)) {
												$row2 = mysqli_fetch_array($result2);
												$org_price=$row['ps_price'];
												$discount=$row['ps_discount_perct'];
												$offer_price=$org_price-($discount/100)*$org_price;
												
												?>
												<!-- part where displays stuff  -->
												<div class="itembox">
													<div class="img_sec">
														<img src="images/<?php echo $row['ps_image'] ?>" alt="" loading="lazy">
													</div>
													<div class="btm_sec">
														<h1><?php echo $row['prod_name'] ?></h1>
														<p><?php echo $row2['seller_name'] ?></p>
														<!-- dynamic pricing display -->
														<?php if($offer_price < $org_price)
														{?>
													
															<h2 style="color:red"> &#8377 <?php echo $offer_price;?> &nbsp;<label style="background-color:yellow; opacity: 0.7; width:30%; color:black"><?php echo $discount?>%  Offer</label></h2>
															<h5 style="color:grey"><s>&#8377 <?php echo $row['ps_price']; ?> </s></h5>
												  <?php } 
														  else{?>
													
															<h2> &#8377 <?php  echo $row['ps_price'];?> </h2>
															<h5 style="visibility:hidden">...</h5>
													   <?php }?>
			
														<?php
														if (isset($_SESSION['id'])) {

															// echo '<a href="php/cust/cart.php?ps_id='.$ps_id.'"><button onclick="purchase($ps_id)>Add to cart</button></a>';
															echo '<button onclick="purchase(' . $ps_id .','.$seller_id.')">Add to cart</button>';
														} else {
															echo '<a href="login_reg.php"><button> Add to cart</button></a>';
														}

														?>
													</div>
												</div>

												<!-- ------------------------------------------ -->

											<?php
											}
										}
									}
								}
							} else {
								$sql = "SELECT p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id AND ps.ps_total_stock>0 and p.prod_name like '$term'"; //set only for category status=1
								if ($result = mysqli_query($con, $sql)) {
									while ($row = mysqli_fetch_array($result)) {
										$ps_id = $row['ps_id'];
										$sql2 = "select s.seller_name from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l where ps.ps_seller_id=l.login_id and s.seller_login_id=l.login_id and ps_id=$ps_id;";

										if ($result2 = mysqli_query($con, $sql2)) {
											$row2 = mysqli_fetch_array($result2);
											$org_price=$row2['ps_price'];
											$discount=$row2['ps_discount_perct'];
											$offer_price=$org_price-($discount/100)*$org_price;
											
											?>
											<!-- part where displays stuff  -->
											<div class="itembox">
												<div class="img_sec">
													<img src="images/<?php echo $row['ps_image'] ?>" alt="" loading="lazy">
												</div>
												<div class="btm_sec">
													<h1><?php echo $row['prod_name'] ?></h1>
													<p><?php echo $row2['seller_name'] ?></p>
													<!-- dynamic pricing display -->
													<?php if($offer_price < $org_price)
													{?>
												
														<h2 style="color:red"> &#8377 <?php echo $offer_price;?> &nbsp;<label style="background-color:yellow; opacity: 0.7; width:30%; color:black"><?php echo $discount?>%  Offer</label></h2>
														<h5 style="color:grey"><s>&#8377 <?php echo $row['ps_price']; ?> </s></h5>
											  <?php } 
											  		else{?>
												
														<h2> &#8377 <?php  echo $row['ps_price'];?> </h2>
														<h5 style="visibility:hidden">...</h5>
												   <?php }?>

													<?php
													if (isset($_SESSION['id'])) {

														// echo '<a href="php/cust/cart.php?ps_id='.$ps_id.'"><button onclick="purchase($ps_id)>Add to cart</button></a>';
														echo '<button onclick="purchase(' . $ps_id .','.$seller_id. ')">Add to cart</button>';
													} else {
														echo '<a href="login_reg.php"><button> Add to cart</button></a>';
													}

													?>
												</div>
											</div>

											<!-- ------------------------------------------ -->
				<?php
										}
									}
								}
							} // else part if user is not logged in, user can see all items (without location) -> ends here 




						} else {
							echo '<div class="noofitem">No items found for the corresponding search :'.$temp_term.'</div>';
						}
						// echo'<div class="searchitem"> </div>';
						// echo $_GET['search'];
					}
				}

				?>
				</div>
			</center>
		</div>

		<div class="tick" id="tic">
            <div class="check icon"></div>
        </div>

		<!-- <--- category wise sorted prod only if id iseet-->


		<script>
			function myFunction() {
			var txt;
			var r = confirm("Seems like, added items is not from the same seller ! \nDo you want clear cart and add new items from another seller");
			if (r == true) {
				txt = "You pressed OK!";
			} else {
				txt = "You pressed Cancel!";
			}
			document.getElementById("demo").innerHTML = txt;
			}

			function diss() {
				document.getElementById("tic").style.display = "none";
			}

			var xmlhttp = new XMLHttpRequest();

			function purchase(x,y) {
				var sup = document.getElementById("ss");
				var url = "addtocart.php?seller_id=" + y + "&id=" + x;
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						// alert(this.responseText);
						if(this.responseText == false){
							console.log("returning false");
							console.log("seller_id : "+y+" ps_id="+x)
							window.location="php/cust/cart.php?alert=true&seller_id="+y+"&ps_id="+x;
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

		<!-- loagin animation  -->
		<div class="animationOnLoad" id="animationonload">
			<p>NGMART</p>
			<img src="images/loading.gif" alt="loading" loading="lazy">
		</div>

</body>

</html>

<!-- seller 2 and seller 4 -->