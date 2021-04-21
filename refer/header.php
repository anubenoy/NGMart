<?php ?>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Customer</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
           ?> <i class="fas fa-user-circle fa-fw"></i></a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <a class="dropdown-item" data-toggle="modal" data-target="#myModal" ><i class="fas fa-user-circle"></i> Profile</a>
              <a class="dropdown-item" data-toggle="modal" data-target="#myTodal"><i class="fa fa-lock"></i> Change Password</a>
              <a  href="logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
      </li>
    </ul>
</nav>

<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content" style="width: 130%">
<div class="modal-header"><h3>Edit Profile</h3>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form method="POST" action="Addreg1.php">
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
<div class="form-group">
<div class="form-label-group">
<input type="hidden" name="id" value="<?php echo $b;?>">
<label for="exampleInputEmail1">Full Name</label>
<input type="text" id="name1" class="form-control"  name="name" id="name1" autofocus="autofocus" required  placeholder="Enter Full Name"  onblur="validate()" value="<?php echo $result['cust_name']; ?>">
    <br><label for="exampleInputEmail1">Phone Number</label>
    <input type="tel" id="phno" class="form-control"  name="phn" id="phno" autofocus="autofocus" required  onblur="validate2()" placeholder="Enter Phone Number" value="<?php echo $result['phno']; ?>">
    <br><label for="exampleInputEmail1">Email Address</label>
    <input type="text" class="form-control" value="<?php echo $result['email_id']; ?>" autofocus="autofocus" name="email" id="email1" placeholder="Enter Email Address" onblur="validate1()" required/>
    <br><label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" name="uname"  value="<?php echo $a['username']; ?>" autofocus="autofocus" id="uname1" placeholder="Enter Username" onblur="validate3()"  required/>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">
Close
<span class="glyphicon glyphicon-remove-sign"></span>
</button>
<input type="submit" name="update" value="Update" class="btn btn-success">
</div>
</form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="myTodal" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content" style="width: 130%">
<div class="modal-header"><h3>Change Password</h3>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form method="POST" action="changepass.php">
  <?php
  include("DbConne.php");
  $sq="select * from tbl_login where username='$temp'";
  $res=mysqli_query($con,$sq);
  $a=mysqli_fetch_array($res);
  ?>
<div class="form-group">
<div class="form-label-group">

<label for="exampleInputEmail1">Username</label>
<input type="text"  class="form-control"  name="name"  autofocus="autofocus" required  placeholder="UserName"  value="<?php echo $a['username']; ?>">
    <br><label for="exampleInputEmail1">Old Password</label>
    <input type="password"  class="form-control"   autofocus="autofocus" required  placeholder="Old Password" name="old" id="old" value="<?php echo $a['password']; ?>">
    <br><label for="exampleInputEmail1">New Password</label>
    <input type="password" class="form-control" name="new" id="pass" placeholder="New Password" onblur="validate4()" autofocus="autofocus" required>
    <br><label for="exampleInputEmail1">Confirm Password</label>
    	<input type="password" name="cnew" class="form-control" id="cpawd" placeholder="Confirm New Password" onblur="validcpass()" autofocus="autofocus" required>
</div>
</div><br>
<div class="pad-top">
  <label>
     <center><I>Password must have at least one digit (0-9), one lowercase character (a-z) , one uppercase character(A-Z),one special character. It can have minimum 8 characters and maximum 16 characters.</I></center>
  </label></div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">
Close
<span class="glyphicon glyphicon-remove-sign"></span>
</button>
<input type="submit" name="update" value="Update" class="btn btn-success">
</div>
</form>
</div>
</div>
</div>
</div>


<script>
function validate()
{
var name=document.getElementById("name1").value;
var letters=/^[a-zA-Z\s]*$/;
if(!name.match(letters))
{
alert("Please Enter Valid Name");
document.getElementById("name1").value="";
}
}

function validate2()
{
var phone = document.getElementById("phno").value;
var ph=/^(9|8|7|6)[0-9]{9}$/;
 if(!phone.match(ph))
{
alert("Enter Valid Phone Number");
document.getElementById("phno").value="";
}
}
function validate1()
{
var email=document.getElementById("email1").value;
var pat=/^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$/;
 if(!email.match(pat))
{
alert("Please Enter Valid Email");
document.getElementById("email1").value="";
}
}
function validate3()
{
var name=document.getElementById("uname1").value;
var letters=/^[0-9a-zA-Z]+$/;
if(!name.match(letters))
{
alert("Please Enter Valid Username");
document.getElementById("uname1").value="";
}
}
function validate4()
{
var password = document.getElementById("pass").value;
var opass = document.getElementById("old").value;
var pass=/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{6,}/;
 if(!password.match(pass))
 {
	alert("Please Enter Valid Password");
 document.getElementById("pass").value="";
}

}
function validcpass()
	 {
		var password=document.getElementById("pass").value;
	var cpass=document.getElementById("cpawd").value;
	if(!(password==cpass))
	{
	 alert("Password Not Matching");
	 document.getElementById("cpawd").value="";
	}
	 }

</script>

</body>
