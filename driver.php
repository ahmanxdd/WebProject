<html>
	<head><title>Drive Maintance</title></head>
	
	<body>

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
	if(isset($_POST[weekDay]))
	{
		$
	}

?>		
<table>
	<tr>
		<th>Job No</th>
		<th>Job Date</th>
		<th>District</th>
		<th>Edit</th>
	</tr>
<?php

	$jobs = getAllJobsByDrvID($drvID, jobDate, "DESC");
	while($row = $jobs->fetch_assoc())
	{
		echo "<tr>";
		$dist = getDistrict($row[distNo]);
		echo 
			 "<td>" . $row[jobNo] . "</td>"  
			."<td>" . $row[jobDate] . "</td>"
			."<td>" . $dist["distName"] . "</td>"
			."<td>" . "<a href='driver.php?jobNo=" . $row[jobNo] . "'>Edit</a></td>";		
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