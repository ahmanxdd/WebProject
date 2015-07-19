<?php
	include_once("field_const.php");
	include_once("Database.php");
	include_once("User.php");

	class UserControl
	{
		public static $type;
		public static function checkState()
		{
			if(session_status() != PHP_SESSION_ACTIVE)
				session_start();
			if(!isset($_SESSION[userNo]))
				return false;
			$_userNo = $_SESSION[userNo];
			if($_userNo == 'null')
				return false;

			$row = getUser($_userNo);
			if(isset($row[adminNo]))
				return true;
			
			$query = "SELECT " . loginSession . " FROM " . " User "
					."WHERE " . userNo . " = '" . $_userNo . "'";
	
			$result = DB::query($query);
			if(!$result)
				return false;			
				
			$row = $result->fetch_array();
			if(isset($row[0]) && $row[0] == $_COOKIE["PHPSESSID"])
				return true;				 
			else 
				return false;
		}
		
		public static function login($loginName, $loginPswd)
		{

			session_unset();	
			$dbc =  DB::getDBConnection();
			$query = "SELECT * FROM User WHERE " . loginName . " = ? AND " . loginPswd . " = ? ";
			$stmt = $dbc->prepare($query);
			$stmt->bind_param("ss",$loginName, $loginPswd);
			$stmt->execute();
			$result = $stmt->get_result();		
			$row = $result->fetch_assoc();		
			if($result->num_rows <= 0)
				return false;
	
			$userNo = getUserNoByLoginName($loginName);

			if(!isset($userNo))
				return false;
			if(session_status() != PHP_SESSION_ACTIVE)
				session_start();		
			$_SESSION["type"]  = getUserType($userNo);
			UserControl::$type  = getUserType($userNo);		
			$_SESSION[userNo] = $userNo;
			$query = "UPDATE User SET " . loginSession . " = '" . session_id() . "' " 
					."WHERE " . userNo . " = '$userNo'";
			if(DB::query($query))
				return true;	

		}
		
		public static function getType()
		{
			if(session_status() != PHP_SESSION_ACTIVE)
				session_start();		
			return $_SESSION["type"];
		}
		public static function getUserNo()
		{
	
			if(session_status() != PHP_SESSION_ACTIVE)
				session_start();
			return $_SESSION[userNo];
		}
		public static function logout()
		{		
			$query = "UPDATE User SET " . loginSession . " = null "
					."WHERE " . loginSession . " = '" . session_id() . "'";
			session_regenerate_id(true);
			session_destroy();
			setCookie(userNo,"null");
			setCookie("PHPSESSID", null);
			UserControl::$type = null;
			return DB::query($query);
		}
	}
	
?>