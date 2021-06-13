<?php
session_start();
$paise_total=$_SESSION['paise_total'];
require('pconfig.php');
?>
<form action="submit.php" method="post" style="padding-left:45%; padding-top:20%;">
	<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo $publishableKey?>"
		data-amount="<?php echo $paise_total?>"
		data-name="Payment"
		data-description="Purchace with NGMart"
		data-image="../../images/logo.png"
		data-currency="inr"
		data-email="anubenoy@mca.ajce.in"
	>
	</script>

</form>