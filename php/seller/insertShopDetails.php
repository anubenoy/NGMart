<?php
include("../dbconnection.php");
session_start();
$id=$_SESSION['temp_id'];

$phone= $_POST["phone"];
$address= $_POST["address"];
$district=$_POST["district"];
$location=$_POST["location"];
$file=$_FILES["0"]["name"];
$work_days=$_POST["workday1"]."-".$_POST["workday2"];
$time1=$_POST["timeone"]."-".$_POST["timetwo"];


echo $district, $location, $file, $work_days, $time1; 


        $sql="UPDATE sellerreg_tbl SET seller_mobile_no='$phone',seller_add='$address',seller_location_id=$location,seller_dist_id=$district,seller_image='$file',seller_work_days='$work_days',time_1='$time1' where seller_login_id=$id";
        if(mysqli_query($con,$sql))
        {
            $file_path='../../images/seller/'.$file;
            move_uploaded_file($_FILES["0"]["tmp_name"], $file_path);
            
            session_unset();
            if(session_destroy())
            {  
                session_start();
                $_SESSION['id']=$id;  
                header("location:seller.php?id=-1");
            }

            
            
        }

mysqli_close($con);
?> 