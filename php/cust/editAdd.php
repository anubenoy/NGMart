<?php
session_start();
if(isset($_SESSION['reg_id'])){
    include("../dbconnection.php");
    if(isset($_GET['add_id'])){$add_id=$_GET['add_id'];}

 

    if(isset($_POST["edit"])){

        $f_name=$_POST['f_name'];
        $house=$_POST['house'];
        $area=$_POST['area'];
        $cities=$_POST['cities'];
        $state=$_POST['state'];
        $pin=$_POST['pin'];
        $country=$_POST['country'];
        $mobile=$_POST['mobile'];
       
        if(isset($_POST['default_add']))
        {   
            $d1=$_POST['default_add']; 
            if($d1=='on'){ 
                $sql="UPDATE address_tbl SET add_full_name='$f_name',add_pincode=$pin,add_country_id=$country,add_state_id=$state,add_cities_id= $cities,add_house_name='$house',add_area='$area',add_mobile_no='$mobile',add_default='true' WHERE add_id=$add_id";
                if(mysqli_query($con,$sql)){ header("location:deliveryAdd.php");}
        }
        }else{  
                $sql="UPDATE address_tbl SET add_full_name='$f_name',add_pincode=$pin,add_country_id=$country,add_state_id=$state,add_cities_id= $cities,add_house_name='$house',add_area='$area',add_mobile_no='$mobile',add_default='false' WHERE add_id=$add_id"; 
                if(mysqli_query($con,$sql)){ header("location:deliveryAdd.php");}
        }
        
    }
    
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select a delivery address</title>
    <link href="../../style/deliveryAdd_style.css" rel="stylesheet"/>

    <script>

        function CheckName(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^[a-zA-Z\.\s]{3,30}$/;
            if(elem.value.trim()=="" || !elem.value.match(patt))
            {
               x.style.cssText="display:block";
                name_value=false;
                return; //to skip rest code avoiding use of else
            }
            x.style.cssText="display:none";
            name_value=true;
            
        }

        function checkPhone(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^([6-9]{1})([0-9]{9})$/;
            if(!elem.value.match(patt)|| elem.value.trim()=='')
            {   
                x.style.cssText="display:block;left:25.3vw";
                phone_val=false
                return;
            } 
            x.style.cssText="display:none";
            phone_val=true;
        }

        function checkPin(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^[1-9]{1}[0-9]{2}\s{0,1}[0-9]{3}$/;
            if(!elem.value.match(patt)|| elem.value.trim()=='')
            {   
                x.style.cssText="display:block; margin-top:-34px; left:31.5vw ";
                pin_val=false
                return;
            } 
            x.style.cssText="display:none";
            pin_val=true;
        }

        function checkHouse(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^[a-zA-Z0-9\.\,\s\(\)]{3,30}$/;
            if(!elem.value.match(patt)|| elem.value.trim()=='')
            {   
                x.style.cssText="display:block; margin-top:-34px; left:32.6vw ";
                house_val=false
                return;
            } 
            x.style.cssText="display:none";
            house_val=true;
        }
        function checkAdd(val,val2)
        {
            elem=document.getElementById(val2);
            x=document.getElementById(val);
            patt=/^[a-zA-Z0-9\.\,\s]{3,30}$/;
            if(!elem.value.match(patt)|| elem.value.trim()=='')
            {   
                x.style.cssText="display:block; left:32.6vw ";
                add_val=false
                return;
            } 
            x.style.cssText="display:none";
            add_val=true;
        }
        
        function edit_address() {
            if(name_value && phone_val && pin_val && house_val && add_val){
                document.getElementById('add_delivery_addr').submit();
            }
        }

        async function ajax() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200)
                {
                    document.getElementById('state').innerHTML=this.responseText;
                }
            };
            xhttp.open("GET","state.php?mode=country&country="+document.getElementById('country').value,true);
            xhttp.send();

        }

        async function ajaxCities() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200)
                {
                    // console.log(this.responseText)
                    document.getElementById('cities').innerHTML=this.responseText;
                }
            };
            xhttp.open("GET","state.php?mode=cities&state="+document.getElementById('state').value,true);
            xhttp.send();

        }
        // function resetPage(){
        //     document.getElementById("add_delivery_addr").reset();
        //     // alert("reset")
        // }
    </script>
</head>
<body>
   <div class="delivery_main">
        <img src="../../images/logo.png" id="d_logo" onclick="location.href='../../index.php'"/>

        <!-- // CURRENT STATUS -->
        <div class="status">
            <hr class="logo_hr">
            <hr class="hr_progress">
            <p>SIGN IN </p>
            <p>DELIVERY & PAYMENT</p>
            <p>PLACE ORDER</p>
            <p>COMPLETE PAYMENT</p>
        </div><br><br>
        
        
        

        <!-- CURRENT STATUS ENDS HERE  -->
  <!--add new adress form  -->
  <div class="new_addr">

<!-- <hr class="hor_line"> -->

<h4 id="add_addr"> Your Address</h4>

