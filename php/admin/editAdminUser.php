
<?php
session_start();
include("../dbconnection.php");


//disable enable a user server side
 if(isset($_GET['delete'])=='true' && isset($_GET['id']) ){
    $id=$_GET["id"];
    $sql="SELECT * FROM login_tbl Where login_id=$id";
    $result=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($result);
    if($row['status']==1){
            $sql="UPDATE login_tbl SET status=0 WHERE login_id=$id";
            mysqli_query($con,$sql);
            header("Location:adminUser.php");
    }
    else{
            $sql="UPDATE login_tbl SET status=1 WHERE login_id=$id";
            mysqli_query($con,$sql);
           header("Location:adminUser.php");
    }
    
}

?>