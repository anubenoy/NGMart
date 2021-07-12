<?php
include("../dbconnection.php");
$id=$_SESSION['id'];
$reg_id=$_SESSION['reg_id'];
?>

<div id="headbar">
  <?php 
   $sql="SELECT l.*,c.* FROM login_tbl AS l, customerreg_tbl AS c WHERE c.login_id=l.login_id AND l.login_id=$id";
   $result=mysqli_query($con,$sql);
   $row=mysqli_fetch_array($result);                
  ?>
  <div class="dropdown">
   <button class="dropbtn"><img src="../../images/user_icon.png" width="40px" height="40px"></button>
   <div class="dropdown-content">
       <table width="100px"> 
           <tr>
              <td><img src="../../images/<?php echo $row['cust_img'] ?>" class="profile_pic"> </td>
              <td>
                <h3  style="padding:0px;  margin:0px;">Admin</h3>
                <h3  style="padding:0px; margin:0px; white-space:nowrap;"><?php echo $row['name'] ?></h3>
                <p style="padding:0px; margin:0px; color:grey; font-size:small"><?php echo $row['email'] ?></p>
              </td>
          </tr>
          <tr>
              <td colspan="2"><a onclick="showProfileBox()"><img class="inner_icon" src="../../images/profile edit.png" style="width:23px; height:23px; opacity:0.6;"> &nbsp;&nbsp;&nbsp; My Profile</a></td>
          </tr>
          <tr>
              <td colspan="2"><a onclick="showChangeBox()"><img class="inner_icon" src="../../images/reset-password-icon-29.jpeg"> &nbsp; Change Password</a></td>
          </tr>
          
          <tr><td colspan="2" style="padding-top:0px"><hr width="90%" color="#E8E8E8"></td></tr>
          <tr>
              <td colspan="2" style="padding-top:0px"><a href="../logout.php">Logout</a></td>
          </tr>
      
      </table>
   </div>
  </div> 
</div>

<ul>
  <li><a class="active" href="dashboard.php" id="active1">Dashboard</a></li>
  <li><a href="adminUser.php" id="active2">Admin Users</a></li>
  <li><a href="categories.php" id="active3"> Product Categories</a></li>
  <li><a href="" id="active4">Sellers</a></li>
  <!-- <li><a href="" id="active5">Seller Listings</a></li> -->
  <!-- <li><a href="#contact" id="active6" >Contact Us</a></li> -->
  <!-- <li><a href="../logout.php" id="active7" >Logout</a></li> -->
</ul>

<div id="ChangePasswordModal" class="ChangePassword">
  <div class="ChangePasswordcontent">
    <span class="close" onclick="closeChangeBox()">&times;</span>
    <center>
      <h2>Reset Your Password</h2><br>
      <form action="pass_rest.php" method="POST" id="change_pass">
        <div>
          <input type="password" placeholder="Old password" name="old_pass" onblur="Checkp(this.value)" required>
          <p id="err1" > Old Password Incorrect!</p>  
          <input type="password" id="passwordCh"  name="password" onchange="checkPasswords('err4','passwordCh')" placeholder="New password" required> 
          <p id="err4" >Invalid! eg:#Ay&iou31 min:8chars</p>
          <!-- confirm password  -->
          <input type="password" id="ConfirmPassCH" name="confirm_password" onchange="checkConfirmPasss('err5','passwordCh','ConfirmPassCH')" placeholder="Confirm Password" required>
          <p id="err5" >Passwords don't match!</p>
        </div>
      </form>
      <button onclick="subm_pass()" class="change">Change</button>
    </center>
  </div>
</div>


