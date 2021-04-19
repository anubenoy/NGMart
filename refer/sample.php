<?php
//var_dump($_FILES["subcategory_pic"]);
require_once("classes/FormAssist.class.php");
require_once("classes/DataAccess.class.php");
require_once("classes/FormValidator.class.php");
$fields=array("dist"=>"","loca_name"=>"");
$rules=array("dist"=>array("required"=>""),"loca_name"=>array("required"=>""));
$labels=array("loca_name"=>"location name","dist"=>"district");
$validator=new FormValidator($rules,$labels);
$form=new FormAssist($fields,$_POST);
$dao=new DataAccess();
?>



<?php
	$cats=$dao->createOptions("district_name","dist_id","district_tbl");
	echo $form->dropDownList("dist",array("class"=>"form-input","select"),$cats,"Select District");
?>