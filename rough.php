<div id="menuBtn">
    <img src ="images/menu.png" id="menu">
</div>

<!-- Features-->

<section id="feature">
<div class="title-text">
<p> FEATURES </p>
<h1> why choose us </h1>    
</div>    
<div class="feature-box">
    <div class="features">
        <h1>Experienced Staff </h1>
        <div class="features-desc">
             <div class="feature-icon">
                <i class="fa fa-shield" ></i>

                  </div>
             <div class="feature-text">
               <p> Salonist do not like to negotiate when it is about customers’ needs.
                    Our supportive team follows every single way to help out the customers 
                    and make them rely on computers' less. 
                   You can approach us anytime; we will assist you in no time.</p>  
             </div>  

           </div>

           <h1> Online Booking </h1>
           <div class="features-desc">
                <div class="feature-icon">
                   <i class="fa fa-mobile" ></i>
   
                     </div>
                <div class="feature-text">
                  <p> The easiest appointment book to use, easily make or change client appointments.
                       Online booking allows clients to book 24/7.</p>  
                </div>  
   
              </div>
              <h1> Affordable Cost </h1>
              <div class="features-desc">
                   <div class="feature-icon">
                      <i class="fa fa-inr"></i>
      
                        </div>
                   <div class="feature-text">
                     <p> Simple, Honest, Affordable Pricing</p>  
                   </div>  
      
                 </div>


 </div>
       <div class="features-img">
       <img src="images/barber-man.jpg">
       </div>
</div>

</section>

<!--Service -->

<section id="service">
<div class="title-text">
<p> SERVICES </p>
<h1> we Provide Better </h1>    
</div>   
<div class="service-box">
    <?php
        $query="SELECT * FROM tbl_service";
        $result=mysqli_query($con,$query);
        while($row=mysqli_fetch_array($result))
        { ?>
            <div class="single-service">
            <a href="user_service_style.php?id=<?php echo $row['ser_id']?>" >
                <img src="images/<?php echo $row['ser_img']?>">
                <div class="overlay"></div>
                <div class="service-desc">
                    <h3><?php echo $row['ser_name']?></h3>
                    <hr>
                    <p><?php echo $row['ser_desc']?></p>
                </div>
                </a>
            </div>
        <?php  } ?>  
</div> 

</section>

<!--Testimonial---->

<section id="testimonial">
    <div class="title-text">
        <p> TESTIMONIALS </p>
        <h1> what client says </h1>    
        </div> 
          <div class="testimonial-row">
          <div class="testimonial-col">
              <div class="user">
                  <img src="images/img-1.jpg">
                  <div class="user-info">
                      <h4> Bibin Thomas  <i class="fa fa-twitter" ></i>
                     </h4>
                      <small>@bibinthomas</small>

                  </div>
              </div>
              <p>  “This was my first time going to hair studio  and I was very impressed. hair studio was friendly and helpful 
                  not to mention a great hairdresser! I’ll be going back. Thanks!” </p>
          </div>
          <div class="testimonial-col">
            <div class="user">
                <img src="images/img-2.jpg">
                <div class="user-info">
                    <h4> Richen Raju  <i class="fa fa-twitter" ></i>
                   </h4>
                    <small>@richenraju</small>

                </div>
            </div>
            <p> “This was my first time going to hair studio  and I was very impressed. hair studio was friendly and helpful 
                  not to mention a great hairdresser! I’ll be going back. Thanks!” </p>
          </div> 
          <div class="testimonial-col">
            <div class="user">
                <img src="images/img-3.jpg">
                <div class="user-info">
                    <h4> Ricky Danial <i class="fa fa-twitter" ></i>
                   </h4>
                    <small>@Rickydaniel</small>

                </div>
            </div>
            <p>  “This was my first time going to hair studio  and I was very impressed. hair studio was friendly and helpful 
                  not to mention a great hairdresser! I’ll be going back. Thanks!” </p>
          </div>    
          </div>


</section>

<!--foteer-->

<section id="footer">
    <img src="images/footer-img.png" class="footer-img">
    <div class="title-text">
        <p> CONTACT </p>
        <h1> visit shop  </h1>    
        </div> 
 <div class="footer-row">
  <div class="footer-left">
      <h1>Opening Hours </h1>
      <p> <i class="fa fa-clock-o" ></i> Monday to Friday - 9AM to 9PM </p>
      <p>  <i class="fa fa-clock-o" ></i>Saturday and Sunday -8Am to 10PM </p>
  </div>
  <div class="footer-right">
      <h1>Get In Touch </h1>
      <p> #30 abc colony ,kottayam city IN  <i class="fa fa-map-marker" ></i></p>
      <p>hairstudio@gmail.com <i class="fa fa-paper-plane" ></i></p>
      <p>+09 8659569955 <i class="fa fa-phone-square" ></i></p>
  </div>      
 </div>       

<div class="social-links">
    <i class="fa fa-facebook-official" ></i>
    <i class="fa fa-instagram" ></i>
    <i class="fa fa-youtube-play" ></i>
    <i class="fa fa-twitter-square" ></i>
    <p> copyright by albinbenny  </p>

</div>

</section>


<script>
    var menuBtn = document.getElementById("menuBtn")
    var sideNav = document.getElementById("sideNav")
    var menu = document.getElementById("menu")

    sideNav.style.right ="-250px";
    menuBtn.onclick = function(){
        if(sideNav.style.right == "-250px"){
            sideNav.style.right ="0";
            menu.src ="images/close.png";
        }
        else{
            sideNav.style.right= "-250px";
            menu.src ="images/menu.png";
        }
    }
    var scroll = new SmoothScroll('a[href*="#"]', {
	speed: 1000,
	speedAsDuration: true
});
    
</script>
</body>
</html>
 