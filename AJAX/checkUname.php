<?php
if(isset($_REQUEST["uname"]))
{
	$conkey = mysqli_connect("localhost","root","","chacko_mash");
	$q="select * from login where log_uname='".$_REQUEST["uname"]."'";
	if($resref = mysqli_query($conkey,$q))
	{
		if(mysqli_num_rows($resref))
		{
			echo "not Available";
		}
		else
		{
			echo "Available";
		}
	}
}



?>
