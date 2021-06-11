<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body{
    padding:0px;
    margin:0px;
}

.footer{
    margin-top: 50px;
    width: 50%;
    height:80px;
    position:relative;
    float: left;
    bottom: 0px;
    background-image:radial-gradient(circle,rgb(247,247,247),rgb(255,255,255)); 
    left:50%;
    transform: translate(-50%);
}
.footer .topborder{
    position: relative;
    top:0px;
    background-image:radial-gradient(circle,rgba(128, 127, 127, 0.269),rgb(255,255,255)); 
    width:100%;
    height:2px;
}

.error{
    color: red;
    display: none;
    float: left;
    position: absolute;
    left: 38.5vw;
    z-index: 2;
    margin-top: -22px;

}
.defaultAddress{
    position: relative;
    width:100%;
    float:left;
}
a{
    text-decoration: none;
    color:rgb(9, 188, 219);
}
</style>

</head>
<body>
     
   <!-- page footer -->
   <center>
        <div class="footer">
            <div class="topborder"></div>
            <p><a href="">Conditions of Use</a> | <a href="">Privacy Notice</a> &copy; 2020-2022, NGMart.com, Inc. and its affliates </p>
        </div>
    </center>
</body>
</html>
