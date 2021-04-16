<?php
session_start();
include("../dbconnection.php");


//disable enable a category server side
         if(isset($_GET['delete'])=='true' && isset($_GET['id']) ){
            $id=$_GET["id"];
            $sql="SELECT * FROM categories_tbl Where id=$id";
            $result=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($result);
            if($row['status']==1){
                    $sql="UPDATE categories_tbl SET status=0 WHERE id=$id";
                    mysqli_query($con,$sql);
                    header("Location:categories.php");
            }
            else{
                    $sql="UPDATE categories_tbl SET status=1 WHERE id=$id";
                    mysqli_query($con,$sql);
                   header("Location:categories.php");
            }
            
        }
?>