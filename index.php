<?php 
	include_once "functions.php";
	include_once "Product.php";
	include_once "Order.php";
	include_once "Category.php";
	include_once("field_const.php");
//	printThisDBResult(getOrdresByProductNo("OR001")); //RAYMOND:l 蟲蛀
	printThisDBResult(getAllOrders());
	addOrder(date("Y-m-D"), date("Y-m-D"), "0.1", "SS", "C0001", "DST01", array());
	
	
	printThisDBResult(getAllOrders());
?>