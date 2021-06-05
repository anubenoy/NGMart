<?php
require_once("../dbconnection.php");



if($_GET['mode']=='country'){
    $country=$_GET['country'];
    $sql="SELECT * FROM states_tbl WHERE state_country_id=$country ORDER BY state_name";
    $result=mysqli_query($con,$sql);
    echo "<option value=0> Select State </option>";
    while($row=mysqli_fetch_array($result)){
    echo "<option value=".$row['state_id'].">".$row['state_name']."</option>";
}
}
else if ($_GET['mode']=='cities'){
    $state=$_GET['state'];
    $sql="SELECT * FROM cities_tbl WHERE cities_state_id=$state ORDER BY cities_name";
    $result=mysqli_query($con,$sql);
    echo "<option value=0> Select Town/City</option>";
    while($row=mysqli_fetch_array($result)){
    echo "<option value=".$row['cities_id'].">".$row['cities_name']."</option>";
}
}

?>