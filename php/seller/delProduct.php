
<?php
session_start();
include("../dbconnection.php");


//delete product from inventory and update stock in product tbl
 if(isset($_GET['delete'])=='true' && isset($_GET['id']) && isset($_GET['ps_id'])){
    $id=$_GET["id"];
    $ps_id=$_GET["ps_id"];
    $sql="DELETE FROM inventory_tbl WHERE inventory_id=$id";
    if($result=mysqli_query($con,$sql)){

        $sql8="SELECT sum(inventory_stock)as s FROM inventory_tbl WHERE inventory_ps_id=$ps_id AND inventory_status=1";
        if($result8=mysqli_query($GLOBALS['con'],$sql8))
        {
            $row8=mysqli_fetch_array($result8);
            $ps_total_stock=$row8['s'];
            // echo $ps_total_stock;
            if($ps_total_stock!='')
            {
                $sql6="UPDATE product_seller_tbl SET ps_total_stock=$ps_total_stock WHERE ps_id=$ps_id";
                mysqli_query($GLOBALS['con'],$sql6);
                
            }
            else{
                $sql7="UPDATE product_seller_tbl SET ps_total_stock=0 WHERE ps_id=$ps_id";
                mysqli_query($GLOBALS['con'],$sql7);
            }
        } 
    
        header("location:seller.php?id=-1");
    }
}

?>