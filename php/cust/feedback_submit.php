<?php
include("../dbconnection.php");
session_start();
$reg_id=$_SESSION['reg_id'];
$id = $_SESSION['id'];
// echo $reg_id;
// echo $id;

$order_id = $_GET["order_id"];
$f_rate = $_GET["rating"];
$f_content = $_POST["f_data"];
// echo $order_id;
$sql_o="SELECT * FROM order_tbl WHERE order_id=$order_id";
$result_o=mysqli_query($con,$sql_o);
$row_o=mysqli_fetch_array($result_o);

$f_seller_id = $row_o['order_product_seller_id'];
$f_ps_id = $row_o['order_ps_id'];

$sql_l = "SELECT * FROM login_tbl WHERE login_id=$id ";
$result_l = mysqli_query($con,$sql_l);
$row_l = mysqli_fetch_array($result_l);
$f_cust_email = $row_l['email'];

$sql="INSERT INTO feedback_tbl (f_seller_id, f_ps_id, f_content, f_rate, f_custreg_id, f_cust_email) VALUES ($f_seller_id,$f_ps_id,'$f_content',$f_rate,$reg_id,'$f_cust_email')";
if(mysqli_query($con,$sql)){
    header("location:orderHistory.php");
}

?>