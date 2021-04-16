<?php
session_start();
include("../dbconnection.php");

$name=$_POST['name'];
$price=$_POST['price'];
$qty=$_POST['qty'];
$desc=$_POST['desc'];
$file=$_FILES['file']['name'];

$cat_id=$_GET["id"];
$seller_id=$_SESSION['id'];
$prod_id;

$sql="SELECT * FROM product_tbl WHERE name='$name'";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)<1){
    $sql2="INSERT INTO product_tbl (categories_id,name) VALUES ($cat_id,'$name')";
    $result=mysqli_query($con,$sql2);
    $prod_id=mysqli_insert_id($con);
    
}
else{
    $sql2="SELECT * FROM product_tbl WHERE name='$name'";
    $result=mysqli_query($con,$sql2);
    $row=mysqli_fetch_array($result);
    $prod_id=$row['id'];
}

$file_path='../../images/'.$file;
move_uploaded_file($_FILES["file"]["tmp_name"],$file_path);

$sql3="INSERT INTO product_seller_tbl (seller_id,product_id,price,qty,image,short_desc) VALUES ($seller_id,$prod_id,$price,$qty,'$file','$desc')";
if(mysqli_query($con,$sql3))
{
    header("location:seller.php?id=-1");
    
}
?>