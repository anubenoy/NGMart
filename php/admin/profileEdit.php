<?php
session_start();
include("../dbconnection.php");
$name = $_POST['name'];
$email = $_POST['email'];
$phn_no = $_POST['phone'];
$id=$_SESSION['id'];
$reg_id=$_SESSION['reg_id'];
$file=$_FILES["pic"]["name"];

// echo $name;
// echo $email;
// echo $phn_no."e";
// echo $id;
// echo $reg_id;
// echo $file;

$sql="UPDATE login_tbl SET email='$email' WHERE login_id=$id";
mysqli_query($con,$sql);

$sql2="UPDATE customerreg_tbl SET name='$name',cust_phn_no='$phn_no' WHERE customerreg_id=$reg_id";
if(mysqli_query($con,$sql2))
{
    $sql3="SELECT * from customerreg_tbl where customerreg_id=$reg_id";
    $result=mysqli_query($con,$sql3);       
    $row3=mysqli_fetch_array($result);
    if (empty($file)) 
    { 
        $file=$row3['cust_img']; 
    }
    else if($row3['cust_img']<>$file)
    {
       $sql4="UPDATE customerreg_tbl set cust_img='$file' where customerreg_id=$reg_id";
       mysqli_query($con,$sql4);
       $file_path='../../images/'.$file;
       move_uploaded_file($_FILES["pic"]["tmp_name"], $file_path);
    }
    header("location:adminUser.php");
}


   

?>