<?php
	include_once("field_const.php");
	include_once("Database.php");
	include_once("User.php");
	class UserControl
	{
		public static function checkState()
		{

			session_start();
			if(!isset($_COOKIE[userNo]))
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
			if(isset($row[0]) && $row[0] == session_id())
			{
				session_destroy();
				return true;				 
			}
			else 
			
			session_destroy();
			return false;
		}
		
		public static function login($loginName, $loginPswd)
		{

			$dbc =  DB::getDBConnection();
			$query = "SELECT * FROM User WHERE " . loginName . " = ? AND " . loginPswd . " = ? ";
			$stmt = $dbc->prepare($query);
			$stmt->bind_param("ss",$loginName, $loginPswd);
			$stmt->execute();
			$result = $stmt->get_result();		

	
			if($result->num_rows <= 0)
				return false;
				
			$userNo = getUserNoByLoginName($loginName);
			if(!isset($userNo))
				return false;

			setCookie(userNo, $userNo, time() + 7200);	
				
			session_start();	
			$query = "UPDATE User SET " . loginSession . " = '" . session_id() . "' " 
					."WHERE " . userNo . " = '$userNo'";
			if(DB::query($query))
			{
				session_unset();		
				session_destroy();
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

			return DB::query($query);
		}
	}
	
?>