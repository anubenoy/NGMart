<?php
session_start();
if(isset($_SESSION['id']))
{
?>
      <!DOCTYPE html>
      <html>
      <head>
        <?php include('adminHeader.php'); ?>
        
        <script>
                // highlighting active page link
                document.getElementById("active1").removeAttribute("class");
                document.getElementById("active3").setAttribute("class",'active');

        </script>
        
       <style>
                /* spacing */

                table {
                table-layout: fixed;
                border-collapse: collapse;
                background:#ffffff;
                
                }
                
                th, td {
                padding: 13px;
                border-bottom: 1px solid #ddd;
              
                }
                
                tr:hover {background-color: #f5f5f5;}

                /* typography */
                body{
                        font-family: "Arial", Helvetica, sans-serif;
                        font-size: 16px;
                }
                
                th {
                letter-spacing: 2px;
                background:#e6e8e8;
                color:#808080;    
                }
                
                td {
                letter-spacing: 1px;
                text-align:center;
                }

                caption {
                background:#ffffff;
                color: rgb(0,5,5);
                padding: 16px 16px;
                float:left;
                }

                /* popup */
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
                 .formContainer input[type=file] {
                   width: 250px;
                   padding: 15px;
                   margin: 5px 0 20px 0;
                   border: none;
                   background: #eee;
                 }
                 .formContainer input[type=file] {
                  background: white;
                 }
                 .formContainer input[type=text]:focus,
                 .formContainer input[type=file]:focus {
                   background-color: #ddd;
                   outline: none;
                
                 }
                 .formContainer .btn {
                   padding: 12px 20px;
                   border: none;
                   background-color: #8ebf42;
                   color: #fff;
                   cursor: pointer;
                   width: 100%;
                   margin-bottom: 15px;
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
                   top:40px;
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
      <div style="margin-left:15%;padding:26px 26px;">
      <center>
               
        <!-- listing all products -->
        
        <table width="100%">
        <col style="width:4%">
	      <col style="width:15%">
        <col style="width:15%">
	      <col style="width:15%">
	   
        

          <thead>
          <caption>
           <h3>Categories </h3>
           <div class="openBtn">
          <button class="openButton" onclick="openForm()" style="border:none;">Add Category</button>
          </div>
          </caption>
          <tr>
		        <th>#</th>
			      <th>Categories</th>
			      <th>Image</th>
			      <th> </th>	
          </tr>
          </thead>
          <tbody> 
            <?php
                $sql="select * from categories_tbl order by id desc";
                if($result=mysqli_query($con,$sql))
                {
                        $i=0;
                        while($row=mysqli_fetch_array($result))
                        {
                                
                                $i=$i+1;
                                ?>
                                <tr>
                                 <td><?php echo $i?></td>
                                 <td><?php echo $row['categories']?></td>
                                 <td><img src="../../images/<?php echo $row['image']?>" style="border-radius:50%;height:40px;width:40px;"/></td>
                                
                                        <td> 
                                               <!-- edit button -->
                                                <a href="editCategories.php?edit=true&id=<?php echo $row['id'];?>"> <button style="background-color:green;padding:7px;border:none;color:white;width:60px;">Edit</button></a>
                                         </td>
                                </tr>                        
                               <?php
                               
                        }
                }
                ?>
                </tbody>
        </table>

        </center>
        </div>

       
        

<!-- add categories popup -->

     </div>
     <div class="Popup" id="p">
        <div class="formPopup" method="POST" id="popupForm" >
        <form class="formContainer" id="addCategoryForm" action="addcategories.php" method="POST" style="padding:20px;" enctype="multipart/form-data">
       
         <button type="button" class="cancel" onclick="closeForm()" >X</button>
          
          <h2 style="font-size:25px;">Add Product Category</h2>
          
          <!-- catgeory name  --> 
          <div class="addInput">
              <input type="text" id="category" name="category" onchange="checkCategory('err1','category')" placeholder="Category" required>
              <div class="errorText">
              <p id="err1">Invaild Category! eg:pulses,oil,meat,etc.</p> 
              </div>
          </div>
         
          <!-- category image -->
          <div class="addInput">
             <input type="FILE" name="0" id="file" accept="image/x-png,image/jpeg" >
          </div>       
          
          <button type="button" class="btn" onclick="subm_category()">Add Category</button>
          
        </form>
      </div>
    </div>

    

    <script>
        //add admin users val

      function openForm() {
        document.getElementById("p").style.display = "block";
        document.getElementById("popupForm").style.display = "block";
        
      }
      function closeForm() {
        document.getElementById("popupForm").style.display = "none";
        document.getElementById("p").style.display = "none";
      }
      
      function checkCategory(val,val2)
        {
          
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^[A-Za-z\s\-]{3,}$/;
            if(!elem.value.match(patt)|| elem.value.trim()=='')
            {   
                x.style.cssText="visibility:visible";
                cat_val=false
                return false;
            } 
            x.style.cssText="visibility:hidden";
            cat_val=true;
            return true; 
        }
        function subm_category()
        {
            if (cat_val){
              document.getElementById("addCategoryForm").submit(); 
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

