
<?php
    include("../dbconnection.php");
    $category= $_POST["category"];
    $image0= $_FILES["0"]["name"];
    $file_path0='../../images/'.$image0;
    move_uploaded_file($_FILES["0"]["tmp_name"],$file_path0);


    $sql="select categories from categories_tbl where categories='$category' and status=1";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)<1)
        {
            
            $sql1="insert into categories_tbl (categories,image) values ('$category','$image0')";
            mysqli_query($con,$sql1);
            header("location:categories.php");
                  
        }
    else
        { 
    ?>
            <script>alert("already existing category!");</script>
    <?php 
        }
        
        ?>
    mysqli_close($con);
?> 

