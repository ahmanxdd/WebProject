<?php 
	include_once "functions.php";
	include_once "Product.php";
	include_once "Order.php";
	include_once "Category.php";
	include_once "District.php";
	include_once "Schedule.php";
	include_once "field_const.php";
	include_once "UserControl.php";
	include_once "ShoppingCart.php";
//	printThisDBResult(getOrdresByProductNo("OR001")); //RAYMOND:l 蟲蛀
//	printThisDBResult(getAllJobsByDrvID("D0001"));

//	printThisDBResult(getAllDistricts());
//	markJobDate("D0003", date("Y-m-d"), "DST01");
	//addOrder(date("Y-m-d"), null , 0.25, "Noo","C0001", "DST02", array());
	//matchSchedule("OR008",  date("Y-m-d"), "DST03");
//	printThisDBResult(getAllOrders());
//	UserControl::login("U0002");
	//echo "<a href='loginText.php'> HI </a>";
//	UserControl::logout();
	$cart = new SCart();
	$cart->addProduct("P00002", "100", "3");
	$cart->addProduct("P00005", "100", "4");
	//$cart->qtyPlusPlus("P00001");
	
	$products = $cart->getProducts();
	$array = getSalesSummaryByGender("S0002", null);
	foreach($array as $a)
		printThisDBResult($a);

?>