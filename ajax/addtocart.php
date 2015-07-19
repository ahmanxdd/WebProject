<?php
	include_once("field_const.php");
	include_once("../Brain/functions.php");
	
	regGet('act', 'prodNo');
	if (!isset($act) || !isset($prodNo)) {
		echo "failed";
		return;
	}
	
	if ($act == 'add') {
		
	}
	else {
		
	}
	
	echo "Added";
?>