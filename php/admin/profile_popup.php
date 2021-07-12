<?php 
session_start();
 include("../dbconnection.php");
 if(isset($_SESSION['id'])){
     
    $id=$_SESSION['id'];
    $reg_id=$_SESSION['reg_id'];
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
  background-color: white;
  padding: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: block;
  position: absolute;
  background-color: white;
  min-width: 215px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  white-space:nowrap;
  color: grey;
  /* padding: 12px 16px 12px 20px; */
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
    /* background-color:#E8E8E8; */
    font-size:17px;
}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: grey;}

.inner_icon{
    width:30px;
    height:30px;
    /* padding-left:20px; */
    float:left;
}
.profile_pic{
    width:56px;
    height:56px;
    /* padding:10px;  */
}
td{
    padding:10px;
}
.change_password{
    position: relative;
    top:250px;
    left:500px;
    background-color:rgba(97, 211, 212, 0.5);
    width:300px;
    border-radius: 10px;
    padding:50px;
   
}
input[type=password]{
    display:block;
    border: 1px solid rgb(255, 255, 255);
    height:25px;
    width:30vh;   
    border-radius: 5px;
    margin-bottom: 20px;
}
/* input:focus{
    outline: none;
} */
.change{
    width:30vh;
    height:30px;
    border: none;
    color: white;
    font-weight: 800;
    border-radius: 2px;
    background: rgb(9, 188, 219);
    box-shadow: 3px 3px 10px rgba(9, 188, 219, 0.749);
    transition: ease-in-out 0.4s;
    cursor: pointer;
}

</style>
</head>
<body>


<div id="headbar">
        <?php 
         $sql="SELECT l.*,c.* FROM login_tbl AS l, customerreg_tbl AS c WHERE c.login_id=l.login_id AND l.login_id=$id";
         $result=mysqli_query($con,$sql);
         $row=mysqli_fetch_array($result);                
        ?>
        <div class="dropdown" style="float:right; margin-right:200px;">
         <button class="dropbtn"><img src="../../images/user_icon.png" width="40px" height="40px"></button>
         <div class="dropdown-content">
             <table width="100px"> 
                 <tr>
                    <td><img src="../../images/<?php echo $row['cust_img'] ?>" class="profile_pic"> </td>
                    <td>
                    <h3  style="padding:0px;  margin:0px;">Admin</h3>
                    <h3  style="padding:0px; margin:0px; white-space:nowrap;"><?php echo $row['name'] ?> </h3>
                    <p style="padding:0px; margin:0px; color:grey; font-size:small"><?php echo $row['email'] ?> </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><a href="#"><img class="inner_icon" src="../../images/profile edit.png" style="width:23px; height:23px; opacity:0.6;"> &nbsp;&nbsp;&nbsp; My Profile</a></td>
                    <!-- <td><a href="#">My Profile</a></td>  -->
                </tr>
                <tr>
                    <td colspan="2"><a href="?edit=true&id=<?php echo $row['login_id'];?>"><img class="inner_icon" src="../../images/reset-password-icon-29.jpeg"> &nbsp; Change Password</a></td>
                </tr>
                
                <tr><td colspan="2" style="padding-top:0px"><hr width="90%" color="#E8E8E8"></td></tr>
                <tr>
                    <td colspan="2" style="padding-top:0px"><a href="../logout.php">Logout</a></td>
                </tr>
                
          
            </table>
         </div>
        </div> 
</div>

<!-- //change pass -->
<?php
 if( isset($_GET['edit'])=='true' && isset($_GET['id']) )
{
        ?>
        <div class="change_password">
            
            <center>
             <h2>Reset Your Password</h2><br>
             <form action="pass_rest.php" method="POST" id="change_pass" >
                                   
                       <input type="password"  placeholder="Old password" id="old password" name="old_pass" required>   
                       <p id="err1" clas="err" style="display:none; color:red;">Old Password Incorrect!</p>              
                       
                       <input type="password" id="password"  name="password" onchange="checkPassword('err4','password')" placeholder="New password" required>
                       <p id="err4" clas="err" style="display:none; color:red;">Invalid! eg:#Ay&iou31 min:8chars</p>
                        <!-- confirm password  -->
                  
                        <input type="password" id="ConfirmPass" name="confirm_password" onchange="checkConfirmPass('err5','password','ConfirmPass')" placeholder="Confirm Password" required>
                        <p id="err5" clas="err" style="display:none; color:red;">Passwords don't match!</p>

                  
                        <!-- submit  -->
                       <input type="button" class="change" value="Change" name="change" onclick="subm_pass()">
                
             </form>
        </div>
</center>
        <?Php
}
?>


 <!-- verifying new password -->
 <script>
                
                function checkPassword(val,val2)
                {
                elem=document.getElementById(val2);
                x=document.getElementById(val);
                patt=/^(?=.*[!@#$%^&*(),.?":{}|<>\ )(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
                if(elem.value.trim()=="" || !elem.value.match(patt))
                {
                        x.style.cssText="display:block";
                        // err();
                        password_val=false;
                        return false;
                } 
                x.style.cssText="display:none";
                password_val=true
                return true; 
                }
                
                function checkConfirmPass(val,val2,val3)
                {
                    x=document.getElementById(val);        
                    if((document.getElementById(val2).value)!=(document.getElementById(val3).value))
                    {
                        x.style.cssText="display:block";
                        // err();
                        confirm_val=false
                        return false;
                    } 
                    x.style.cssText="display:none";
                    confirm_val=true;
                    return true; 
                }

                
                function subm_pass(){
                if (password_val&&confirm_val){
                        document.getElementById("change_pass").submit();
                        // alert("yes");
                }
                }

                
                
            </script>
</body>
</html>
