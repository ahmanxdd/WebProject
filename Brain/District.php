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
	
	function updateDistrict($distNo, $distName) {
		
	}
	
	function delDistrict($distNo) {
		$query = "DELETE FROM District WHERE " . distNo . " = $distNo";
		return DB::query($distNo);
		
	}
	
	function updateDistrict($distNo, $disName)
	{
		$query = "UPDATE District SET "
				. distName . " = $disName "
				. "WHERE " . distNo . " = $distNo";
		return DB::queeery($query);
	}
?>