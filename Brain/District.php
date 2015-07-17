<?php
	include_once('field_const.php');
	include_once('Database.php');
	//District
	function getAllDistricts() {
		//desc, asc
		$query = "SELECT * FROM District " . DB::genOrderByStr(func_get_args(), func_num_args(), 1);
		return DB::query($query);
	}
	
	function addDistrict($distName) {
		if (isset($distName) && is_array($distName)) {
			$distObj = $distName;
			$distName = $distObj[distName];
			//for JSON object
		}
		
		$query = DB::genInsertStr("District", DB::getLastIndex("District"), $distName);
		return DB::query($query);
	}
	
	function delDistrict($distNo) {
		$query = "DELETE FROM District WHERE " . distNo . " = '$distNo'";
		$result = DB::query($distNo);
		echo DB::$db->error();
		
	}
	
	function updateDistrict($distNo, $distName)
	{
		$query = "UPDATE District ";
		$query .= DB::genSetStr(distName, $distName);
		$query .= ' WHERE ' . distNo . " = '$distNo'";
		return DB::query($query);
	}
	
?>