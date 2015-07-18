<?php
	include_once("field_const.php");
	include_once("Order.php");
	include_once("Database.php");
	function markJobDate($drvID, $jobDate, $distNo)
	{
		//mark the date that avalible to delivery
		
		//if $jobDate is array; it should be
		// jobDate[0][jobDate];
		// jobDate[0][distNo];
		$query = "";
		if(isset($jobDate) && is_array($jobDate))
		{
			$jobObjs = $jobDate;
			foreach($jobObjs as $jobObj)
			{
				$jobDate = $jobObj[jobDate];
				$distNo = $jobObj[distNo];
				$query .= DB::genInsertStr("Schedule", DB::getLastIndex("Schedule"), $jobDate, $drvID, $distNo). ";";
			}
		}
		else 
		{
			$query = DB::genInsertStr("Schedule", DB::getLastIndex("Schedule"), $jobDate, $drvID, $distNo);
		}
		return DB::query($query);
		//echo $query;
	}	
		
	function deleteJob($jobNo)
	{
		$query = "DELETE FROM Schedule WHERE " . jobNo . " = '$jobNo'";
		return DB::query($query);
	}
	function editJob($jobNo, $jobDate, $distNo)
	{
		//RAYMOND: if all variable == null, will occur error
		$result = getOrdersByJobNo($jobNo);
		
		if($result)
			return false;
		//JSON Array?
		if(isset($jobNo) && is_array($jobNo))
		{
			$jobObj = $jobNo;
			$jobDate = $jobObj[jobDate];
			$distNo = $jobObj[distNo];
		}
	
		//Getting value
		if(isset($jobDate))
			$values[] = jobDate . " = '$jobDate'";
		if(isset($distNo))
			$values[] = distNo . " = '$distNo'";
			
		if(count($values) < 0) return false;	
		
		$query = "UPDATE Schedule SET ";
		
		foreach($values as $value)
			$query .= $value . ",";	
		$query = rtrim($query, ",") . " ";
		$query .= "WHERE " . jobNo . " = '$jobNo'";
		return DB::query($query);		
	}
	
	include_once "functions.php";
	
	function matchSchedule($ordNo, $jobDate, $distNo)
	{
		//1. Get All Driver and their jobs num in that day
			
		$query = "SELECT * FROM NoOfJobs "
				."JOIN "
				."(SELECT MIN(" . numOfJobs . ") AS MinNum FROM NoOfJobs "
				."WHERE " . jobDate . " = '$jobDate' "
				."AND " . distNo . " = '$distNo') AS SubQuery "
				."ON SubQuery.MinNum = " . numOfJobs . " "
				."WHERE " . jobDate . " = '$jobDate' "
				."AND " . distNo . " = '$distNo' ";
			
		$result = DB::query($query);
		
		if(!$result)
			return null;
		$randNum = rand(1,$result->num_rows) - 1;
		$result->data_seek ($randNum);
		$row = $result->fetch_assoc();	
		return updateJobNo($ordNo, $row[jobNo]);
	}
	
	function getAllJobsByDrvID($drvID)
	{
		$query = "SELECT * FROM Schedule WHERE " . drvID . "= '$drvID' " . DB::genOrderByStr(func_get_args(), func_num_args(), 1);
		return DB::query($query);
	}

	
	/*
		Raymond: 
			Remark:
			VIEW: numOfJobs
			SELECT Schedule.jobNo, Schedule.distNo, Schedule.jobDate, IFNULL(COUNT(CustOrder.ordNo), 0) AS numOfJobs 
			FROM CustOrder RIGHT JOIN Schedule ON Schedule.jobNo = CustOrder.jobNo
			GROUP BY Schedule.jobNo

	*/
?>