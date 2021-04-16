<!-- edit button execution -->
<?php
session_start();
if(isset($_SESSION['id']))
{
include("../dbconnection.php");
?>
      <!DOCTYPE html>
      <html>
      <head>
      <style>
                /* popup */
         {
           box-sizing: border-box;
         }
         .Popup {
           text-align: center; 
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
           position: fixed;
           left: 50%;
           top: 25%;
           transform: translate(-50%, 5%);
           border: 3px solid #999999;
           z-index: 9;
           opacity: 0.95;
        
         }
         .formContainer {
           width: 400px;
           padding: 20px;
           background-color: #fff;
         }
         .formContainer input[type=text],
         .formContainer input[type=file] {
           width: 300px;
           padding: 15px;
           margin: 5px 0 20px 0;
           border: none;
           background: #eee;
         }
         .formContainer input[type=file] {
          background: white;
         }
         .formContainer input[type=text]:focus{
           background-color: #ddd;
           outline: none;
        
         }
         .formContainer .btn {
           padding: 12px 20px;
           border: none;
           background-color: #8ebf42;
           color: #fff;
           cursor: pointer;
           width: 85%;
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
         .photo{
            position:relative;
            width: 100px;
            height: 100px;
            left :50%;
            top:50%;
            transform:translate(-50%,-20%);
            
        }
        .img{
          /* background-attachment: fixed; */
	        /* background-position: center; */
	          background-size:100px 100px;
	          /* background-repeat: no-repeat; */
            height:100px;
            width:100px;
            border-radius:50%;
        }
        .edit{
            position:absolute;
            left :50%;
            top:50%;
            transform:translate(-50%,-10%);
            color:white;
            opacity:0;
            width:100%;
            height:100%
            
        }
        .edit:hover{
            opacity:1;
        } 
        
        </style>
    </head>
   
    <body>
    <?php
        if( isset($_GET['edit'])=='true' && isset($_GET['id']) )
                {
                    $id=$_GET['id'];
                    $sql="select * from categories_tbl where id=$id";
                    if($result=mysqli_query($con,$sql))
                    {
                        $row=mysqli_fetch_array($result)

                  ?>
                    <div class="Popup" id="p1">
                        <div class="formPopup" method="POST" id="popupForm">
                          <form class="formContainer" id="editCategoryForm" action="updateCategory.php?id=<?php echo $id ?>" method="POST" style="padding:20px;" enctype="multipart/form-data">
                          
                            <button type="button" class="cancel" onclick="location.href='categories.php';" >X</button>
                            
                            <h2 style="font-size:25px;">Edit Product Category</h2>
                           
                           <!-- category image -->
                            <div class="photo">
                            
                            <center>
                                <div id="pro" class="img" onclick="upload()">
                                    <div class="edit">Upload an image</div>
                                        <script>document.getElementById('pro').style.cssText="background-image: url('../../images/<?php echo $row['image'] ?>');"</script>
                                    <input id="upload" style="visibility:hidden;cursor:pointer" type="FILE" accept="image/x-png,image/jpeg" name='0'>
                                </div> 
                            </center>
                        </div>
                            
                            <!-- category name  --> 
                            <div class="addInput">
                                <input type="text" id="category" name="category" pattern="[A-Za-z\s\-]{3,}" onchange="checkCategory('err1','category')" value="<?php echo $row['categories']?>" required>
                                <!-- <div class="errorText">
                                <p id="err1">Invaild Category! eg:pulses,oil,meat,etc.</p> 
                                </div> -->
                            </div>
                                 
                            
                            <input type="submit" class="btn" value="Edit Category">

                          </form>
                         <div>
                     </div>
                    

                    <script>
                         
                            function upload(){
                                    document.getElementById('upload').click();
                             }
                    </script>
        </body>
        </html>
                        <?Php
                        }
                    
                }

}
	else
 	{ ?>
		<script>
		alert("Already Logout! \n Login to continue.");
		window.location.href="../../login_reg.php";
		</script>
		
	<?php
	} ?>
       
