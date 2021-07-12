<?php
session_start();
if(isset($_SESSION['id']))
{
    include("../dbconnection.php");
    $id=$_SESSION['id'];
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews</title>
    <link href="../../style/style.css" rel="stylesheet" />
    <link href="../../style/seller_style.css" rel="stylesheet" />
</head>

	<style>
		.order_table a{
			text-decoration: underline;
			color:rgb(9, 188, 219);
		}
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
        .ratingBox{
            display:none;
            position:absolute;
            width:400px;
            height:500px;
            background-color: white;
            border-radius: 10px;
            top:50%;
            left:50%;
            transform: translate(-50%,-50%);
            padding-top:30px;
        }
        .ratingBox .data{
            width: 300px;
            height: 250px;
            margin: 0;
            border: 0;
            padding: 50px;
            font-size: 14px;
            margin-top: 10px;
        }
        .ratingBox .data:focus{
            outline: none;
        }
        .ratingBox input[type='button']{
            width: 400px;
            height: 50px;
            background: rgb(9, 188, 219);
            box-shadow: 3px 3px 10px rgba(9, 188, 219, 0.749);
            border: 0px;
            position: absolute;
            bottom: 0px;
            left: 0px;
            font-size: 17px;
            border-radius: 0px 0px 10px 10px;
            color:white;
            cursor: pointer;
        }
        .ratingBox h3{
            font-size: 20px;
            font-family: sans-serif;

        }

	</style>
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
		<a href="shopOrders.php?id=1">Orders</a>
		<a href="../logout.php">Logout</a>	
		</div>
	</div>
	<div class="topbar_bottom">
		<center>
			<a href="product_review.php?id=1" <?php if($_GET['id']==1) echo"class=active" ?>>Complaints</a>
			<a href="product_review.php?id=2" <?php if($_GET['id']==2) echo"class=active" ?>>Review & Ratings</a>
			
			
		</center>
	</div>
<!-- ------------------------------------------top nav bar done ------------------------------------------------->
<?php
if($_GET['id']==1)
{?>
	<div class="order_table" style="padding:26px 26px;"><center>

	    	 <!-- listing all orders -->

	    <table width="100%">
			 <col style="width:4%">
			 <col style="width:20%">
			 <col style="width:20%">
			 <col style="width:30%">
			 <col style="width:26%">

	      <thead>
	      <caption >
			  <h3> Orders recieved</h3>
	      </caption>
		  <tr>
			 <th>#</th>
			 <th>Product</th>
		     <th>Rating</th>
			 <th>Feedback</th>
			 <th></th>
		     
	      </tr>
		  </thead>

	      <tbody> 
			<?php
		  	$i=0;
			  $sql="SELECT * FROM feedback_tbl";
			  $result= mysqli_query($con,$sql);
			  while($feedback=mysqli_fetch_array($result))
			  {
				$ps_id=$feedback['f_ps_id'];
				$sql2="SELECT *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$ps_id";
				$result2= mysqli_query($con,$sql2);
				$prod=mysqli_fetch_array($result2);

				// $cust_id=$feedback['order_customer_id'];
				// // $sql3="SELECT * FROM customerreg_tbl WHERE customerreg_id=$cust_id";
				// // $result3=mysqli_query($con,$sql3);
	            // // $cust=mysqli_fetch_array($result3);     
	            
				$i++;
				echo "<tr>";
				echo "<td>$i</td>";
                echo "<td>".$prod['prod_name']."</td>";
				echo "<td>".$feedback['f_rate']."</td>";
				echo "<td>".$feedback['f_content']."</td>";
				
				?>
                <td>
					<button style="background: rgb(9, 188, 219); box-shadow: 3px 3px 10px rgba(9, 188, 219, 0.749);padding:7px;border:none;color:white;width:120px;" onclick="showChangeBox(<?php echo $feedback['f_id'];?>)">Reply</button>
				</td>
				</tr>
			 <?php
			 }
			?>
	       </tbody>
	    </table>
        </center>
    </div>
            
        <!-- reply popup -->
        <div id="ChangePasswordModal" class="ChangePassword">
          <div class="ratingBox">
            <span class="close" onclick="closeChangeBox()">&times;</span>
            <center>
              <h3>Reply to User Complaint</h3><br>
              <form method="POST" id="feedbackform">
                <div>
                  <textarea name="reply" id="reply" class="data" placeholder="Write reply here"></textarea>
                  <input type="button" class="change" value="Reply" name="change" onclick="sendFeedback()">
                </div>
              </form>
            </center>
          </div>
        </div>
    
 <?php
}
?>
    
</body>
<script>
    var feedbackmodel = document.getElementById("ChangePasswordModal");
    var feedback=0

    function showChangeBox(fid){
        feedback=fid
        feedbackmodel.style.display = "block" ;

    }
    function closeChangeBox(){
        feedbackmodel.style.display = "none" ;
    }
    function sendFeedback(){
        fm=document.getElementById("feedbackform")
        fm.setAttribute("action", "reviewReply.php?f_id="+feedback); 
        fm.submit();
    }
</script>
</html>
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