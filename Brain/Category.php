<?php
	//code 寫法參照User.php
	//唔好hardcode任何column name! 我知會麻煩啲, 但唔該, 唔好hardcode
	//Table名可以hardcode
	
	include_once("field_const.php");
	include_once("Database.php");
		
	
	//Categories
	function getCategory($catNo) {
		$query = 'SELECT * FROM Cateory WHERE ' . catNo . " = $catNo";
		return DB::query($query);
	}
	
	function getSubCategories($catNo, $includeSelf, $catNameOrder = "ASC") {
		//use recursive
		$l = 0;
		$retArr = array();
		if ($includeSelf == true) {
			$query = 'SELECT * FROM Category '
			. 'WHERE ' . catNo . " = '$catNo'";
			$retArr[$l++] = DB::query($query, true);
		}
		
		$query = 'SELECT * FROM Category '
			. 'WHERE ' . catParent . " = '$catNo' "
			. 'ORDER BY ' . catName . ' '. $catNameOrder;
		$result = DB::query($query, false);
		if ($result === null)
			return $retArr;
		while($row = $result->fetch_assoc()) {
			$subcatArr = getSubCategories($row[catNo], true, catNameOrder);
			foreach ($subcatArr as $val)
				$retArr[$l++] = $val;
		}
		return $retArr;
	}
	
	function getSubCategoriesNested($catNo, $includeSelf, $catNameOrder) {
		$l = 0;
		$retArr = array();
		if ($includeSelf == true) {
			$query = 'SELECT * FROM Category '
			. 'WHERE ' . catNo . " = '$catNo'";
			$retArr[$l++] = DB::query($query, true);
		}
		
		$query = 'SELECT * FROM Category '
		    . 'WHERE ' . catParent . " = '$catNo' "
			. 'ORDER BY ' . catName . ' '. $catNameOrder;
		$result = DB::query($query, false);
		if ($result === null)
			return $retArr;
		while($row = $result->fetch_assoc())
			$retArr[$l++] = getSubCategories($row[catNo], true, $catNameOrder);
		return $retArr;
			
	}
	
	function getAllCategories() {
		//desc, asc
		$query = 'SELECT * FROM Category '
			. DB::genOrderByStr(func_get_args(), func_num_args(), 0);
		return DB::query($query);
	}
	
	function addCategory($catName, $catParent) {
		if (isset($catName) && is_array($catName)) {
			//for JSON Object
			$catObj = $catName;
			$catName = $catObj->catName;
			$catParent = $catObj->catParent;
		}
		$catNo = DB::getLastIndex("Category");
		
		$query = DB::genInsertStr("Category", $catNo, $catName, $catParent);
		return DB::query($query);
	}
	
	function delCategory($catNo) {
		$query = 'SELECT * FROM Category '
				. 'WHERE ' . catParent . " = '$catNo'";
		$result = DB::query($query, false);
		if ($result == null) {
			$query = 'DELETE FROM Category WHERE ' . catNo . " = '$catNo'";
			return DB::query($query);
		}
		
		//del all subcat first
		while ($row = $result->fetch_assoc()) {
			if (delCategory($row[catNo]) == false)
				return false;
		}
		
	}
		
?>