<?php
require_once("php/dbconnection.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        function checkName(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^[a-zA-Z\. ]{3,30}$/;
            if(elem.value.trim()=="" || !elem.value.match(patt))
            {   
                x.style.cssText="visibility:visible";
                err();
                name_val=false;
                return false;
            } 
            x.style.cssText="visibility:hidden";
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
                x.style.cssText="visibility:visible";
                err();
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
                err();
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
                err();
                confirm_val=false
                return false;
            } 
            x.style.cssText="visibility:hidden";
            confirm_val=true;
            return true; 
        }


        function subm_cust(){
            if (name_val && email_val && password_val && confirm_val){
                document.getElementById("cust_reg").submit();
            }
        }

        function subm_sell(){
            if (email_val && password_val && confirm_val ){
                document.getElementById("sell_reg").submit();
                // alert("yes")
            }
            else{
                alert("fill out all details correctly")
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
            xhttp.open("GET", "location.php?dis="+document.getElementById('dis').value, true);
            xhttp.send();
        }

    </script>

    <style>
        body{
            padding: 0px;
            margin:0px;
            display: block;
        }
        .movingbackgroud{
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            left:0vw;
            height: 100vh;
            width:30%;
            background: rgb(65,178,151);
            transition:2s;
            float:left;
            z-index: 1;
            
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
            font-size: 5px;
            color: grey;
            margin-left:-24px;
        }
        input[type=text],input[type=password],select{
            width: 25vw;
            height: 50px;
            margin-top: 10px;
            padding: 10px;
            border: none;
            font-size: large;
            background-color: rgba(209, 233, 215, 0.255);
            
        }
        input:focus,select:focus{
            outline: none;
        }
        button:focus{
            outline: none;
        }
        input::placeholder{
            font-size: small;
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
        input[type=time]{
            background: rgba(209, 233, 215, 0.255);
            border: none;
        }
        input[type=submit]:hover{
            background: rgba(47, 142, 118, 0.926);
            cursor: pointer;
            box-shadow:1px 2px 20px rgba(117, 174, 160, 0.467);
        }
        a{
            cursor: pointer;
        }
        .forget{
            font-family: 'Roboto', sans-serif;
            text-decoration: none;
            color:rgba(128, 128, 128, 0.646);
            font-size: 13px;
            cursor: pointer;
        }
        .movingbackgroud .container {
            width: 25vw;
            display: block;
        }
        .contents_to_hide{
            position: relative;
            width:25vw;
            height: 150px;
        }
        .movingbackgroud .container .contents_to_hide .span{
            position: absolute;
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
    </style>
</head>
<body>
    <div class="movingbackgroud">
        <div class="container">
            <center>
                <div class="contents_to_hide">
                    <div id="contents_span1" class="span">
                        <h1>Hello, Friend</h1>
                        <p>Enter you personal details and start a safe journey with us </p><br>
                    </div>
                    <div id="contents_span2" class="span" style="opacity:0;">
                        <h1>Welcome, Back</h1>
                        <p>To keep connected with us, please login in with your personal credentials.</p><br>
                    </div>
                </div>
                    <button id="button" onclick="animate_to_right()">
                        <span id=butn1>SIGN UP</span>
                        <span id=butn2 style="opacity: 0;">SIGN IN</span>
                    </button>
            </center>
        </div>
    </div>
    <!-- above is the sliding window defined  -->

    <!-- below there is tree pages login, cus_reg, seller_reg -->

    <div class="content_login" id="pages">
        <!-- --------------------------page 1------------------------------- -->
        <div class="container" id="page1" >
            <center>
                <form action="php/login.php" method="POST" id="login_form">
                    <h1 style="color:rgb(65,178,151);">Sign in to <a href="index.php" style="text-decoration: none;color:rgb(65,178,151);cursor: pointer;">NGMART</a> </h1>
                    <input type="text" name="login_email" id="login_email" onKeyUp="none()" placeholder="Email_ID" required><br>
                    <input type="password" name="login_pass" id="login_pass" onKeyUp="none()" placeholder="Password" required><br>
                    <input type="submit" value="SIGN IN"><br>
                    <a class="forget" href="php/forget_pass/forget_pass.php">Forget password ?</a>
                </form>
            
                <?php
                    if(isset($_GET['err'])){?>
                    <script>red()</script>
                    <?php }
                ?>

            </center>    
        </div>

        <!-- ------------------------------page 2 -------------------------- -->
        <div class="container" id="page2" style="visibility: hidden;">
            <center>
            <form action="php/customer_reg.php" method="POST" enctype="multipart/form-data" id="cust_reg" >
              <h1 style="color:rgb(65,178,151);">Create an Account</h1>
                <div>
                    <!-- name -->
                    <div>
                        <input type="text" id="name" name="name" onchange="checkName('err1','name')" placeholder="Name" required >
                        <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err1" style="visibility: hidden;" data-content="Invalid name!">
                            <img src="images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                    <!-- email  -->
                    <div>
                        <input type="text" id="email" name="email" onchange="checkEmail('err3','email')" placeholder="Email" required>
                        <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err3" style="visibility: hidden;" data-content="Invaild Email! eg:something@something.com">
                            <img src="images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                    <!-- password  -->
                    <div>
                        <input type="password" id="password"  name="password" onchange="checkPassword('err4','password')" placeholder="Password" required>
                        <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err4" style="visibility: hidden;" data-content="Invalid! eg:#Ay&iou31 min:8chars ">
                            <img src="images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                    <!-- confirm password  -->
                    <div>
                        <input type="password" id="ConfirmPass" name="confirm_password" onchange="checkConfirmPass('err5','password','ConfirmPass')" placeholder="Confirm Password" required>
                        <a href="javascript:err()" data-toggle="popover"  data-trigger="focus" id="err5" style="visibility: hidden;" data-content="Password don't match!">
                            <img src="images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                 <!-- district -->
                    <div>
                        <select name="district" id="dis" onchange="ajax()" required style="font-size:13.5px;">
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
                        <select name="location" id="loc" style="font-size:13.5px;" required>
                            <option  value="0">Location</option>
                        </select>
                    </div>
                </div>
                    
                <!-- submit  -->
                <input type="button" value="SIGN UP" name="btn_submit" onclick="subm_cust()"><br>
                <a onclick="show_seller_form('True')">Register as seller ?</a>
            </form>
            </center>
        </div>
        <!-- ------------------------------page 3 -------------------------- -->
        <div class="container" id="page3" name="page3" style="visibility: hidden;">
            <center>
            <form action="php/seller_reg.php" method="POST" enctype="multipart/form-data" id="sell_reg" >
              <h1 style="color:rgb(65,178,151);">Create an Account</h1>
                <div>
                    <!-- name -->
                    <div>
                        <input type="text" id="name_3" name="name" onchange="" placeholder="Shop Name" required >
                        <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err3_1" style="visibility: hidden;" data-content="Invalid name!">
                            <img src="images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                    <!-- email  -->
                    <div>
                        <input type="text" id="email_3" name="email" onchange="checkEmail('err3_2','email_3')" placeholder="Email" required>
                        <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err3_2" style="visibility: hidden;" data-content="Invaild Email! eg:something@something.com">
                            <img src="images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                    <!-- password  -->
                    <div>
                        <input type="password" id="password_3"  name="password" onchange="checkPassword('err3_3','password_3')" placeholder="Password" required>
                        <a href="javascript:err()" data-toggle="popover" data-trigger="focus" id="err3_3" style="visibility: hidden;" data-content="Invalid! eg:#Ay&iou31 min:8chars ">
                            <img src="images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                    <!-- confirm password  -->
                    <div>
                        <input type="password" id="ConfirmPass_3" name="confirm_password" onchange="checkConfirmPass('err3_4','password_3','ConfirmPass_3')" placeholder="Confirm Password" required>
                        <a href="javascript:err()" data-toggle="popover"  data-trigger="focus" id="err3_4" style="visibility: hidden;" data-content="Password don't match!">
                            <img src="images\error.png" height="20px" onclick="err()" width="20px">
                        </a>
                    </div>
                    <!-- time  -->
                    <div style="display:none">
                        <div>
                            WeekDays: <input type="time" id="time3_1" name="timeone" onchange="time_t(err3_5)" required> to : <input type="time" id="time_2" name="timetwo" onchange="time_t(err3_5)" required>
                            <a href="javascript:err()" data-toggle="popover"  data-trigger="focus" id="err3_5" style="visibility: hidden;" data-content="Time not valid !">
                                <img src="images\error.png" height="20px" onclick="err()" width="20px">
                            </a>
                        </div>
                        
                    </div> 
                </div>
                <!-- submit  -->
                <input type="button" value="SIGN UP" name="btn_submit" onclick="subm_sell()"><br>
                <a onclick="show_seller_form('false')">Register as customer ?</a>
            </form>
            </center>
        </div>
    </div>
</body>
</html>
<?php
//}
?>