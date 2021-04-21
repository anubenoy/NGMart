<?php
session_start();
include("../dbconnection.php");

$email=$_POST['email'];
$sql="SELECT * FROM login_tbl where email = '$email' ";
$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){


    $row=mysqli_fetch_array($result);
    $login=$row['login_id'];
    ////checking whether user already done a password reset 
    $sql="SELECT * FROM tbl_otp where login_id = '$login'";
    $result=mysqli_query($con,$sql);

    $date=date('y-m-d h:i:s');
    $otp_data=rand(100000,999999);
    
    $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    shuffle($seed);
    $rand = '';
    foreach (array_rand($seed, 60) as $k) $rand .= $seed[$k];

    if(mysqli_num_rows($result)>0){
        $sql="update tbl_otp set otp_time='$date',otp_data='$otp_data',otp_random='$rand' where login_id=$login";
    }
    else{
        $sql="insert into tbl_otp (login_id,otp_time,otp_data,otp_random) values ($login,'$date','$otp_data','$rand')";
    }
    mysqli_query($con,$sql);

    $_SESSION['rand']=$rand;
    $_SESSION['otp_data']=$otp_data;
    $_SESSION['email']=$email;
    // echo"user valid";
    header("location:sentmail.php");

}
else{
    header("location:forget_pass.php?err='wrong'");
}

?>
