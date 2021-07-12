<?php
include("../dbconnection.php");
session_start();
// $id=$_SESSION['id'];
$reg_id = $_SESSION['reg_id'];
$ps_id = $_GET['ps_id'];
// $ps_id = 20;
$seller_id = $_GET['seller_id'];
// $seller_id = 23;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/itemstyle.css">
    <style>
        *{
            margin:0px;
            padding:0px;
        }
        @font-face{
            font-family: fontone;
            src:url(../../fonts/Rubik.ttf);
        }
        @font-face{
            font-family: fonttwo;
            src:url(../../fonts/YuseiRegular.ttf);
        }

        body{
            font-family: fontone;
        }
        button:focus{
            outline: none;
        }
        a{
            text-decoration: none;
        }
        .topblack{
            background-color: rgb(40, 40, 40);
            color:rgba(255, 255, 255, 0.851);
            height: 40px;
            font-size: 14px;
        }
        .topblack .leftblock{
            float:left;
            padding-top: 12px;
            padding-left: 20px;
            margin-left: 100px;
            cursor: pointer;
        }
        .topblack .rightblack{
            float: right;
            padding-top:12px;
            margin-right: 150px;
        }
        .rightblack a{
            display: inline;
            margin-right: 10px;
            cursor: pointer;
            color: white;
        }
        .topblack a:hover{
            color:greenyellow;
        }
        .topbargreen{
            height:75px;
            background:linear-gradient(to bottom right,rgb(37,188,176),rgb(53,205,142))
        }
        .topbargreen p{
            color:white;
            font-weight: 1000;
            font-size: 30px;
            padding-top: 18px;
            margin-left: 120px;
            display: inline-block;
            /* background-color: violet; */
        }
        .topgreen_right{
            float:right;
            /* background-color: black; */
            margin-top:23px;
            margin-right:150px;
            /* display: inline-block; */
        }
        .topgreen_right a{
            color:white;
            font-size: 19px;
            display: inline;
            margin-right: 10px;
        }
        .topbar_bottom{
            position: relative;
            width:100%;
            /* height:40px; */
            background-color:rgb(245,245,245);
        }
        .topbar_bottom a{
            position: relative;
            display: inline-block;
            padding:15px 15px;
            color:rgba(0, 0, 0, 0.762);
            /* background-color: chartreuse; */
        }
        .topbar_bottom .active{
            color:rgb(0, 0, 0);
            background:linear-gradient(to bottom right, rgb(240, 120, 55),rgb(242, 85, 73));
        }
        .topbar_bottom a:hover{
            color:rgb(0, 0, 0);
        }

    </style>
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
		<p onclick="location.href='../../index.php'">NGMART</p>
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
				
				<a href="wishlist.php" style="margin-right:15px">Wishlist
					<sup id="wss" style="background-color:red;border-radius:100%; padding:2px 4px;"><?php echo $rown['count2'] ?> </sup>
				</a>
				<a href="cart.php" style="margin-right:15px">Cart
					<sup id="ss" style="background-color:red;border-radius:100%; padding:2px 4px;"><?php echo $row['count'] ?> </sup>
				</a>
				<a href="orderHistory.php" style="margin-right:15px">Orders</a>
				<a href="../logout.php">Logout</a>
			<?php
			} else {
				// echo '<a href="login_reg.php">Cart</a>';
			}

			?>
			<!-- <a href="">About us</a> -->


		</div>
	</div>
    <!-- //navbar done  -->


    <?php 
    $sql = "SELECT p.*,ps.* from product_tbl as p,product_seller_tbl as ps where p.product_id=ps.ps_product_id AND ps.ps_seller_id=$seller_id AND ps.ps_id=$ps_id "; 
    if ($result = mysqli_query($con, $sql)) {

            $row=mysqli_fetch_array($result);
            $sql2 = "SELECT * from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l where ps.ps_seller_id=l.login_id and s.seller_login_id=l.login_id and ps_id=$ps_id";

            if ($result2 = mysqli_query($con, $sql2))
             {
                $row2 = mysqli_fetch_array($result2);
                $org_price=$row2['ps_price'];
                $discount=$row2['ps_discount_perct'];
                $offer_price=$org_price-($discount/100)*$org_price;
              
            }
        }
    ?>
    <div class="margin" style="margin-top:100px;">

        <div class="box">
            <div class="dis">
                <div class="mainpart">
                    <h2><?php echo $row['prod_name'] ?></h2>
                    <p class="seller">Sold by <?php echo $row2['seller_name'] ?></p>
                </div>
                <div class="price">
                <?php if($offer_price < $org_price)
						{?>
                           <div class="pr">
							    <h3 style="color:red;"> &#8377 <?php echo $offer_price;?> &nbsp;<label style="background-color:yellow; opacity: 0.7; width:30%; color:black"><?php echo $discount?>%  Off</label></h3>
							    <h6 style="color:grey"><s>&#8377 <?php echo $row['ps_price']; ?> </s></h6>
                            </div>
				  <?php } 
				  		else{?>
                            <div class="pr">
							    &#8377 <?php  echo $row['ps_price'];?>
                            </div>
					   <?php }?>   
                   
                </div>
                <div class="overviewpart">
                    <div class="discrib">
                        <?php  echo $row['ps_desc'];?>
                        Fruit and vegetables are a good source of vitamins and minerals, including folate, vitamin C and potassium. They're an excellent source of dietary fibre, which can help to maintain a healthy gut and prevent constipation and other digestion problems. A diet high in fibre can also reduce your risk of bowel cancer.
                    </div>
                </div>
                <?php
                if (isset($_SESSION['id'])) 
                {?>
                    <a href="deliveryAdd.php"><button class="opt firstone">Buy Now</button><a>
                    <a href="addtoWishlist.php?ps_id=<?php echo $ps_id?>"><button class="opt" style="background-color:white; border:1px solid rgba(0,0,0,.6);color:black">Add to wishlist</button><a></a> 
                <?php
                }
                else{
                ?>
                    <a href="../../login_reg.php"><button class="opt firstone">Buy Now</button></a>
                    <a href="../../login_reg.php"><button class="opt" style="background-color:white; border:1px solid rgba(0,0,0,.6);color:black">Add to wishlist</button></a> 
                <?php
                }
                ?>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../../images/<?php echo $row['ps_image'] ?>">
            </div>
        </div>

        <div class="box">
            <div class="feedback">
                <?php
                $sql_f = "SELECT * FROM feedback_tbl WHERE f_ps_id=$ps_id";
                $result_f = mysqli_query($con,$sql_f);
                $colors = array("rgb(252, 3, 57)", "rgb(209, 132, 0)", "rgb(66, 176, 2)","rgb(52, 140, 1)","rgb(42, 112, 1)");
                while($row_f = mysqli_fetch_array($result_f)){
                    $c = $colors[$row_f['f_rate']-1];
                ?>
                    <div class="feedbackdatas">
                        <div class="ratingstar" style="background-color:<?php echo $c ?>;"><?php echo $row_f['f_rate']?></div>
                        <div class="contentBoxFeedback">
                            <?php echo $row_f['f_content']?>
                        </div>
                    </div>


                <?php
                }
                ?>
          
            </div>
        </div>
    </div>
    <!-- <div class="shopesavl">
        <p>Available Shops</p><br>
        <div class="scrollView">
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
            <a href=""><button>shope1</button></a>
        </div>
    </div> -->
</body>
</html>