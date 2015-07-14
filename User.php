<?php
	include_once("field_const.php");
	include_once("dbconn.php");	
	
	//User
	function getAllUsers() {
		//desc, asc
		$orderByStr = DB::genOrderByStr(func_get_args(), func_num_args(), 0);
		
		$query = "SELECT * FROM User " 
			. $orderByStr;
		return DB::query($query);
	}
	
	function getUser($userNo) {
		$query = "SELECT * FROM User " 
			. "WHERE " . userNo . " = $userNo";	//no hardcode! , "WHERE userNo = $userNo" <-- 唔好咁打
		return DB::query($query);
	}
	
	function addUser($loginName, $loginPswd, $drvID, $custNo, $suppNo, $adminNo) {
		if (isset($loginName) && is_array($loginName)) { //for JSON associated array
			$userObj = $loginName;
			$loginName = $userObj[loginName];
			$loginPswd = $userObj[loginPswd];
			$drvId = $userObj[drvId];
			$custNo = $userObj[custNo];
			$suppNo = $userObj[suppNo];
			$adminNo = $userObj[adminNo];
		}
		
		$userNo = DB::getLastIndex("User");
		$query = DB::genInsertStr("User", $userNo, $loginName, $loginPswd, $drvID, $custNo, $suppNo, $adminNo);
		return DB::query($query);
	}

	function delUser($userNo) {
		$DRV_ID = drvID;
		$CUST_NO = custNo;
		$SUPP_NO = suppNo;
		$ADMIN_NO = adminNo;
		
		$query = 'SELECT $DRV_ID $CUST_NO $SUPP_NO $ADMIN_NO FROM User '
				. 'WHERE ' . userNo . " = $userNo";
		$usertype = DB::query($query, false);
		if ($row == null)
			return false;
		$query = 'DELETE FROM User '
			. 'WHERE ' . userNo . " = $userNo";	//no hardcode!, "WHERE userNo = $userNo" <-- 唔好咁打
		if (DB::query($query) === false)
			return false;
		
		$USERTYPE_TABLENAME = array(
			"adminNo" => "Admin",
			"suppNo" => "Supplier",
			"drvID" => "Driver",
			"custNo" => "Customer",
		);
		
		$usertype = $usertype->fetch_assoc();
		foreach ($row as $key => $val) {
			if (isset($val)) {	//if it is a admin, driver, supplier or customer, delete that record too
				$query = 'DELETE FROM ' . $USERTYPE_TABLENAME[$key] 
					. " WHERE $key = '$val'";
				if (DB::query($query) === false)
					return false;
			}
		}
	
		return true;
	}
	
	function regAdmin($userNo, $adminTel) {
		//check if the userNo is already a driver, customer or supplier, if yes abort, return false
		
		if (isset($adminTel) && is_array($adminTel)) { //for JSON
			$adminObj = $adminTel;
			$adminTel = $adminObj[adminTel];
		}
		
		//...
	}
	
	function updateAdmin($adminNo, $adminTel) {
		//$colname === null, stands for 'do not change the column'
		//$colname === "null", stands for 'set the colume to null'
		if (isset($adminTel) && is_array($adminTel)) { //for JSON
			$adminObj = $adminTel;
			$adminTel = $adminObj[adminTel];
		}
	}
	
	function regSupplier($userNo, $suppName, $suppTel, $suppAddr) {
		//check if the userNo is already a driver, customer or admin, if yes abort, return false
		if (isset($suppName) && is_array($suppName)) { //for JSON
			$suppObj = $suppName;
			//...
		}
	}
	
	function updateSupplier($suppNo, $suppName, $suppTel, $suppAddr) {
		//$colname === null, stands for 'do not change the column'
		//$colname === "null", stands for 'set the colume to null'
		if (isset($suppName) && is_array($suppName)) { //for JSON
			$suppObj = $suppName;
			//...
		}
	}
	
	function regDriver($userNo, $drvID, $drvName, $drvGender) {
		//check if the userNo is already a supplier, customer or admin, if yes abort, return false
		if (isset($drvID) && is_array($drvID)) { //for JSON
			$suppObj = $drvID;
			//...
		}
	}
	
	function updateDriver($drvID, $drvName, $drvGender) {
		//$colname === null, stands for 'do not change the column'
		//$colname === "null", stands for 'set the colume to null'
		if (isset($drvID) && is_array($drvID)) {	//for JSON
			$drvObj = $drvID;
			//...
		}
	}
?>