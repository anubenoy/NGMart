<?php
include("../dbconnection.php");
$id=$_SESSION['id'];
?>
<title> Admin Portal </title>
<style>
body {
  margin: 0;
  background:#e6e8e8;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 15%;
  background-color: #ffffff;
  position: fixed;
  height: 100%;
  overflow: auto;
}

li a {
  display: block;
  color: rgb(0,5,5);
  padding: 8px 16px;
  text-decoration: none;
}

li a.active {
  background-color: #4CAF50;
  color: white;
}

li a:hover:not(.active) {
  background-color: #555;
  color: white;
}

#headbar {
  overflow: hidden;
  background:#ffffff;
  margin:1px;
  height:55px;
}
</style>
</head>
<body>
<div id="headbar">
        <?php 
         $sql="SELECT * FROM login_tbl WHERE login_id=$id";
         $result=mysqli_query($con,$sql);
         $row=mysqli_fetch_array($result);                
        ?>
        <h4 style="float:right;padding:1%;"><?php echo $row['email'];?></h4> 
        
</div>
<ul>
  <li><a class="active" href="dashboard.php" id="active1">Dashboard</a></li>
  <li><a href="adminUser.php" id="active2">Admin Users</a></li>
  <li><a href="categories.php" id="active3"> Product Categories</a></li>
  <li><a href="" id="active4">Order Master</a></li>
  <li><a href="" id="active5">Seller Listings</a></li>
  <li><a href="#contact" id="active6" >Contact Us</a></li>
  <li><a href="../logout.php" id="active7" >Logout</a></li>
  
</ul>







