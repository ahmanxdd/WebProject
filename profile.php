<?php
	include_once "Brain/field_const.php";
	include("header1.php");
?>
<link href="css/profile.css" rel="stylesheet" type="text/css" />
<script src='js/profile.js'> </script>
<?php
	include("header2.php"); 
	if(!isset($_GET[userNo]))
		return;	
	$isOwner = false;
	include_once "Brain/UserControl.php";
	if(UserControl::checkState())
	{
		$userNo = UserControl::getUserNo();
		if($userNo == $_GET[userNo])
			$isOwner = !$isOwner;
	}
		
	$owner = getUser($_GET[userNo]);
	if(!isset($owner))
	{
		echo "Sorry, No such user!";
		return;
	}
	
	$ownerInfo = getInfo($_GET[userNo]);

	
	$type = getUserType($_GET[userNo]);	

	$typeID = $ownerInfo["ID"];
?>

<div id="profileHeader">
	<div id="p_container">
		<div id="p_title">Profile</div>
		<div id="p_info">
			<div id="p_name"><?php echo $ownerInfo["Name"] ?></div>
			<div id="p_contact"><?php if(isset($ownerInfo["Contact"])) echo $ownerInfo["Contact"]; ?></div>
		</div>
	</div>
</div>

<div id="main_container">
	
	
<div id="mainPanel" class="col-80 col-m-100"><?php 
 //mainPart!!!
if($isOwner)
{
	if($type == 'd')
	{
		echo 
		 '<link href="css/driver.css" rel="stylesheet" type="text/css" />'
		.'<script src="js/driver.js"> </script>';
		include_once "Brain/Schedule.php";
		include_once "Brain/District.php";
		
		$weekDay = "weekDay";
		$district = "district";
		$repeatTime = "repeatTime";
?>	

	
		
	
	

<?php
	$jobs = getAllJobsByDrvID($typeID, jobDate, "DESC");
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
	echo 
<<<'JOBTABLE_HEAD'
<div id='jobTableDiv' class="col-79 col-m-100 topLine">
	<table id='jobTable' class="tableSimpleList" width="100%">
	<caption>JobList</caption>
	<thead>
		<tr>
			<th>Job No</th>
			<th>Job Date</th>
			<th>District</th>
			<th></th></tr></thead><tbody>
JOBTABLE_HEAD;
	$jobTable_row_format = 
<<<JOBTABLE_ROW
<tr>
	<td><input name='jobNo' readonly type='text' style='border:none' value='%s'></input></td>
	<td><input name='date' style='border:none' type='date' class='changable' readonly value='%s'/></td>
	<td> $selectionBox	
		<input name='district' style='border:none' type='text' class='changable' readonly value='%s'/>
		<input name='distNo' type='hidden' value='%s' /></td>
	<td>
		<button class='removeJob'>Remove</button>
	</td>
</tr>
JOBTABLE_ROW;
	
	while(isset($jobs) && $row = $jobs->fetch_assoc())
	{
		$dist = getDistrict($row[distNo]);
		printf($jobTable_row_format,$row[jobNo],$row[jobDate],$dist["distName"],$row[distNo]);

	}
	echo "</tbody></table></div>";
	
?>	

		<div id="retPlaceHolder" class="col-20 col-m-100 topLine">
		
		</div>


<div id="btn_group">
<button id="weekopener" class="btn">Add Job Weekly</button>
<button id="dayopener"  class="btn">Add Job Daily</button>
</div>
	
	
	
	
	
	<div id="weeklydialog">
		<form action="BackProcess/driver.php" method="post" class="simpleForm ">
		<table width="100%" >
			<caption>Assign Job weekly</caption>
			<tr>
				<td colspan='2'>
					<?php
						//print Day week selector
						$weekdays = array("Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat");
						$format = "<input type='checkbox'' name='" . $weekDay . "[%s]' value='%d' />%s      ";
						for($i = 0; $i < count($weekdays); $i++)
							printf($format,$weekdays[$i],$i,$weekdays[$i]);
					?>						
				</td>
			</tr>
			<tr>
				<td>District</td>
				<td><?php echo $selectionBox_v; ?></td>
			</tr>
			<tr>
				<td>Repeat time</td>
				<td><input type="number" required name="<?php echo $repeatTime; ?>" min ='1' max='99' /></td>
			</tr>
		</table>	
		<input type="submit" value="Assign"/>
	</form>	
	</div>	
	
	
	<div id="dailydialog">
	<form action="BackProcess/driver.php" method="post">
		<table class="simpleForm">
				<caption>Assign Job Daily</caption>
			<tr>
				<td>Date</td>
				<td>
					<input type="date" required name="date" />
				</td>
			</tr>
			<tr>
				<td>District </td>
				<td><?php echo $selectionBox_v; ?></td>
			</tr>		

		</table>	
		<input type="submit" value='Assign' />
	</form>	
	</div>
		
		
<?php
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
?></div>
	
	
	


	<div id="mainInfo" class="col-20 col-m-100">
	<?php
		if(!$isOwner)
			return;
		echo "<table id='basicInfo'>";
		foreach($ownerInfo as $i => $v)
			echo "<tr><th>$i</th><td>$v</td></tr>";
		echo "</table>";
	?>
	</div>
</div>
<?php include("footer.php"); ?>