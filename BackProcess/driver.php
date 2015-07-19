<?php		
	/*
		This part of the code for
		1. ajax
		2. check login state
	*/
	
	include_once "../Brain/UserControl.php";
	include_once "../Brain/Schedule.php";
	include_once('../Brain/District.php');
	include_once('../Brain/field_const.php');

	if(UserControl::getType() != "d")
		return;
	$currentDay = date("Y-m-d");
	if(isset($_POST[jobNo]))
	{
		if(isset($_POST[jobDate]))
		{
			if(editJob($_POST[jobNo], $_POST[jobDate], null))
				echo "true";
			else
				echo "false";
			return;
		}
		else if(isset($_POST["getDetail"]))
		{
			$retTable = '<table name="OrderTable" class="tableSimpleList" width="100%">
						<caption>' . $_POST[jobNo] .' Details </caption><thead><tr><th>OrderNo</th><th>Address</th></tr></thead>';
			$result = getOrdersByJobNo($_POST[jobNo]);
			if(!isset($result))
			{
				echo "No Order assigned";
				return;
			}
			while($row = $result->fetch_array())
			{
				$retTable .= "<tr><td>". $row[ordNo] ."</td><td>" . $row[deliAddr] . "</td></tr>";
			}
	
		
			$retTable.='</table>';
			
			echo $retTable;
			return;
		}
		else if(isset($_POST[distNo]))
		{
			
			if(editJob($_POST[jobNo], null, $_POST[distNo]))
				echo "true";
			else
				echo "false";
			return;
		}
		else if(isset($_POST['remove']))
		{
			if(deleteJob($_POST[jobNo]))
				echo "true";
			else
				echo "false";
			return;
		}	
	}
	
	if(isset($_POST["district"], $_POST["repeatTime"]))
	{
		if(isset($_POST["weekDay"]))
		{
			$typeID = UserControl::getUserNo();
			$typeID = getInfo($typeID)["ID"];
			$thisWeek = date("w");
			$currentDate = date("Y-m-d");
			
			print_r($_POST["weekDay"]);
		}
		else
		{
			echo "<script> alert('Please select the week day!'); </script>";
		}
	}
	else if (isset($_POST["date"], $_POST["district"]))
	{
		$typeID = UserControl::getUserNo();
		$typeID = getInfo($typeID)["ID"];
		markJobDate($typeID, $_POST["date"], $_POST["district"]);
	}
	echo "<script> window.location.replace(\"../profile.php?userNo=" . UserControl::getUserNo() . "\"); </script>";


?>		
