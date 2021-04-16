<?php
session_start();
    include("../dbconnection.php");
    $reg_id=$_SESSION['reg_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home page</title>
	<link href="../../style/style.css" rel="stylesheet" />
</head>
<body>
    <div class="topblack">
		<div class="leftblock"><p>For enquiry call 911 | email on <a style="color:rgba(255, 255, 255, 0.851);" href="mailto:admin@gmail.com"> admin@gmail.com </a></p></div>
		<div class="rightblack">
			<?php 
                
                $sql="SELECT name FROM customerreg_tbl WHERE customerreg_id=$reg_id";
                $result=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($result); 
                echo '<a href="#">'.$row['name'].'</a>';
                           
				
			?>
			
		</div>
	</div>
	<div class="topbargreen">
		<p>NGMART</p>
		<div class="centerdiv">
			<input type="text" placeholder="Search products">
			<button>Search</button>
		</div>
		<div class="topgreen_right">
			<?php 		
                echo '<a href="../../index.php"style="margin-right:20px">Home</a>';
                echo '<a href="../logout.php">Logout</a>';
			?>
			<!-- <a href="">About us</a> -->
			
			
		</div>
	</div>	
<!-- --------------------------------top nav bar done  -->