<div id="EditProfileModal" class="ChangePassword">
  <div class="ChangePasswordcontent">
    <span class="close" onclick="closeProfileBox()">&times;</span>
    <center>
    <h2>My Profile</h2><br>
      <form action="profileEdit.php" method="POST" id="profile_edit" enctype="multipart/form-data">
        <div>
          <div class="photo">               
           <center>
               <div id="pro" class="img" onclick="upload()">
                   <div class="edit">Upload an image</div>
                       <script>document.getElementById('pro').style.cssText="background-image: url('../../images/<?php echo $row['cust_img'] ?>');"</script>
                   <input id="upload" style="visibility:hidden;cursor:pointer" type="FILE" accept="image/x-png,image/jpeg" name='pic'>
               </div> 
           </center>
          </div>
          <!-- <img src="../../images/<?php echo $row['cust_img'] ?>" class="profile_pic"><br> -->
          <label class="p_label">Name :</label>
          <input type="text" id="namep_3" name="name"  onblur="checkName('errp_1','namep_3')" value="<?php echo $row['name'] ?>" required><br> 
          <p id="errp_1"> Invalid Name!</p> 
          <label class="p_label">Mobile:</label>
          <input type="text" id="phonep_3" name="phone" onblur="checkPhone('errp_2','phonep_3')" value="<?php echo $row['cust_phn_no'] ?>" required> <br>
          <p id="errp_2" > Invaild number! Should contain 10 digits!</p>  
          <label class="p_label">Email :</label>
          <input type="text" id="emailp_3" name="email" onblur="checkEmail('errp_3','emailp_3')" value="<?php echo $row['email'] ?>" required>
          <p id="errp_3">Invaild Email! eg:something@something.com</p>
        
        </div>
      </form>
      <button onclick="edit()" class="change">EDIT</button>
    </center>
  </div>
</div>



<!-- scripts for pop up and validation -->
<script>

  var modal = document.getElementById("ChangePasswordModal");
  var span = document.getElementsByClassName("close")[0];
  var oldPass = false
  var newpass = false
  var confpassword = false
  var phone_val = false
  var name_val = false
  var email_val = false

  function showChangeBox(){
    modal.style.display = "block" ;
  }
  function closeChangeBox(){
    modal.style.display = "none" ;
  }

  function checkPasswords(val,val2){
    elem=document.getElementById(val2);
    x=document.getElementById(val);
    patt=/^(?=.*[!@#$%^&*(),.?":{}|<>\ )(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if(elem.value.trim()=="" || !elem.value.match(patt))
    {
      x.style.cssText="display:block";
      password_val=false;
      return false;
    } 
    x.style.cssText="display:none";
    newpass = true
  }

  function checkConfirmPasss(val,val2,val3){
    x=document.getElementById(val);        
    if((document.getElementById(val2).value)!=(document.getElementById(val3).value)){
      x.style.cssText="display:block";
      confirm_val=false
      return false;
    } 
    x.style.cssText="display:none";
    confpassword = true
  }

  function subm_pass(){
    if(oldPass && newpass && confpassword ){
      document.getElementById("change_pass").submit();
    }
  }

  function Checkp(val){
    var url = "../../AJAX/pass_rest.php?old_pass="+val;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText)
        if (this.responseText =="true") {
          oldPass = true
          document.getElementById("err1").style.display="none";
        }
        else{
          oldPass = false
          document.getElementById("err1").style.display="block";
        }
      }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
  }

  var profilemodal= document.getElementById("EditProfileModal");
  function showProfileBox(){
    profilemodal.style.display = "block" ;
  }
  function closeProfileBox(){
    profilemodal.style.display = "none" ;
  }
  
  function checkPhone(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^([6-9]{1})+([0-9]{9})$/;
            if(!elem.value.match(patt)|| elem.value.trim()=='')
            {   
                x.style.cssText="display:block";
                phone_val=false
                return false;
            } 
            x.style.cssText="display:none";
            phone_val=true;
            return true; 
        }
  function checkName(val,val2)
  {
      elem=document.getElementById(val2);
      x=document.getElementById(val);
      patt=/^[a-zA-Z\.\s]{3,30}$/;
      if(elem.value.trim()=="" || !elem.value.match(patt))
      {   
          x.style.cssText="display:block";
          name_val=false;
          return false;
      } 
      x.style.cssText="display:none";
      name_val=true
      return true;  
  }
      
  function checkEmail(val,val2)
  {
      elem=document.getElementById(val2);
      x=document.getElementById(val);
      patt=/^([A-Za-z0-9\.]{4,30})+@[a-z.]+\.+[a-z]+$/;
      if(!elem.value.match(patt)|| elem.value.trim()=='')
      {   
          x.style.cssText="display:block";
          email_val=false
          return false;
      } 
      x.style.cssText="display:none";
      email_val=true;
      return true; 
  }

  function edit(){
      document.getElementById("profile_edit").submit();
  }
  function upload(){
     document.getElementById('upload').click();
    }
</script>