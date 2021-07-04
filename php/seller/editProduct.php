<?php
session_start();
include("../dbconnection.php");

$price=$_POST['price'];
$desc=$_POST['desc'];
$file=$_FILES['file']['name'];

$ps_id=$_GET["id"];

$sql="select * from product_seller_tbl where ps_id=$ps_id";
if($result=mysqli_query($con,$sql))
	{ 
        $row=mysqli_fetch_array($result);
        if (empty($file)) { $file=$row['image']; }

        if($row['image']<>$file)
        {
           $sql2="update product_seller_tbl set ps_image='$file' where ps_id=$ps_id";
           mysqli_query($con,$sql2);
           $file_path='../../images/'.$file;
           move_uploaded_file($_FILES["file"]["tmp_name"], $file_path);   
       }

       $sql1="update product_seller_tbl set ps_price='$price', ps_desc='$desc' where ps_id=$ps_id";
       if(mysqli_query($con,$sql1))
       {
           header("location:seller.php?id=-1");
       }
       else{
        echo "something went wrong with updation";
       }
    }

else{
    echo "something went wrong";
    // header("location:seller.php?id=-1");
    }


?>