<!-- 
<!-- change pass -->
<?php
//    if( isset($_GET['edit'])=='true' && isset($_GET['id']) )
//    {
        ?>
        <div class="change_password" style="padding:80px 1px;width:75%">
             <h3>Change Password</h3>
             <form action="editAdminUser.php" method="POST" id="change_pass" >
                <div>
                       <input type="password" placeholder="old password" id="old_pass" name="old_pass" required>                   
                       <input type="password" id="password"  name="password" onchange="checkPassword('err4','password')" placeholder="new_pass" style="margin-left:3%" required>
                       <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err4" style="visibility: hidden;" data-content="Invalid! eg:#Ay&iou31 min:8chars " style="margin-right:90%">
                       <img src="../../images\error.png" height="20px" onclick="err()" width="20px">
                       </a>
                        <!-- submit  -->
                       <input type="button" value="Change" name="change" onclick="subm_pass()">
                </div>
             </form>
        <?Php
//    }?>


       <!DOCTYPE html>
       <html lang="en">
       <head>
           <meta charset="UTF-8">
           <meta name="viewport" content="width=initial-scale=1.0">
           <title>Document</title>
            <!-- verifying new password -->
            <script>
                function err(){
                $(document).ready(function(){$('[data-toggle="popover"]').popover();});
                }

                function checkPassword(val,val2)
                {
                elem=document.getElementById(val2);
                x=document.getElementById(val);
                patt=/^(?=.*[!@#$%^&*(),.?":{}|<>\ )(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                if(elem.value.trim()=="" || !elem.value.match(patt))
                {
                        x.style.cssText="visibility:visible";
                        err();
                        password_val=false;
                        return false;
                } 
                x.style.cssText="visibility:hidden";
                password_val=true
                return true; 
                }
                function subm_pass(){
                if (password_val){
                        document.getElementById("change_pass").submit();
                        alert("yes");
                }
                }
                
            </script>
       </head>
       <body>
           <!-- edit button -->
           <a href="?edit=true&id=<?php echo $row['login_id'];?>"><button>Edit</button></a>
       </body>
       </html> -->


       
<?php
       //change password server side

//fetching data from change_pass form
$old_pass = $_POST['old_pass'];
$new_pass = mysqli_real_escape_string($con,$_POST['password']);
//used coz each time give dffrnt hash value unlike md5 (converts 72chars encryption code)
$password = password_hash($new_pass,PASSWORD_DEFAULT); 
$id=$_SESSION['id'];


//check if in admin table
$sql = "SELECT * FROM login_tbl WHERE login_id=$id and status=1";

  if($result = mysqli_query($con,$sql))
    { 
        if(mysqli_num_rows($result)==1)
        {
            $row = mysqli_fetch_array($result);
            $db_pass = $row['password']; 

             if(password_verify($old_pass,$db_pass)){ #function deshashes and check password
                // if "password correct" redirect
                 $sql="UPDATE login_tbl SET password='$password' WHERE login_id=$id";
                        if($result = mysqli_query($con,$sql))
                        {           
                         session_destroy();
                        //"password updated";
                        ?>
                        <script>alert("Password changed. \n Login to continue!");
			window.location.href="../../login_reg.php";
			</script>
                   <?php }
                }else{?>
                        <script>alert("wrong password");
			window.location.href="adminUser.php";
			</script>
                        
               <?php }
        
        }  

    }else{echo "query error";}


?>
