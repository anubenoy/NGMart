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
$cat_id;

$sql="SELECT * FROM product_tbl WHERE prod_name='$name'";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)<1){
    $sql2="INSERT INTO product_tbl (prod_categories_id,prod_name) VALUES ($cat_id,'$name')";
    $result=mysqli_query($con,$sql2);
    $prod_id=mysqli_insert_id($con);

    $sql2="SELECT * FROM product_tbl WHERE product_id='$prod_id'";
    $result=mysqli_query($con,$sql2);
    $row2=mysqli_fetch_array($result);
    $cat_id=$row2['prod_categories_id'];
    
}
else{
    // $sql2="SELECT * FROM product_tbl WHERE prod_name='$name'";
    // $result=mysqli_query($con,$sql2);
    $row=mysqli_fetch_array($result);

    $prod_id=$row['product_id'];
    $cat_id=$row['prod_categories_id'];
}

$file_path='../../images/'.$file;
move_uploaded_file($_FILES["file"]["tmp_name"],$file_path);

// if product already added to ps tbl update stock
$sql5="SELECT * FROM product_seller_tbl WHERE ps_seller_id=$seller_id AND ps_product_id=$prod_id AND ps_price=$price";
$result5=mysqli_query($con,$sql5);
$row=mysqli_fetch_array($result5);
$ps_id=$row['ps_id'];

if(mysqli_num_rows($result5)<1)
{

    $sql3="INSERT INTO product_seller_tbl (ps_seller_id,ps_product_id,ps_price,ps_total_stock,ps_image,ps_desc) VALUES ($seller_id,$prod_id,$price,$qty,'$file','$desc')";
    mysqli_query($con,$sql3);
    $ps_id=mysqli_insert_id($con);

   
}

    // echo $ps_id;
     // setting product expiry 
     date_default_timezone_set("Asia/Kolkata");
     $date=date('y-m-d h:i:s');
     $expdate;
    if($cat_id == 1 || $cat_id == 2){ $expdate=Date('y-m-d h:i:s', strtotime('+3 days')); }
    elseif($cat_id == 3 || $cat_id == 4 || $cat_id == 5){$expdate=Date('y-m-d h:i:s', strtotime('+180 days'));}
     
 
     $sql4="INSERT INTO inventory_tbl (inventory_ps_id,inventory_seller_id,inventory_stock,inventory_date,inventory_expiry_date) VALUES ($ps_id,$seller_id,$qty,'$date','$expdate')";
     if(mysqli_query($con,$sql4))
     {
         $sql6="UPDATE product_seller_tbl SET ps_total_stock=(SELECT sum(inventory_stock) FROM inventory_tbl WHERE inventory_ps_id=$ps_id) WHERE ps_id=$ps_id";
         mysqli_query($con,$sql6);
         header("location:seller.php?id=-1");
     
     }
     else
     {
         echo "inventory_tbl insertion error!";
     }
   

?>