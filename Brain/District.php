<?php	
	//District
	function getAllDistricts() {
		//desc, asc
		$query = "SELECT * FROM District " . DB::genOrderByStr(func_get_args(), func_num_args(), 1);
		return DB::query($query);
	}
	
	function addDistrict($distName) {
		if (isset($distName)) {
			$distObj = $distName;
			$distName = $distObj[distName];
			//for JSON object
		}
		$query = DB::getInsertStr($District, DB::getLastIndex("District"), $distName);
		return DB::query($query);
	}
	
	function delDistrict($distNo) {
		$query = "DELETE FROM District WHERE " . distNo . " = $distNo";
		return DB::query($distNo);
	}
?>