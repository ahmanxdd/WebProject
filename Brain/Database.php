<?php
	const DBHOST = "127.0.0.1";
	const DBNAME = "sdp_test";
	const USERNAME = "root";
	const PASSWORD = "haha123";
	DB::openDatabase();
	class DB {
		public static $debugMode = false;
		//public static $DBHOST = "127.0.0.1";
		//public static $DBNAME = "sdp_test";
		// public static $USERNAME = "root";
		// public static $PASSWORD = "haha123";
		public static $DBHOST = "ifelse.ninja";
		public static $DBNAME = "projectDB";
		public static $USERNAME = "raymond";
		public static $PASSWORD = "imraymond";
		public static $db;
		
		public static function getDBConnection()
		{
			return DB::$db;
		}
		public static function openDatabase() {
			DB::$db = new mysqli(DB::$DBHOST, DB::$USERNAME, DB::$PASSWORD, DB::$DBNAME);
		}
		
		public static function genOrderByStr($args, $argsNum, $first) {
			if ($argsNum <= $first)
				return "";
			
			$orderByStr = "ORDER BY ";
			for ($i = $first; $i < $argsNum - 2; $i+=2)
				$orderByStr .= $args[$i] . ' ' . $args[$i+1] . ',';
			$orderByStr .= $args[$argsNum-2] . ' ' . $args[$argsNum-1];
			return $orderByStr;
		}
	
		public static function genInsertStr($tableName) {
			$args = func_get_args();
			$argsNum = func_num_args();
			
			$insertStr = "INSERT INTO $tableName VALUES(";
			for ($i = 1; $i < $argsNum-1; $i++) {
				if (is_null($args[$i]))
					$insertStr .= 'null,';
				else
					$insertStr .= "'$args[$i]'" . ',';
			}
			
			if (is_null($args[$argsNum-1]))
					$insertStr .= 'null';
				else
					$insertStr .= "'$args[$i]'";
			$insertStr .= ")";
			
			return $insertStr;
		}
		
		public static function genSetStr() {
			$retStr = " SET ";
			$args = func_get_args();
			if (isset($args[1])) {
				$retStr .= $args[0] . ' = ' . "'" . $args[1] . "'";
			}
			
			for ($i = 2; $i < func_num_args(); $i+=2) {
				if (isset($args[$i+1])) {
					$retStr .= ',' . $args[$i] . ' = ' . "'" . $args[$i+1] . "'";
				}
			}
			
			return $retStr;
		}
	
		//Ar Lee
		private static $PRIMARY_KEYS = array(
		   	"User" => array('pk' => userNo, 'prefix' => 'U'),	
  			"Admin" => array('pk' => adminNo, 'prefix' => 'A'),
   			"Supplier" => array('pk' => suppNo, 'prefix' => 'S'),
   			"Customer" => array('pk' => custNo, 'prefix' => 'C'),
   			"Driver" => array('pk' => drvID, 'prefix' => 'DR'),
   			"District" => array('pk' => distNo, 'prefix' => 'DST'),
   			"Category" => array('pk' => catNo, 'prefix' => 'CAT'),
   			"Product" => array('pk' => prodNo, 'prefix' => 'PT'),
   			"Schedule" => array('pk' => jobNo, 'prefix' => 'J'),
   			"CustOrder" => array('pk' => ordNo, 'prefix' => 'OR')
   		);
			
		public static function query($query, $retJSON = false) {
			$result = DB::$db->query($query);
			//for INSERT, UPDATE, DELETE
			if ($result === true)
				return true;
			if ($result === false) {
				if (DB::$debugMode)
					die("Database error: " . $db->error);
				return false;
			}
			//for SELECT
			if ($result->num_rows > 0) {
				if ($retJSON) {
					$l = 0;
					$jsonArr = array();
					while($row = $result->fetch_assoc())
						$jsonArr[$l++] = $row;
					return $jsonArr;
				}
				return $result;
				
			} 
			else 
				return  null;
		}
		
		public static function getLastIndex($tableName) {
			$query = "SELECT MAX(" . DB::$PRIMARY_KEYS[$tableName]["pk"] . ") FROM $tableName ";
			$result = DB::query($query);
			if(!($result))
				return;
			$row = $result->fetch_array();
			$maxNum = $row[0];
			$maxNum = preg_replace("/[^0-9]/", "", $maxNum);
			$maxNum++;				
			$prefix = DB::$PRIMARY_KEYS[$tableName]['prefix'];
			$num_fix = 5 - strlen($prefix);
			$num_fix = $num_fix - strlen($maxNum);
			$num_v2 = "";
			for($i = 0; $i < $num_fix; $i++)
				$num_v2 .= "0";
			$num_v2 .= $maxNum;
			return $prefix . $num_v2;
		}

	}
	

	
	
?>