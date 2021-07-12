<?php
    include("../dbconnection.php");
    $f_id=$_GET['f_id'];
    $feedback=$_POST['reply'];
    echo $f_id;
    echo $feedback;
    $sql="UPDATE feedback_tbl SET f_seller_feedback='$feedback' WHERE f_id=$f_id";
    mysqli_query($con,$sql);
    header("location:product_review.php?id=1");
?>