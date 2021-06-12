<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
    .tick{
    display:block;
    transition: transform 1s;
    top:50%;
    left:50%;
    transform: translate(-50%, -30%);
    position: fixed;
    margin:10px;
    width:250px;
    height:250px;
    background-color: rgba(170, 167, 167, 0.76);
    border-radius: 10px;
}
.check.icon {
    color: white;
    position: absolute;
    top: 30%;
    left: 30%;
    margin-left:auto;
    margin-top:auto;
    width: 100px;
    height: 45px;
    border-bottom: solid 1px currentColor;
    border-left: solid 1px currentColor;
    -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
}
.msg{
  position: relative;
  
  top:60%;
  left:30%;
 
}

    </style>
</head>
<body>
    
<div class="tick" id="tic" >
   <div class="check icon"></div>
 </div>

 <div class="msg">
  <h2>Order Placed!</h2>
</div>
    
</body>
</html>