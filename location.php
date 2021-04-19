<?php
$con=mysqli_connect("localhost","root","","ngmart_db")or die("Couldn't connect to server");
$dis=$_GET['dis'];
$query="select * from location_tbl where location_dist_id = $dis";
$result=mysqli_query($con,$query);
echo "<option value=0> Location </option>";
while($row=mysqli_fetch_array($result)){
    echo "<option value=".$row['location_id'].">".$row['location_name']."</option>";
}
?>