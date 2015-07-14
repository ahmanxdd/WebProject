<?php
	//code 寫法參照User.php
	//唔好hardcode任何column name! 我知會麻煩啲, 但唔該, 唔好hardcode
	//Table名可以hardcode
	
	include_once("field_const.php");
	include_once("dbconn.php");
		
	
	//Categories
	function getCategory($catNo) {
		
	}
	
	function getSubCategories($catNo, $includeSelf) {
		//use recursive
		//desc, asc
	}
	
	function getAllCategories() {
		//desc, asc
	}
	
	function addCategory($catName, $catParent) {
		if (isset($catName) && is_array($catName)) {
			//for JSON Object
		}
	}
	
	function delCategory($catNo) {
		//del all subcat first
	}
		
?>