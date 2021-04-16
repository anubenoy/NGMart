<?php
    session_start();
	include("../dbconnection.php");
	$category= $_POST["category"];
    $file=$_FILES["0"]["name"];

    $id=$_GET['id'];
	
	$sql="select * from categories_tbl where id=$id";
	if($result=mysqli_query($con,$sql))
	 	{
             
            $row=mysqli_fetch_array($result);
            if (empty($file)) 
            { $file=$row['image']; 
            }

            else if($row['image']<>$file)
            {
               $sql2="update categories_tbl set image='$file' where id=$id";
               mysqli_query($con,$sql2);
               $file_path='../../images/'.$file;
               move_uploaded_file($_FILES["0"]["tmp_name"], $file_path);
               
           }
                
                $sql1="update categories_tbl set categories='$category' where id=$id";
                if(mysqli_query($con,$sql1)){
                    header("location:categories.php");
                }
    
         }else{
        // echo "something went wrong";
        header("location:editCategories.php");
        }
		   
	?>