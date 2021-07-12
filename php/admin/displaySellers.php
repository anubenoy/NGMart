<?php
session_start();
if(isset($_SESSION['id']))
{
?>
        <!DOCTYPE html>
        <html>
        <head>
        <link rel="stylesheet" href="../../style/headerStyle.css">
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
            <h3 style="text-align:left;">Register Sellers</h3>

            </caption>

            <tr>
              <th scope="col">Sl.No#</th>
              <th scope="col">NAME</th>
              <th scope="col">EMAIL ID</th>
              <th scope="col">Mobile num</th>
              <th scope="col"> </th>
              </tr>
              </thead>
              <tbody> 
            <?php
            $sql="SELECT l.*,s.* FROM login_tbl AS l, sellerreg_tbl AS s WHERE s.seller_login_id=l.login_id AND l.user_type='seller'";
                if($result=mysqli_query($con,$sql))
                {
                  $i=0;
                    while($row=mysqli_fetch_array($result))
                    {
                      $i=$i+1; 
                        ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td> <?php echo $row['seller_name'];?> </td>
                          <td> <?php echo $row['email'];?> </td>
                          <td scope="row"> <?php echo $row['seller_mobile_no'];?> </td>
                          <td> 
                              <!-- delete button -->
                              <a href="editAdminUser.php?seller=true&delete=true&id=<?php echo $row['login_id'];?>">
                              <button style="background-color:red;padding:7px;border:none;color:white;">
                                      <?php
                                      if($row['status']==1) {echo "Block";}
                                      else {echo "Unblock";}
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
    
    
    <script>

      // highlighting active page link
      document.getElementById("active1").removeAttribute("class");
      document.getElementById("active4").setAttribute("class",'active');
              
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