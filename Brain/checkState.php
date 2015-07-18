<?php
	include_once "UserControl.php";


		if(UserControl::checkState())
			echo "Login Successfully";
		else
			echo "Failure to login";
		
		//UserControl::logout();
	
	
?>