<?php
session_start();
if(isset($_SESSION['id']))
{
?>
        <!DOCTYPE html>
        <html>
        <head>
        <link rel="stylesheet" href="../../style/headerStyle.css">
        <!-- <script>
          document.getElementById("active").removeAttribute("class");
          document.getElementById("active2").setAttribute("class",'active');
        </script> -->
        <style>
        /* spacing */

            .adminUser table {
            table-layout: fixed;
            border-collapse: collapse;
            background:#ffffff;
            width:100%;
            
            }
            
            
            .adminUser th, .adminUser td {
            padding: 13px;
            border-bottom: 1px solid #ddd;
            text-align:center;
            }
            
            .adminUser tr:hover {background-color: #f5f5f5;}

            

            html {
            font-family: 'helvetica neue', helvetica, arial, sans-serif;
            }
            
            .adminUser th {
            letter-spacing: 2px;
            background:#e6e8e8;
            color:#808080;    
            }
            
            .adminUser td {
            letter-spacing: 1px;
            
            }

            .adminUser caption {
            background:#ffffff;
            color: rgb(0,5,5);
            padding: 16px 16px;
            }

            #change_password {
            width: 40%;
            border: 1px solid rgb(179, 172, 179);
            padding: 0%;
            }

        * {
            box-sizing: border-box;
          }
          .openBtn {
            display: flex;
            justify-content: left;
          }
          .openButton {
            border: none;
            background-color: #ffffff;
            color: blue;
            padding: 0px;
            cursor: pointer;
          }
          .Popup {
            text-align: center;
            display: none; 
            position: fixed;
            z-index: 2; 
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4); 
          }
          .formPopup {
            display: none;
            position: fixed;
            left: 55%;
            top: 15%;
            transform: translate(-50%, 5%);
            border: 3px solid #999999;
            z-index: 9;
            opacity: 0.95;
            
          }
          .formContainer {
            width: 300px;
            padding: 20px;
            background-color: #fff;
          }
          .formContainer input[type=text],
          .formContainer input[type=password] {
            width: 250px;
            padding: 15px;
            margin: 5px 0 20px 0;
            border: none;
            background: #eee;
          }
          .formContainer input[type=text]:focus,
          .formContainer input[type=password]:focus {
            background-color: #ddd;
            outline: none;
            
          }
          .btn {
            padding: 12px 20px;
            border: none;
            background-color: #8ebf42;
            color: #fff;
            cursor: pointer;
            width: 100%;
            opacity: 0.8;
          }
          .formContainer .cancel {
            color:rgba(0,0,0,.2);
            font-size:15px; 
            float:right;
            border:none;
            background:white;
          }
          
          .formContainer .btn:hover,
          .openButton:hover {
            opacity: 1;
          }
          div.addInput{
            position:relative;
          }
          .formContainer .errorText{
            position:absolute;
            top: 40px;
            left:0px;
            width:100%;
            color: #cc0033;
            transition: height 2s;
            font-size: 13px;
            line-height: 15px;
            font-style: italic;
            visibility:hidden;
          } 

    
  
        </style>
        </head>
        

       <body>
       <?php include('adminHeader.php'); ?>
       <div style="margin-left:15%;padding:26px 26px;" class="adminUser">
        <center>
               
        <!-- listing all admins -->
        
        <table>
        <col style="width:15%">
	      <col style="width:15%">
        <col style="width:10%">
        <col style="width:25%">
        <col style="width:35%">
            <thead>
            <caption>
            <h3 style="text-align:left;">Admin Users</h3>

            <div class="openBtn">
            <button class="openButton" onclick="openForm()" style="border:none;">Add new users</button>
            </div>
            </caption>

            <tr>
              <th scope="col">#</th>
              <th scope="col">ID</th>
              <th scope="col">NAME</th>
              <th scope="col">EMAIL</th>
              <th scope="col"> </th>
              </tr>
              </thead>
              <tbody> 
            <?php
            $sql="SELECT l.*,c.* FROM login_tbl AS l, customerreg_tbl AS c WHERE c.login_id=l.login_id AND l.user_type='admin'";
                if($result=mysqli_query($con,$sql))
                {
                  $i=0;
                    while($row=mysqli_fetch_array($result))
                    {
                      $i=$i+1; 
                        ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td scope="row"> <?php echo $row['login_id'];?> </td>
                          <td> <?php echo $row['name'];?> </td>
                          <td> <?php echo $row['email'];?> </td>
                          <td> 
                              <!-- delete button -->
                              <a href="editAdminUser.php?delete=true&id=<?php echo $row['login_id'];?>">
                              <button style="background-color:red;padding:7px;border:none;color:white;">
                                      <?php
                                      if($row['status']==1) {echo "Deactivate";}
                                      else {echo "Activate";}
                                      ?>
                              </button>
                              </a> 
                            </td>
                        </tr>                        
                      <?php
                    }
                }
                ?>
                </tbody>
        </table>
        
        </center>
        
      <!--add admin users popup form -->
     </div>
     <div class="Popup" id="p">
        <div class="formPopup" method="POST" id="popupForm">
        <form class="formContainer" id="addUserForm" action="addAdmin.php" method="POST" style="padding:20px;">
        <button type="button" class="cancel" onclick="closeForm()" >X</button>
          <h2 style="font-size:27px;">Add New User</h2>
          <!-- name  --> 
          <div class="addInput">
              <input type="text" id="nm" name="nme" onchange="checkName('err2','nm')" placeholder="Name" required>
              <div class="errorText">
              <p id="err2">Invaild Name! eg:Jhoye</p> 
              </div>
          </div>
          <!-- email  --> 
          <div class="addInput">
              <input type="text" id="email" name="email" onchange="checkEmail('err3','email')" placeholder="Email" required>
              <div class="errorText">
              <p id="err3">Invaild Email! eg:something@something.com</p> 
              </div>
          </div>
          <!-- password  -->
          <div class="addInput">
              <input type="password" id="pas"  name="password" onchange="checkPassword('err8','pas')" placeholder="Password" required>
              <div class="errorText">
              <p id="err8">Invalid! eg:#Ay&iou31 min:8chars</p>
              </div>
          </div>
          <!-- confirm password  -->
          <div class="addInput">
              <input type="password" id="ConfirmPass" name="confirm_password" onchange="checkConfirmPass('err22','pas','ConfirmPass')" placeholder="Confirm Password" required>
              <div class="errorText">
              <p id="err22">Passwords don't match!</p> 
              </div>
          </div>
          </form>         
          <button type="button" class="btn" onclick="subm_cust() ">Add User</button>
      </div>
    </div>
    
    <script>
      email_val=false
      nm=false
      password_val=false
      confirm_val=false


      // highlighting active page link
      document.getElementById("active1").removeAttribute("class");
      document.getElementById("active2").setAttribute("class",'active');
              
     //add admin users val

      function openForm() {
        document.getElementById("p").style.display = "block";
        document.getElementById("popupForm").style.display = "block";   
      }
      function closeForm() {
        document.getElementById("popupForm").style.display = "none";
        document.getElementById("p").style.display = "none";
      }

      function checkName(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^([A-Za-z\ ]{3,18})$/;
            if(!elem.value.match(patt)|| elem.value.trim()=='')
            {   
                x.style.cssText="visibility:visible";
                nm=false
                return false;
            } 
            x.style.cssText="visibility:hidden";
            nm=true;
            return true; 
        }

      function checkEmail(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^([A-Za-z0-9\.]{4,30})+@[a-z.]+\.+[a-z]+$/;
            if(!elem.value.match(patt)|| elem.value.trim()=='')
            {   
                x.style.cssText="visibility:visible";
                email_val=false
                return false;
            } 
            x.style.cssText="visibility:hidden";
            email_val=true;
            return true; 
        }
      
        function checkPassword(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^(?=.*[!@#$%^&*(),.?":{}|<>\ )(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            if(elem.value.trim()=="" || !elem.value.match(patt))
            {
                x.style.cssText="visibility:visible";
                password_val=false;
                return false;
            } 
            x.style.cssText="visibility:hidden";
            password_val=true
            return true; 
        }
        function checkConfirmPass(val,val2,val3)
        {
            x=document.getElementById(val);        
            if((document.getElementById(val2).value)!=(document.getElementById(val3).value))
            {
                x.style.cssText="visibility:visible";
                confirm_val=false
                return false;
            } 
            x.style.cssText="visibility:hidden";
            confirm_val=true;
            return true; 
        }

        function subm_cust(){
            if (email_val && password_val && confirm_val && nm){
                document.getElementById("addUserForm").submit();
            }
        }

        </script>

        </body>
    </html>

<!--session logout!-->
<?php
	}
	else
 		{?>
			<script>
			alert("Already Logout! \n Login to continue.");
			window.location.href="../../login_reg.php";
			</script>
			
			<?php
		}?>