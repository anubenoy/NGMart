<?php
session_start();
if(isset($_SESSION['temp_id']))
{
require_once("../dbconnection.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> <!--  google font roboto -->

    <script>
        
        var name_val= false 
        var email_val= false 
        var password_val= false 
        var confirm_val= false 
        var time=false

        function red(){
            document.getElementById("login_email").style.cssText='border:1px solid red';
            document.getElementById("login_pass").style.cssText='border:1px solid red';
        }
        function none(){
            document.getElementById("login_email").style.cssText='border:none';
            document.getElementById("login_pass").style.cssText='border:none';
        }

        function animate_to_left(){
            movingbackgroud=document.getElementsByClassName("movingbackgroud")[0]
            movingbackgroud.style.cssText="left:0vw;transition:1.2s ease-in-out;animation:banding2 1.2s"
            document.getElementById("butn2").style.transition='0.4s';
            document.getElementById("butn2").style.opacity='0';
            butn1=document.getElementById("butn1")
            butn1.style.cssText="opacity:1;transition-duration:0.6s;transition-delay:0.7s;"
            document.getElementById("button").setAttribute("onclick", "animate_to_right()");

            contents_span2=document.getElementById("contents_span2")
            contents_span2.style.cssText="transition:0.4s;opacity:0"
            contents_span1=document.getElementById("contents_span1")
            contents_span1.style.cssText="opacity:1;transition-duration:0.6s;transition-delay:0.7s;"

            pages=document.getElementById("pages")
            pages.style.cssText="right:0vw;transition:1s ease-in-out"
            document.getElementById("page2").style.cssText="transition-duration:.3s;transition-delay:0.5s;opacity:0"
            document.getElementById("page2").style.visibility="hidden"
            document.getElementById("page1").style.cssText="transition-duration:0.1s;transition-delay:0.6s;visibility: visible;"

            document.getElementById("page3").style.cssText="transition-duration:.3s;transition-delay:0.5s;opacity:0"
            document.getElementById("page3").style.visibility="hidden"
        }

        function animate_to_right(){
            movingbackgroud=document.getElementsByClassName("movingbackgroud")[0]
            butn2=document.getElementById("butn2")
            movingbackgroud.style.cssText="left:70vw;transition:1.2s ease-in-out;animation:banding 1.2s"
            document.getElementById("butn1").style.transition='0.4s';
            document.getElementById("butn1").style.opacity='0';
            butn2.style.cssText="opacity:1;transition-duration:0.6s;transition-delay:0.7s;"
            document.getElementById("button").setAttribute("onclick", "animate_to_left()");

            contents_span1=document.getElementById("contents_span1")
            contents_span1.style.cssText="transition:0.4s;opacity:0"
            contents_span2=document.getElementById("contents_span2")
            contents_span2.style.cssText="opacity:1;transition-duration:0.6s;transition-delay:0.7s;"

            pages=document.getElementById("pages")
            pages.style.cssText="right:30vw;transition:1s ease-in-out"
            document.getElementById("page1").style.cssText="transition-duration:.3s;transition-delay:0.5s;opacity:0"
            document.getElementById("page1").style.visibility="hidden"
            document.getElementById("page2").style.cssText="transition-duration:0.1s;transition-delay:0.6s;visibility: visible;"
        }

        function show_seller_form(val){
            if(val=='True'){
                document.getElementById("err1").style.visibility="hidden";
                document.getElementById("err3").style.visibility="hidden";
                document.getElementById("err4").style.visibility="hidden";
                document.getElementById("err5").style.visibility="hidden";
                document.getElementById("page2").style.visibility="hidden";
                document.getElementById("cust_reg").reset()
                document.getElementById("page3").style.cssText="z-index:2 transition-duration:0.1s;transition-delay:0.7s;visibility: visible;"
            }
            else{
                document.getElementById("err3_1").style.visibility="hidden";
                document.getElementById("err3_2").style.visibility="hidden";
                document.getElementById("err3_3").style.visibility="hidden";
                document.getElementById("err3_4").style.visibility="hidden";
                document.getElementById("err3_5").style.visibility="hidden";
                document.getElementById("sell_reg").reset()
                document.getElementById("page3").style.visibility="hidden";
                document.getElementById("page2").style.cssText="transition-duration:0.1s;transition-delay:0.8s;visibility: visible;"
            }  
        }

        // ----------------------------------validation----------------------

        function err(){
                $(document).ready(function(){$('[data-toggle="popover"]').popover();});
            }
            
        function checkPhone(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^([6-9]{1})+([0-9]{9})$/;
            if(!elem.value.match(patt)|| elem.value.trim()=='')
            {   
                x.style.cssText="visibility:visible";
                err();
                phone_val=false
                return false;
            } 
            x.style.cssText="visibility:hidden";
            phone_val=true;
            return true; 
        }

        function subm_sell(){
            if (phone_val){
                document.getElementById("sell_reg").submit();
                // alert("yes")
            }
            else{
                alert("not registered")
            }
        }
        async function ajax() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    document.getElementById('loc').innerHTML=this.responseText;
                }
            }; 
            xhttp.open("GET", "../../location.php?dis="+document.getElementById('dis').value, true);
            xhttp.send();
        }

    </script>

    <style>
        body{
            padding: 0px;
            margin:0px;
            display: block;
            background-color: rgb(253,253,253);
        }
        .bakground1{
            width: 100vw;
            height: 100vh;
            position: absolute;
            z-index: -2;
            background-image: url(../../images/gif2.gif);
            background-repeat: no-repeat;
            background-size: cover;
            opacity: .15;
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);

        }
        .background2{
            width: 50vw;
            height: 50vh;
            position: absolute;
            top:50%;
            transform: translate(0,-64%);
            right: 0px;
            z-index: -3;
            opacity: .9;

        }
        
        @keyframes banding2{
            from{transform:scale3d(1,1,1);}
            50%{transform:scale3d(1.75,1,1);}
            to{transform:scale3d(1,1,1);}
        }
        @keyframes banding{
            from{transform:scale3d(1,1,1);}
            50%{transform:scale3d(1.75,1,1);}
            to{transform:scale3d(1,1,1);}
        }
        h1{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size:40px;
            font-weight: 800;
            color:white
        }
        p{
            color: white;
            font-size:large;
            font-weight: 300;
        }
        button{
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 10vw;
            height: 50px;
            background: none;
            color: white;
            font-size: large;
            font-weight: 300;
            border: solid white 1px;
            border-radius: 30px;
            /* margin-top: 20px; */
        }
        button:hover{
            cursor: pointer;
        }
        button span{
            position: absolute;
        }
        .content_login{
            position: relative;
            right:0px;
            width:65%;
            height: 100vh;
            float:left;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .content_login .container{
            width: 50vw;
            position: absolute;
            display: block;
        }
        .content_login .container h1{
            margin-bottom: 40px;
        }
        select,option{
            
            color: grey;
            margin-left:-24px;
        }
        input[type=text],input[type=password],input[type=FILE],input[type=tel],select,textarea{
            width: 25vw;
            height: 50px;
            margin-top: 10px;
            padding: 10px;
            border: none;
            font-size: 15px;
            background-color: rgba(209, 233, 215, 0.255);
            
        }
        
        input[type=FILE]{
            margin-left:-30px;
        }
        input:focus,select:focus{
            outline: none;
        }
        button:focus{
            outline: none;
        }
        input::placeholder{
            font-size: large;
        }
        input[type=submit], input[type=button]{
            width: 15vw;
            height: 60px;
            background: rgb(47, 142, 119);
            color:white;
            font-size: large;
            font-weight: 500;
            border: none;
            border-radius: 30px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        input[type=time],#workday{
            background: rgba(209, 233, 215, 0.255);
            border: none;
            width: 8.8vw;
            height: 50px;
            margin-top:10px;
        }
        #workday{
            margin-left:0px;
            width: 9vw;
        }
        
        input[type=submit]:hover{
            background: rgba(47, 142, 118, 0.926);
            cursor: pointer;
            box-shadow:1px 2px 20px rgba(117, 174, 160, 0.467);
        }
        a{
            font-family: 'Roboto', sans-serif;
            text-decoration: none;
            color:rgba(128, 128, 128, 0.646);
            font-size: 13px;
            cursor: pointer;
        }
        
        .container form div{
            position: relative;
            margin-left: 10px;
        }
        .container form div div{
            position: relative;
            width: auto;
            height:60px
        }
        .container form div div div{
            margin-top: 10px;
        }
        input::placeholder {
            font-size: 15px;
        }
        input[type=file]::file-selector-button {
            border:none;
            width:100px;
            height:30px;
            padding: .2em .4em;
            border-radius: .2em;
            background: rgba(47, 130, 100,.7);
            color:white;
            cursor: pointer;
        }
    </style>
