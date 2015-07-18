<?php			
	include_once "Brain/UserControl.php";
	include_once "Brain/Schedule.php";
	include_once('Brain/District.php');
	include_once('Brain/field_const.php');
	UserControl::login("loginD0002", "mypswd");
	if(!UserControl::$type == "driver")
		return;
	$drvID = $_SESSION["typeID"];
	
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
		else if(isset($_POST[distNo]))
		{
			
			if(editJob($_POST[jobNo], null, $_POST[distNo]))
				echo "true";
			else
				echo "false";
			return;
		}
	}

?>		


<html>
	<head>
		<title>Drive Maintance</title>
		
		<script src="jquery_ui/external/jquery/jquery.js"></script>
		<script src="jquery_ui/jquery-ui.min.js"></script>
		<script src='js/function.js'></script>

	</head>
	
	<body>

<link href="js/function.js"/>
<table>
	<tr>
		<th>Job No</th>
		<th>Job Date</th>
		<th>District</th>
		<th>Edit</th>
	</tr>
<?php

	$jobs = getAllJobsByDrvID($drvID, jobDate, "DESC");
	$districts = getAllDistricts();
	$selectionBox = "<select class='changable' hidden name='cbdistrict'>";
	while($row = $districts->fetch_assoc())
	{
		$selectionBox .= "<option value='" . $row[distNo] . "'>" . $row[distName] . "</option>";
	}
	$selectionBox .= "</select>";
	while($row = $jobs->fetch_assoc())
	{
		echo "<tr>";
		$dist = getDistrict($row[distNo]);
		echo 
			 "<td name='jobNo'>" . $row[jobNo] . "</td>"  
			."<td><input name='date' style='border:none' type='date' class='changable' readonly value='" . $row[jobDate] . "'/></td>"
			."<td>"
			.$selectionBox	
			."<input name='district' style='border:none' type='text' class='changable' readonly value='" . $dist["distName"] . "'/>"
			."<input name='distNo' type='hidden' value='" . $row[distNo] . "' /></td>"
			."<td >" . "<a href='driver.php?jobNo=" . $row[jobNo] . "'>Edit</a></td>";		
		echo "</tr>";	

	
	}
	
?>	
	</table>
	
	<table>
		<td>Mark: </td>
		<td>
			<form action="driver.php" method="post">
				<input type="checkbox" name="weekDay[]" value="1"> Mon 
				<input type="checkbox" name="weekDay[]" value="2"> Tue 
				<input type="checkbox" name="weekDay[]" value="3"> Wed 
				<input type="checkbox" name="weekDay[]" value="4"> Thur 
				<input type="checkbox" name="weekDay[]" value="5"> Fri 
				<input type="checkbox" name="weekDay[]" value="6"> Sat 
				<input type="checkbox" name="weekDay[]" value="7"> Sun 
			</form>
		
	
	</body>
</html>