<?php
$con=mysqli_connect("localhost","root","","ngmart_db")
or die("Couldn't connect to server");

function del()
{
    date_default_timezone_set("Asia/Kolkata");
    $sql = "SELECT * FROM inventory_tbl where inventory_status='1'";
    $result = mysqli_query($GLOBALS['con'], $sql);

    while($row = mysqli_fetch_array($result))
    {
        $id = $row['inventory_id'];
        $ps_id=$row['inventory_ps_id'];

        $expdate = new DateTime(date($row['inventory_expiry_date']));
        $period = $expdate->diff(new DateTime(date($row['inventory_date']))); // days of expairy of prod from manufacture

        $manDate = new DateTime(date($row['inventory_date']));
        $diffOfTodayWithMan = $manDate->diff(new DateTime(date('y-m-d h:i:s'))); // period from manufacturẻ

        // echo $diffOfTodayWithMan->days."< difference from manufacture date <br>";
        // echo $diffOfTodayWithMan->m."< difference from manufacture date <br>";
        // echo $diffOfTodayWithMan->y."< difference from manufacture date <br>";
        // echo $period->days."< period of expiry <br>";
        // echo $period->m."< period of expiry <br>";
        // echo $period->y."< period of expiry <br>";

        // 20 04 2020 to 24 08 2020 -> 30days, 1 month, 0 years; 
        // 02 jan 2020 to 01 feb 2020 -> 29days, 1 month , 0 years; 

        if ( $diffOfTodayWithMan->days > $period->days && $diffOfTodayWithMan->m >= $period->m && $diffOfTodayWithMan->y >= $period->y ) 
        {
                // echo "gonna change 1 <br>";
               
                $sql1 = "update inventory_tbl set inventory_status='0' where inventory_id=$id";
                mysqli_query($GLOBALS['con'], $sql1);
                
                
                // echo $ps_id."in 1st cond";

                $sql8="SELECT sum(inventory_stock)as s FROM inventory_tbl WHERE inventory_ps_id=$ps_id AND inventory_status='1'";
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
                
            }
        elseif($diffOfTodayWithMan->m == $period->m && $diffOfTodayWithMan->y > $period->y ){
            // echo "gonna change 2 <br>";
            
            $sql1 = "update inventory_tbl set inventory_status='0' where inventory_id=$id";
            mysqli_query($GLOBALS['con'], $sql1);
            
            
            // echo $ps_id."in 2nd cond";
            $sql8="SELECT sum(inventory_stock) as s FROM inventory_tbl WHERE inventory_ps_id=$ps_id AND inventory_status='1'";
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
           
            // $sql6="UPDATE product_seller_tbl SET ps_total_stock=(SELECT sum(inventory_stock) FROM inventory_tbl WHERE inventory_ps_id=$ps_id and inventory_status='1') WHERE ps_id=$ps_id";
            // if(mysqli_query($GLOBALS['con'],$sql6))
            // {echo"done";}
            // else{
            //     $sql7="DELETE FROM product_seller_tbl WHERE ps_id=$ps_id";
            //     mysqli_query($GLOBALS['con'],$sql7);
            // }
        }
        elseif($diffOfTodayWithMan->y > $period->y){
            // echo "gonna change 3 <br>";
            
            $sql1 = "update inventory_tbl set inventory_status='0' where inventory_id=$id";
            mysqli_query($GLOBALS['con'], $sql1);
           
            
            // echo $ps_id."in 3rd cond";
           
            $sql8="SELECT sum(inventory_stock)as s FROM inventory_tbl WHERE inventory_ps_id=$ps_id AND inventory_status='1'";
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
            
            // $sql6="UPDATE product_seller_tbl SET ps_total_stock=(SELECT sum(inventory_stock) FROM inventory_tbl WHERE inventory_ps_id=$ps_id and inventory_status='1' ) WHERE ps_id=$ps_id";
            // if(mysqli_query($GLOBALS['con'],$sql6))
            // {echo"done";}
            // else{
            //     $sql7="DELETE FROM product_seller_tbl WHERE ps_id=$ps_id";
            //     mysqli_query($GLOBALS['con'],$sql7);
            // }
        }
        // else{
        //     echo "not gonna change <br>";
        // }
    }
    
}
// date_default_timezone_set("Asia/Kolkata");
?>