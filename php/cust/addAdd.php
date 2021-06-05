<?php
    include("../dbconnection.php");

    $reg_id=$_GET['reg_id'];
    $f_name=$_POST['f_name'];
    $house=$_POST['house'];
    $area=$_POST['area'];
    $cities=$_POST['cities'];
    $state=$_POST['state'];
    $pin=$_POST['pin'];
    $country=$_POST['country'];
    $mobile=$_POST['mobile'];
    // $landmark=$_POST['landmark'];
    

    $sql="INSERT INTO  address_tbl (customerreg_id,add_full_name,add_pincode,add_country_id,add_state_id,add_cities_id,add_house_name,add_area,add_mobile_no) VALUES ($reg_id,'$f_name',$pin,$country,$state,$cities,'$house','$area','$mobile')";
    $result=mysqli_query($con,$sql);
    $add_id=mysqli_insert_id($con);
    if(isset($_POST['default_add'])){
        $sql2="UPDATE address_tbl SET add_default='true' WHERE add_id=$add_id";
        if(mysqli_query($con,$sql2)){
            header("location:deliveryAdd.php");
        }
   
    }
    else{
        header("location:deliveryAdd.php");
        
    } 
    
?>