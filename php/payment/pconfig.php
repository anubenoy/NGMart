<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51J1ZrdSJxSambAotsti1wEwkGBLW1ZUkciUjjRcuz0t2XjMcJNJ7sdo2H8zheqef0zpgjQtd1NlXt8cFm4Nnziig00fhAUguER";

$secretKey="sk_test_51J1ZrdSJxSambAotFbQMU9wPqTnIlLCh3a687yB8OIGFS3lnPiWKxrIOKDrLZCKVnA8pNkI7iuDZy797LgV2fTPB00MfjGn8cW";

\Stripe\Stripe::setApiKey($secretKey);
?>