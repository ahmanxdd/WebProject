<?php
	include_once("field_const.php");
	include_once("Database.php");	
	
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
			. "WHERE " . userNo . " = '$userNo'";	//no hardcode! , "WHERE userNo = $userNo" <-- 唔好咁打
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
				. 'WHERE ' . userNo . " = '$userNo'";
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
		$query = "SELECT COUNT(*) FROM User "
				."WHERE " . drvID . " IS NULL "
				."AND " . custNo . " IS NULL "
				."AND " . suppNo . " IS NULL "
				."AND " . userNo . " = '$userNo'";
				
		$result = DB::query($query);
		if($result->row_nums > 0)
			return false;
			
		if (isset($adminTel) && is_array($adminTel)) { //for JSON
			$adminObj = $adminTel;
			$adminTel = $adminObj[adminTel];
		}
		$adminNo = DB::getLastIndex("Admin");
		$insert_admin_query = DB::genInsertStr("Admin", $adminNo, $adminTel);
		$update_user_query = "UPDATE User SET " . adminNo . " = '$adminNo' WHERE " . userNo . " = '$userNo'";
		
		if(DB::query($insert_admin_query))
			return DB::query($update_user_query);
		return false;		
	}
	
	function updateAdmin($adminNo, $adminTel) {
		//$colname === null, stands for 'do not change the column'
		//$colname === "null", stands for 'set the colume to null'
		if (isset($adminTel) && is_array($adminTel)) { //for JSON
			$adminObj = $adminTel;
			$adminTel = $adminObj[adminTel];
		}
		if(!isset($adminTel))
			return false;
		$query = "UPDATE Admin SET " . adminTel . " = '$adminTel' "
				."WHERE " . adminTel . " = '$adminTel'";
		return DB::query($query);
	}
	
	function regSupplier($userNo, $suppName, $suppTel, $suppAddr) {
		//check if the userNo is already a driver, customer or admin, if yes abort, return false
		
		$query = "SELECT COUNT(*) FROM User "
				."WHERE " . drvID . " IS NULL "
				."AND " . custNo . " IS NULL "
				."AND " . adminNo . " IS NULL "
				."AND " . userNo . " = '$userNo'";
				
		$result = DB::query($query);
		if($result->row_nums > 0)
			return false;
			
		if (isset($suppName) && is_array($suppName)) { //for JSON
			$suppObj = $suppName;
			$suppName = $suppObj[suppName];
			$suppTel = $suppObj[suppTel];
			$suppAddr = $suppObj[suppAddr];
		}
		
		$suppNo = DB::getLastIndex("Supplier");
		$insert_suppNo_query = DB::genInsertStr("Supplier", $suppNo, $suppName, $suppTel, $suppAddr);
		$update_user_query = "UPDATE User SET " . suppNo . " = '$suppNo' WHERE " . userNo . " = '$userNo'";
		
		if(DB::query($insert_suppNo_query))
			return DB::query($update_user_query);
		return false;		
	}
	
	function updateSupplier($suppNo, $suppName, $suppTel, $suppAddr) {
		//$colname === null, stands for 'do not change the column'
		//$colname === "null", stands for 'set the colume to null'			
		if (isset($suppName) && is_array($suppName)) { //for JSON
			$suppObj = $suppName;
			$suppName = $suppObj[suppName];
			$suppTel = $suppObj[suppTel];
			$suppAddr = $suppObj[suppAddr];
		}
		$query = "UPDATE Supplier SET ";
		if(isset($suppName))
			$query .= suppName . "= '$suppName',";
		if(isset($suppTel))
			$query .= suppTel . "= '$suppTel',";
		if(isset($suppAddr))
			$query .= suppAddr . "= '$suppAddr'";
		$query = rtrim($query, ",");
		$query .= " WHERE " . suppNo . " = '$suppNo'";
		return DB::query($query);		
				
	}
	
	function regDriver($userNo, $drvID, $drvName, $drvGender) {
		//check if the userNo is already a supplier, customer or admin, if yes abort, return false
		
		
		
		$query = "SELECT COUNT(*) FROM User "
				."WHERE " . suppNo . " IS NULL "
				."AND " . custNo . " IS NULL "
				."AND " . adminNo . " IS NULL "
				."AND " . userNo . " = '$userNo'";
				
		$result = DB::query($query);
		if($result->row_nums > 0)
			return false;
			
		if (isset($drvID) && is_array($drvID)) { //for JSON
			$driObj = $drvID;
			$divID = $driObj[divID];
			$divName = $driObj[divName];
			$divGender = $driObj[divGender];
		}
		
		$divID = DB::getLastIndex("Driver");
		$insert_driver_query = DB::genInsertStr("Driver", $divID, $divName, $divGender);
		$update_user_query = "UPDATE User SET " . divID . " = '$divID' WHERE " . userNo . " = '$userNo'";
		
		if(DB::query($insert_driver_query))
			return DB::query($update_user_query);
		return false;	
	}
	
	function updateDriver($drvID, $drvName, $drvGender) {
		//$colname === null, stands for 'do not change the column'
		//$colname === "null", stands for 'set the colume to null'		
		if (isset($drvID) && is_array($drvID)) { //for JSON
			$driObj = $drvID;
			$divID = $driObj[divID];
			$divName = $driObj[divName];
			$divGender = $driObj[divGender];
		}
		
		
		$query = "UPDATE Driver SET ";
		if(isset($drvName))
			$query .= divName . " = '$divName',";
		if(issent($divGender))
			$query .= divGender . " = '$divGender',";
		$query = rtrim($query, ",");
		$query .= " WHERE " . $divID . " = '$divID'";
		return DB::query($query);
	}
	

	function getUserNoByLoginName($loginName)
	{
		$query = "SELECT * FROM User WHERE " . loginName . " = '$loginName'";
		$result = DB::query($query);
		if(!$result)
			return null;
		$row = $result->fetch_array();
		return $row[0];
	}
	
	function getCustomer($custNo) {
		$query = 'SELECT * FROM Customer WHERE ' . custNo . " = '$custNo'";
		$result = DB::query($query, false);
		if (!($cust = $result->fetch_assoc()))
			return null;
		return $cust;
	}
	
	function getAllCustomer() {
		//desc asc
		$query = 'SELECT * FROM Customer ' 
			. DB::genOrderByStr(func_get_args(), func_num_args, 0);
		return DB::query($query);
	}
	
	function getDriver($drvNo) {
		$query = 'SELECT * FROM Driver WHERE ' . drvNo . " = '$drvNo'";
		$result = DB::query($query);
		if (!($drv = $result->fetch_assoc()))
			return null;
		return $drv;
	}
	
	function getAllDrivers() {
		//desc asc
		$query = 'SELECT * FROM Driver ';
		$query .= DB::genOrderByStr(func_get_args, func_num_args(), 0);
		return DB::query($query);
	}
	
?>