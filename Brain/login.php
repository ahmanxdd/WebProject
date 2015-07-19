<?php
	include_once "UserControl.php";
	if(isset($_POST[loginName], $_POST[loginPswd])	)
	{
		echo $_POST[loginName];
		echo $_POST[loginPswd];
		if(UserControl::login($_POST[loginName], $_POST[loginPswd]))
			echo 	 header("Location: ../profile.php?userNo=".UserControl::getUserNo());
		else
			echo "Failure to login";
		echo "<a href='checkState.php' > HI </a>";
	
	}
?>