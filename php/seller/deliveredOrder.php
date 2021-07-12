<?php
include("../dbconnection.php");
session_start();

require("../forget_pass/PHPMailer/src/PHPMailer.php");
require("../forget_pass/PHPMailer/src/SMTP.php");
require("../forget_pass/PHPMailer/src/Exception.php");
require("../../../confidential.php");

$o_id=$_GET['o_id'];
$sql="UPDATE order_tbl SET order_status='delivered' WHERE order_id=$o_id";
if(mysqli_query($con,$sql))
{
    $sql_o="SELECT * FROM order_tbl WHERE order_id=$o_id";
    $result_o= mysqli_query($con,$sql_o);
    $orders = mysqli_fetch_array($result_o);
    $ps_id = $orders['order_ps_id'];
    $order_customer_id=$orders['order_customer_id'];
    $seller_id = $orders['order_product_seller_id'];


    $sql2="SELECT *,p.prod_name as prod,s.seller_name as seller from sellerreg_tbl as s,product_seller_tbl as ps,login_tbl as l,product_tbl as p where ps.ps_seller_id=l.login_id and p.product_id=ps.ps_product_id and s.seller_login_id=l.login_id and ps_id=$ps_id";
    $result2= mysqli_query($con,$sql2);
    $prod=mysqli_fetch_array($result2);

    $cust_id=$orders['order_customer_id'];
    $sqlc="SELECT * FROM customerreg_tbl WHERE customerreg_id=$cust_id";
    $resultc=mysqli_query($con,$sqlc);
    $cust = mysqli_fetch_array($resultc);  

    
    $proimage = $prod['ps_image'];
    $productName = $prod['prod_name'];
    $order__id = "#".$orders['order_transaction_id'];
    $customername = $cust['name']; 


    $sql_l="SELECT l.*,c.* FROM login_tbl AS l, customerreg_tbl AS c WHERE c.login_id=l.login_id AND c.customerreg_id=$order_customer_id";
    $result_l=mysqli_query($con,$sql_l);
    $row_l=mysqli_fetch_array($result_l);
    $userEmail = $row_l['email'];

    // sending mail 

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    try {
        $mail->isSMTP();                                    
        $mail->Host       = 'smtp.gmail.com';                 
        $mail->SMTPAuth   = true;                   
        $mail->Username   = $emailid;       
        $mail->Password   = $password;                               
        $mail->Port       = 587;                                   

        //Recipients
        $mail->setFrom($emailid,'NGMART');
        $mail->addAddress($userEmail); 

        //Content
        $mail->isHTML(true); 
        $mail->Subject = 'Order has been Delivered';
        $mail->Body    = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body{
                    background-color: white;
                    margin: 0;
                    padding: 0;
                }
                .container{
                    margin-top: 20px;
                    position: relative;
                    left:50%;
                    transform: translate(-50%);
                    background-color: white;
                    max-width:350px;
                }
                .container .logoimg{
                    width: 208px;
                    height:80px;
                }
                table img{
                    width:100px;
                    height: 100px; 
                }
                .container p{
                    font-family: sans-serif;
                    font-size: 15px;
                    color:rgba(0, 0, 0, 0.774);
                    margin-left:10px;
                    margin-right: 10px;
                    line-height: 23px;
                }
                .container a{
                    text-decoration: none;
                    color: rgba(47, 154, 241, 0.753);
                    font-family: sans-serif;
                    margin-bottom: 10px;
                    font-size: 15px;
                    margin-left:10px;
                    margin-right: 10px;
                }
            </style>
        </head>
        <body>
            <div class="container">
            <center><img src="https://raw.githubusercontent.com/anubenoy/NGMart/main/images/logo.png" class="logoimg" alt="NGMartlogo" loading="lazy"/></center>
                <p>Hi '.$customername.',<br>
                Your package has been delivered!</p>
                <a href="http://localhost/NGMart/php/cust/items.php?seller_id='.$seller_id.'&ps_id='.$ps_id.'">
                    <table>
                        <tr>
                            <td><img src="http://localhost/NGMart/images/'.$proimage.'" ></td>
                            <td><p>'.$productName.'</p></td>
                        </tr>
                    </table>
                </a>
                <hr>
                <p style="color:gray;font-size:13px;">Order'.$order__id.'<br> This email was sent from an email address that cant receive emails. Please dont reply to this email.</p>
                <p style="margin-bottom:0;">All the best</p>
                <p style="margin-top:0;">NGMart Team.</p>
            </div>
        </body>
        </html>';

        $mail->AltBody = 'your order has been deliverd';

        $mail->send();
        // echo "mail sent";

        }catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    header("location:shopOrders.php?id=2");
}
?>