<?php
	error_reporting(0);
	include_once("../Brain/field_const.php");
	include_once("../Brain/functions.php");
	include_once("../Brain/ShoppingCart.php");
	include_once("../Brain/Product.php");
	include_once("../Brain/UserControl.php");
	
	if (!UserControl::checkState()) {
		echo "Error: You must login first!";
		return;
	}
		
	regGet('act', 'prodNo', 'qty');
	if (!isset($act) || !isset($prodNo)) {
		echo "Error: No action specified";
		return;
	}
	
	$cart = new SCart();
	$prod = getProduct($prodNo);
	//$cart->clear();
	
	if ($act == 'add') {	
		if (!isset($qty))
			$qty = 1;
		$cart->addProduct($prodNo, $prod[prodPrice], $qty);
		//if not success
		//...
	}
	else {
		$cart->removeItem($prodNo);
	}
	
	$cartProds = $cart->getProducts();
	//var_dump($cartProds);
	echo SCart::genCartMenuHtml($cartProds);

?>