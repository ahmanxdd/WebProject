<?php 
	include_once "functions.php";
	include_once "Product.php";
	include_once "Order.php";
	include_once "Category.php";
	include_once "District.php";
	include_once "Schedule.php";
	include_once("field_const.php");
//	printThisDBResult(getOrdresByProductNo("OR001")); //RAYMOND:l 蟲蛀
	printThisDBResult(getAllJobsByDrvID("D0001"));

	printThisDBResult(getAllDistricts());
//	markJobDate("D0003", date("Y-m-d"), "DST01");
	addOrder(date("Y-m-d"), null , 0.25, "Noo","C0001", "DST02", array());
	matchSchedule("OR008",  date("Y-m-d"), "DST03");
	printThisDBResult(getAllOrders());
?>