<form id="add_delivery_addr" method="POST">
<?php
         $sql="SELECT * FROM address_tbl WHERE add_id=$add_id";
         $result3=mysqli_query($con,$sql);
         while($row=mysqli_fetch_array($result3))
         {
             $country_id=$row['add_country_id'];
             $state_id=$row['add_state_id'];
             $cities_id=$row['add_cities_id'];
    
         
         
             $sql2="SELECT co.*,st.*,ci.* FROM countries_tbl AS co,states_tbl AS st,cities_tbl AS ci,address_tbl AS ad  WHERE ci.cities_state_id=st.state_id AND ci.cities_country_id=co.country_id AND ci.cities_id=$cities_id ";
             $result2=mysqli_query($con,$sql2);
             $row2=mysqli_fetch_array($result2);
       
?>

            <label>Country/Region</label><br>
            <select name="country" id="country" onchange="ajax()" required>
                <option value="<?php echo $country_id;?> "><?php echo $row2['country_name']?></option>
                <?php
                $sql="select * from countries_tbl";
                $result=mysqli_query($con,$sql);
                while($rown=mysqli_fetch_array($result)){echo "<option value=".$rown['country_id'].">".$rown['country_name']."</option>";}?>
            </select><br><br>
            
            <label>Full Name (First and Last name)</label><br>
            <input type="text" name="f_name" id="f_name" onchange="CheckName('err1','f_name')" value="<?php echo $row['add_full_name']; ?>" required>
            <p id="err1" class="error" > Invalid name! </p><br><br>
            
            <label>Mobile number</label><br>
            <input type="text" name="mobile"  id="mobile" onchange="checkPhone('err2','mobile')" placeholder="10-digit mobile number without prefixes" value="<?php echo $row['add_mobile_no']; ?>" required>
            <p id="err2" class="error" > Invaild! Mobile number should contain 10 digits!</p><br><br>
            
            <label>PIN code</label><br>
            <input type="text" name="pin" id="pin" onchange="checkPin('err3','pin')" placeholder="6-digits [0-9] PIN code" required value="<?php echo $row['add_pincode']; ?>"><br><br>
            <p id="err3" class="error" > Invaild! 6-digits [0-9] PIN code!</p>
            
            <label style="width:50%;">Flat, House no., Building, Company, Apartment</label><br>
            <input type="text" name="house" id="house" onchange="checkHouse('err4','house')" value="<?php echo $row['add_house_name']; ?>"required><br><br>
            <p id="err4" class="error" > Invaild! Only digits & letters!</p>
            
            <label>Area, Colony, Street, Sector, Village</label><br>
            <input type="text" name="area" id="area" onchange="checkAdd('err5','area')" value="<?php echo $row['add_area']; ?>" required>
            <p id="err5" class="error"> Invaild! Only digits & letters!</p><br><br>
            
            <!-- <label>Landmark</label><br>
            <input type="text" name="landmark" id="landmark" onchange="checkLandmark('err6','landmark')" placeholder="Eg: Behind Central theatre, Near AIIMs Flyover">
            <p id="err6" class="error"> Invaild! Only digits & letters!</p><br><br> -->
            
            <label>State/Province/Region</label><br>
            <select name="state" id="state" onchange="ajaxCities()" required>
                <option value="<?php echo $state_id;?>"><?php echo $row2['state_name']?></option>
                <?php
                $sqls="SELECT * FROM states_tbl WHERE state_country_id=$country_id";
                $results=mysqli_query($con,$sqls);
                while($rows=mysqli_fetch_array($results)){echo "<option value=".$rows['state_id'].">".$rows['state_name']."</option>";}?>
            </select><br><br>
            
            <label>Town/City</label><br>
            <select name="cities" id="cities" required>
                <option value="<?php echo $cities_id;?>"><?php echo $row2['cities_name']?></option>
                <?php
                $sqlc="SELECT * FROM cities_tbl WHERE cities_state_id=$state_id";
                $resultc=mysqli_query($con,$sqlc);
                while($rowc=mysqli_fetch_array($resultc)){echo "<option value=".$rowc['cities_id'].">".$rowc['cities_name']."</option>";}?>
            </select><br><br>
            
            <!--<h4 style="font-size:16px;">Add delivery instructions</h4>
            <p>Preferences are used to plan your delivery. However, shipments can sometimes arrive earlier or later than planned.</p>
            
            <label>Address Type</label><br>
            <select name="add_type" id="add_type" required>
                <option value="0" >Select an Address Type</option>
                <option value="home">Home</option>
                <option value="work">Work</option>
                <option value="other">Other</option>
            </select><br><br> -->
            
            <?php $d=$row['add_default'];
            if($d=='true'){
                echo '<input type="checkbox" name="default_add" checked>';
                echo ' <label>Use as my default address</label><br><br>';
            }else{
                echo '<input type="checkbox" name="default_add">';
                echo ' <label>Use as my default address</label><br><br>';
            }
               ?>
            
            
            
            <button  onclick="edit_address()" class="deliver_btn1" name="edit" style="font-size: 11px; width:100px;">Edit Address</button> <br><br>
<?php } ?>
 </form>
    
    
</div>


</div> 
   
   <!-- page footer -->
    <center>
        <div class="footer">
            <div class="topborder"></div>
            <p><a href="">Conditions of Use</a> | <a href="">Privacy Notice</a> &copy; 2020-2022, NGMart.com, Inc. and its affliates </p>
        </div>
    </center>
</body>
</html>

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