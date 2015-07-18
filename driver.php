<?php		
	//for extenral call	
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
		else if(isset($_POST['remove']))
		{
			if(deleteJob($_POST[jobNo]))
				echo "true";
			else
				echo "false";
			return;
		}	
	}
	

?>		
<?php
	$weekDay = "weekDay";
	$district = "district";
	$repeatTime = "repeatTime";
	if(isset($_POST[$weekDay], $_POST[$district], $_POST[$repeatTime]))
	{
		print_r($_POST[$weekDay]);
		echo $_POST[$district];
		echo $_POST[$repeatTime];
		
	}
?>

<html>
	<head>
		<title>Drive Maintance</title>
		<link rel="stylesheet" type='text/css' href='css/driver.css'/>		
		<link rel="stylesheet" href="jquery_ui/jquery-ui.min.css">
		<script src="jquery_ui/external/jquery/jquery.js"></script>
		<script src="jquery_ui/jquery-ui.min.js"></script>
		<script src='js/driver.js'></script>

	</head>
	
	<body>

<link href="js/function.js"/>
<table>
	<tr>
		<th>Job No</th>
		<th>Job Date</th>
		<th>District</th>
		<th></th>
	</tr>
<?php

	$jobs = getAllJobsByDrvID($drvID, jobDate, "DESC");
	$districts = getAllDistricts();
	$selectionBox = "<select class='changable' hidden name='cbdistrict'>";
	$selectionBox_v = "<select name='$district' class='jqStyle_selectDistrict'>";
	while($row = $districts->fetch_assoc())
	{
		$selectionBox .= "<option value='" . $row[distNo] . "'>" . $row[distName] . "</option>";
		$selectionBox_v.= "<option value='" . $row[distNo] . "'>" . $row[distName] . "</option>";
	}
	$selectionBox .= "</select>";
	$selectionBox_v.= "</select>";
	while($row = $jobs->fetch_assoc())
	{
		echo "<tr>";
		$dist = getDistrict($row[distNo]);
		echo 
			 "<td><input name='jobNo' readonly type='text' style='border:none' value='" . $row[jobNo] . "'></input></td>"  
			."<td><input name='date' style='border:none' type='date' class='changable' readonly value='" . $row[jobDate] . "'/></td>"
			."<td>"
				.$selectionBox	
				."<input name='district' style='border:none' type='text' class='changable' readonly value='" . $dist["distName"] . "'/>"
				."<input name='distNo' type='hidden' value='" . $row[distNo] . "' /></td>"
			."<td>" . "<button class='removeJob'>Remove</button></td>";		
		echo "</tr>";	

	
	}
	
?>	
	</table>
	
	<form action="driver.php#" method="post">
		<table>
			<tr>
				<td>Mark: </td>
				<td>
					<div id="format">
					<?php
						//print Day week selector
						$weekdays = array("Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun");
						$format = "<input type='checkbox' id='check%d' name='" . $weekDay . "[]' value='%d' /><label for='check%d'>%s</label>";
						for($i = 0; $i < count($weekdays); $i++)
							printf($format,$i+1,$i+1,$i+1,$weekdays[$i]);
					?>						
					</div>
				</td>
			</tr>
			<tr>
				<td>District</td>
				<td><?php echo $selectionBox_v; ?></td>
			</tr>
			<tr>
				<td>Repeat time</td>
				<td><input name="<?php echo $repeatTime; ?>" class="jqStyle_spinner" min ='1' max='99' readonly/></td>
			</tr>
			<tr>
				<td><input type="submit" value="Assign"/></td>
			</tr>
		</table>	
	</form>	
	
		<form action="driver.php" method="post">
		<table>
			<tr>
				<td>Date: </td>
				<td>
					<input type="text" id="datepicker" readonly />
				</td>
			</tr>
			<tr>
				<td>District</td>
				<td><?php echo $selectionBox_v; ?></td>
			</tr>		
		</table>	
		<input type="submit" value='Assign' />
	</form>	
	</body>
</html>