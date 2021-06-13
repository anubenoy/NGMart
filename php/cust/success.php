<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>

.sucessmesage{
  width: 600px;
  height:400px;
  position: absolute;
  left: 50%;
  top:40%;
  transform: translate(-50%,-50%);
  text-align: center;
  font-family: sans-serif;
  font-size: 20px;
}
img{
  position: relative;
  height: 280px;
}
.sucessmesage h4{
  margin-top: 30px;
}
.sucessmesage p {
  display:inline ;
  margin-top: 20px;
}
    </style>
    <script>
      function timerfunc()
      {
        var timeleft = 9;
        var downloadTimer = setInterval( function(){
          if(timeleft <= 0){
            window.location.href = "../../index.php";
          }
        document.getElementById("min").innerHTML =timeleft;
        timeleft -= 1;
        }, 1000);
      }
    </script>
</head>
<body onload=timerfunc()>

<div class="sucessmesage">
  <center><img src="../../images/Success.jpg" alt=""></center>
  <h4 style = "color:black">Redirecting in <p id="min">10</p> sec  </h4>
</div>
 
</body>
</html>