</head>
<body>
        <!-- ------------------------------page 3 -------------------------- -->
    <div class="bakground1"></div>
    <div class="background2"><img src="../../images/gif1.gif" alt=""></div>
    <div class="content_login" id="pages"> 
        
        <div class="container" id="page3">
            <center>
            <form action="insertShopDetails.php" method="POST" enctype="multipart/form-data" id="sell_reg" >
              <h1 style="color:rgb(65,178,151);">Set up your Shop</h1>
                <div>
                    <!-- shop name
                    <div>
                        <input type="text" id="name_3" name="name" onchange="checkName('err3_1','name_3')" placeholder="Shop Name" required >
                        <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err3_1" style="visibility: hidden;" data-content="Invalid name!">
                            <img src="..\..\images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div> -->
                    
                    <!-- mobile number  -->
                    <div>
                        <input type="text" id="phone_3" name="phone" onchange="checkPhone('err3_2','phone_3')" placeholder="Mobile Number" required>
                        <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err3_2" style="visibility: hidden;" data-content="Invaild Mobile number! Should contain 10 digits!" >
                            <img src="..\..\images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                    <!-- address  -->
                    <div>
                        <textarea  id="address_3"  name="address" placeholder="Address" required></textarea>
                        <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err3_3" style="visibility: hidden;" data-content="Invaild Address" >
                            <img src="..\..\images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                    <!-- district -->
                     <div>
                        <select name="district" id="dis" onchange="ajax()" required>
                            <option  value="0">District</option>
                            <?php
                                $query="select * from district_tbl";
                                $result=mysqli_query($con,$query);
                                while($row=mysqli_fetch_array($result)){
                                    echo "<option value=".$row['dist_id'].">".$row['district_name']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                        <!-- location place -->
                    <div>
                        <select name="location" id="loc" required>
                            <option  value="0">Locality</option>
                        </select>
                    </div>
                    <!-- work days -->
                    <div class="work_day" style="margin-left:-10px; margin-top:10px;">
                        <label>Work Days </label>
                        <select name="workday1" id="workday" required>
                            <option  value="0">-Day-</option>
                            <option  value="Saturday">Saturday</option>
                            <option  value="Sunday">Sunday</option>
                            <option  value="Monday">Monday</option>
                            <option  value="Tuesday">Tuesday</option>
                            <option  value="Wednesday">Wednesday</option>
                            <option  value="Thursday">Thursday</option>
                            <option  value="Friday">Friday</option>
                        </select>
                        to
                        <select name="workday2" id="workday" required>
                            <option  value="0">---</option>
                            <option  value="Saturday">Saturday</option>
                            <option  value="Sunday">Sunday</option>
                            <option  value="Monday">Monday</option>
                            <option  value="Tuesday">Tuesday</option>
                            <option  value="Wednesday">Wednesday</option>
                            <option  value="Thursday">Thursday</option>
                            <option  value="Friday">Friday</option>
                        </select>

                    </div>
                    <!-- time  -->  
                     <div>
                        <Label>Work Hours</label> <input type="time" id="time3_1" name="timeone" required> to <input type="time" id="time_2" name="timetwo" required>
                        <a href="javascript:err()" data-toggle="popover"  data-trigger="focus" id="err3_5" style="visibility: hidden;" data-content="Time not valid !">
                             <img src="..\..\images\error.png" height="20px" onclick="err()" width="20px">
                         </a>
                     </div>
                        
                    <!-- shop image -->
                    <div class="addInput">
                        <input type="FILE" name="0" id="file" accept="image/x-png,image/jpeg" required>
                    </div>       
          
          
                
                </div>
                <!-- submit  -->
                <input type="button" value="SIGN UP" name="btn_submit" onclick="subm_sell()"><br>
                
            </form>
            </center>
        </div>
    </div>
</body>
</html>
<?php  }
	else
 	{ ?>
		<script>
		alert("Already Logout! \n Login to continue.");
		window.location.href="../../login_reg.php";
		</script>
		
	<?php
	} ?>