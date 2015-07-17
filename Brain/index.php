<?php 
	include_once "functions.php";
	include_once "Product.php";
	include_once "Order.php";
	include_once "Category.php";
	include_once("field_const.php");
//	printThisDBResult(getOrdresByProductNo("OR001")); //RAYMOND:l 蟲蛀
	printThisDBResult(getAllProducts());
	
	
	
	printThisDBResult(getAllOrders());
?>