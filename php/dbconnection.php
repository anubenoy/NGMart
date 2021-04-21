<?php
$con=mysqli_connect("localhost","root","","ngmart_db")
or die("Couldn't connect to server");

function del()
{
    date_default_timezone_set("Asia/Kolkata");
    $sql = "SELECT * FROM inventory_tbl where inventory_status=1";
    $result = mysqli_query($GLOBALS['con'], $sql);

    while($row = mysqli_fetch_array($result))
    {
        // $row = mysqli_fetch_array($result);

        $expdate = new DateTime(date($row['inventory_expiry_date']));
        $period = $expdate->diff(new DateTime(date($row['inventory_date']))); // days of expairy of prod from manufacture

        $manDate = new DateTime(date($row['inventory_date']));
        $diffOfTodayWithMan = $manDate->diff(new DateTime(date('y-m-d h:i:s'))); // peroid from manufacture

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
                $id = $row['inventory_id'];
                $sql1 = "update inventory_tbl set inventory_status=0 where inventory_id=$id";
                mysqli_query($GLOBALS['con'], $sql1);
                $ps_id=$row['inventory_ps_id'];
                echo $ps_id;
                $sql6="UPDATE product_seller_tbl SET ps_total_stock=(SELECT sum(inventory_stock) FROM inventory_tbl WHERE inventory_ps_id=$ps_id and inventory_status=1) WHERE ps_id=$ps_id";
                mysqli_query($GLOBALS['con'],$sql6);
                if(mysqli_query($GLOBALS['con'],$sql6)){echo "done";}
            }
        elseif($diffOfTodayWithMan->m == $period->m && $diffOfTodayWithMan->y > $period->y ){
            // echo "gonna change 2 <br>";
            $id = $row['inventory_id'];
            $sql1 = "update inventory_tbl set inventory_status=0 where inventory_id=$id";
            mysqli_query($GLOBALS['con'], $sql1);
            $ps_id=$row['inventory_ps_id'];
            $sql6="UPDATE product_seller_tbl SET ps_total_stock=(SELECT sum(inventory_stock) FROM inventory_tbl WHERE inventory_ps_id=$ps_id and inventory_status=1) WHERE ps_id=$ps_id";
            if(mysqli_query($GLOBALS['con'],$sql6)){echo"done";}
        }
        elseif($diffOfTodayWithMan->y > $period->y){
            // echo "gonna change 3 <br>";
            $id = $row['inventory_id'];
            $sql1 = "update inventory_tbl set inventory_status=0 where inventory_id=$id";
            mysqli_query($GLOBALS['con'], $sql1);
            $ps_id=$row['inventory_ps_id'];
            $sql6="UPDATE product_seller_tbl SET ps_total_stock=(SELECT sum(inventory_stock) FROM inventory_tbl WHERE inventory_ps_id=$ps_id and inventory_status=1 ) WHERE ps_id=$ps_id";
            mysqli_query($GLOBALS['con'],$sql6);
            if(mysqli_query($GLOBALS['con'],$sql6)){echo"done";}
        }
        // else{
        //     echo "not gonna change <br>";
        // }
    }
    
}
// date_default_timezone_set("Asia/Kolkata");
?>
