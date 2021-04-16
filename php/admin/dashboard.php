<?php
session_start();
if(isset($_SESSION['id']))
{
 
	?>
    <!DOCTYPE html>
    <html>

    <?php include('adminHeader.php'); ?>

      
    <div style="margin-left:15%;padding:1px 16px;height:1000px;">
      <h2>Dashboard</h2>
      
    </div>

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