<?php
session_start();
include("DbConne.php");
if(isset($_SESSION['uname']))
{
$temp=$_SESSION['uname'];
	?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <script>
        function getdistrict(val) {
        $.ajax({
        type: "POST",
        url: "get_district.php",
        data:'state_id='+val,
        success: function(data){
          $("#district-list").html(data);
        }
        });
        }

        </script>



        <title>Customer</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">BuildTech Construction</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">

                    <div class="input-group-append">

                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
							<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php
									 echo $temp;
									 ?></a>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
										<a class="dropdown-item" href="custmreg.php">Profile</a>
										<a class="dropdown-item" href="changepas.php">Change Password</a>
										<a class="dropdown-item" href="logout.php">Logout</a>
									</div>
							</li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
														<div class="sb-sidenav-menu-heading">Activities</div>
														<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
																<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
																Project
																<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
														</a>
														<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
																<nav class="sb-sidenav-menu-nested nav">
																		<a class="nav-link" href="viewproj.php">View Project</a>

																</nav>
														</div>

														<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
																<div class="sb-nav-link-icon"><i class="fas fa-chart-bar"></i></div>
																Daily Progress Report
																<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
														</a>
														<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
																<nav class="sb-sidenav-menu-nested nav">
																		<a class="nav-link" href="viewreport.php">View Report</a>

																</nav>
														</div>

														<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
																<div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
																Complaints
																<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
														</a>
														<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
																<nav class="sb-sidenav-menu-nested nav">
																		<a class="nav-link" href="viewcomp.php">View Complaints</a>

																</nav>
														</div>


                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">View Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
														<li class="breadcrumb-item active">View Profile</li>
                            <li class="breadcrumb-item active"><a href="custmreg1.php">Edit Profile</a></li>
                        </ol>

                        <div class="d-flex justify-content-center h-100">
                        <div class="card">
                        <div class="card-header" style="background:lightgreen">
                        <h3><center><b>View Profile</b></center></h3>
                        </div>
                        <div class="card-body" style="background:lightgreen">
                        <form action="." method="POST">
													<?php
													include("DbConne.php");
													$sq="select * from tbl_login where username='$temp'";
													$res=mysqli_query($con,$sq);
													$a=mysqli_fetch_array($res);
													$b=$a['login_id'];
													$sql="select * from tbl_customer_reg where login_id='$b'";
													$c=mysqli_query($con,$sql);
													$result=mysqli_fetch_array($c);
													?>

                        <div class="input-group form-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>

                        <input type="text" class="form-control" value="<?php echo $result['cust_name']; ?>" name="name" id="name1" placeholder="Full Name" onblur="validate()" required/>
                        </div>
                        <div class="input-group form-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-home"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $result['address']; ?>" name="address" id="address1" placeholder="Home Address" onblur="validate6()"  required/>
                        </div>


                        <div class="input-group form-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                        </div>
                        <select name="post_office" value="" class="form-control" required>
                        <option value=""><?php echo $result['post_office'];?></option>
												<?php $query =mysqli_query($con,"SELECT * FROM tbl_postoff");
                        while($row=mysqli_fetch_array($query))
                        { ?>
                        <option value="<?php echo $row['post_office'];?>"><?php echo $row['post_office'];?></option>
                        <?php
                        }
                        ?>
                        </select>
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-map-pin"></i></span>
                          </div>

                          <input type="postal" class="form-control" value="<?php echo $result['PIN_Code']; ?>" name="pincode" id="pincode1" placeholder="Pin Code" onblur="validate7()" required/>

                        </div>

                        <div class="input-group form-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                        <input type="tel" class="form-control" value="<?php echo $result['phno']; ?>" name="phn" id="phno" placeholder="Phone Number" onblur="validate2()" required/>
                        </div>

                        <div class="input-group form-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $result['email_id']; ?>" name="email" id="email1" placeholder="Email Address" onblur="validate1()" required/>
                        </div>

                        <div class="input-group form-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                        </div>
                        <select onChange="getdistrict(this.value);"  name="state" id="state1" class="form-control" required>
                        <option value=""><?php echo $result['state_name']; ?></option>
                        <?php $query =mysqli_query($con,"SELECT * FROM tbl_state");
                        while($row=mysqli_fetch_array($query))
                        { ?>
                        <option value="<?php echo $row['state_name'];?>"><?php echo $row['state_name'];?></option>
                        <?php
                        }
                        ?>
                        </select>

                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                        </div>
                        <select name="district" id="district-list"  class="form-control" required>
                        <option value=""><?php echo $result['dist_name']; ?></option>
                        </select>
                        </div>




                        </div>
                        </div>
                        </div>






                        <div style="height: 100vh;"></div>
                        <div class="card mb-4"><div class="card-body"></div></div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted"></div>
                            <div>
                                <a href="#"></a>
                                &middot;
                                <a href="#"></a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
        function validate()
        {
        var name=document.getElementById("name1").value;
        var letters=/^[a-zA-Z\s]*$/;
        if(!name.match(letters))
        {
        alert("Please enter valid name");
        document.getElementById("name1").value="";
        }
        }
        function validate6()
        {
        var name=document.getElementById("address1").value;
        var letters=/^[a-zA-Z\s]*$/;
        if(!name.match(letters))
        {
        alert("Please enter address correctly");
        document.getElementById("address1").value="";
        }
        }
        function validate7()
        {
        var pincodee = document.getElementById("pincode1").value;
        var code=/^\d{6}$|^\d{3}\d{3}$/;
         if(!pincodee.match(code))
        {
        alert("Please enter pincode correctly");
        document.getElementById("pincode1").value="";
        }
        }
        function validate2()
        {
        var phone = document.getElementById("phno").value;
        var ph=/^(9|8|7|6)[0-9]{9}$/;
         if(!phone.match(ph))
        {
        alert("enter valid phone number");
        document.getElementById("phno").value="";
        }
        }
        function validate1()
        {
        var email=document.getElementById("email1").value;
        var pat=/^[a-z.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
         if(!email.match(pat))
        {
        alert("Please enter valid email");
        document.getElementById("email1").value="";
        }
        }
        function validate3()
        {
        var name=document.getElementById("uname1").value;
        var letters=/^[0-9a-zA-Z]+$/;
        if(!name.match(letters))
        {
        alert("Please enter valid username");
        document.getElementById("uname1").value="";
        }
        }
        function validate4()
        {
        var password = document.getElementById("pass").value;
        var pass=/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{6,}/;
         if(!password.match(pass))
         {
          alert("Please enter valid password");
         document.getElementById("pass").value="";
        }
        }
        function validcpass()
           {
            var password=document.getElementById("pass").value;
          var cpass=document.getElementById("cpawd").value;
          if(!(password==cpass))
          {
           alert("Password not matching");
           document.getElementById("cpawd").value="";
          }
           }

        </script>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
<?php
}
else
{
	header("location: ../login.php");
}
?>
