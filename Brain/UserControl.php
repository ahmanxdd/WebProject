<?php
	include_once("field_const.php");
	include_once("Database.php");
	include_once("User.php");
	class UserControl
	{
		public static $type;
		public static function checkState()
		{
			if(!isset($_COOKIE[userNo], $_COOKIE["session_id"]))
			{
				session_destroy();
				return false;				
			}
			

			$_userNo = $_COOKIE[userNo];
			$result = getUser($_userNo);
			$row = $result->fetch_assoc();
			
			if(isset($row[adminNo]))
			{
				session_destroy();
				return true;
			}
			$query = "SELECT " . loginSession . " FROM " . " User "
					."WHERE " . userNo . " = '" . $_userNo . "'";
	
			$result = DB::query($query);
			if(!$result)
			{	
				session_destroy();
				return false;			
			}
			$row = $result->fetch_array();
			if(isset($row[0]) && $row[0] == $_COOKIE["PHPSESSID"])
			{
				session_destroy();
				return true;				 
			}
			else 
			
			return false;
		}
		
		public static function login($loginName, $loginPswd)
		{

			session_start();	
			session_unset();	
			$dbc =  DB::getDBConnection();
			$query = "SELECT * FROM User WHERE " . loginName . " = ? AND " . loginPswd . " = ? ";
			$stmt = $dbc->prepare($query);
			$stmt->bind_param("ss",$loginName, $loginPswd);
			$stmt->execute();
			$result = $stmt->get_result();		
			$row = $result->fetch_assoc();
			if(isset($row[drvID]))
			{
				$_SESSION["typeID"] = $row[drvID];
				UserControl::$type = "driver";
			}
			else if(isset($row[adminNo]))
			{
				$_SESSION["typeID"] = $row[adminNo];
				UserControl::$type = "admin";
			}
			else if(isset($row[custNo]))
			{
				$_SESSION["typeID"] = $row[custNo];
				UserControl::$type = "customer";
			}
			else if(isset($row[suppNo]))
			{
				$_SESSION["typeID"] = $row[suppNo];
				UserControl::$type = "supplier";
			}
			else
			{
				$_SESSION["typeID"] = null;
				UserControl::$type = null;
			}
			if($result->num_rows <= 0)
				return false;
				
			$userNo = getUserNoByLoginName($loginName);
			if(!isset($userNo))
				return false;

			setCookie(userNo, $userNo, time() + 
				7200);	

			$query = "UPDATE User SET " . loginSession . " = '" . session_id() . "' " 
					."WHERE " . userNo . " = '$userNo'";
			if(DB::query($query))
			{	
				return true;	
			}	
	
		}
		
		public static function logout()
		{
			session_start();			
			$query = "UPDATE User SET " . loginSession . " = null "
					."WHERE " . loginSession . " = '" . session_id() . "'";
			session_regenerate_id(true);
			session_destroy();
			setCookie(userNo,"null");
			setCookie("session_id", "null");
			UserControl::$type = null;
			return DB::query($query);
		}
	}
	
?>