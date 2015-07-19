<?php		
	/*
		This part of the code for
		1. ajax
		2. check login state
	*/
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
	/*
		This part of the code for
		1. update schedule
	*/
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
<table id="jobTable">
	<thead>
	<tr>
		<th>Job No</th>
		<th>Job Date</th>
		<th>District</th>
		<th></th>
	</tr>
	</thead>
<?php
	/*
		This part of the code for
		1. Generate Table
	*/
	$jobs = getAllJobsByDrvID($drvID, jobDate, "DESC");
	$districts = getAllDistricts();
	$selectionBox = "<select class='changable' hidden name='cbdistrict'>";
	$selectionBox_v = "<select name='$district'>";
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
	
	<form action="driver.php" method="post">
		<table class="simpleForm" width="450px">
			<caption>Assign Job weekly</caption>
			<tr>
				<td colspan='2' style=>
					<?php
						//print Day week selector
						$weekdays = array("Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun");
						$format = "<input type='checkbox' id='check%d' name='" . $weekDay . "[]' value='%d' />%s      ";
						for($i = 0; $i < count($weekdays); $i++)
							printf($format,$i+1,$i+1,$weekdays[$i]);
					?>						
				</td>
			</tr>
			<tr>
				<td>District</td>
				<td><?php echo $selectionBox_v; ?></td>
			</tr>
			<tr>
				<td>Repeat time</td>
				<td><input type="number" name="<?php echo $repeatTime; ?>" min ='1' max='99' /></td>
			</tr>
		</table>	
		<input type="submit" value="Assign"/>
	</form>	
	
	<form action="driver.php" method="post">
		<table class="simpleForm">
				<caption>Assign Job Daily</caption>
			<tr>
				<td>Date</td>
				<td>
					<input type="date" name="date" />
				</td>
			</tr>
			<tr>
				<td>District </td>
				<td><?php echo $selectionBox_v; ?></td>
			</tr>		

		</table>	
		<input type="submit" value='Assign' />
	</form>	
	
	
	</body>
</html>