<?php
	error_reporting(0);
	include_once("field_const.php");
	include_once("Product.php");	
	class SCart
	{
		private $_product;
		public function __construct()
		{
			session_start();
			if(isset($_SESSION["SCart"]))
				$this->_product = $_SESSION["SCart"];
		}
		
		public function addProduct($product, $actualPrice, $qty)
		{
			$newArray[prodNo] = $product;
			$newArray[actualPrice] = $actualPrice;
			$newArray[qty] = $qty;			
			$this->_product[$product] = $newArray;
		}
		
		public function getProducts()
		{
			if(!isset($this->_product))
				return false;
			return $this->_product;
		}
		
		public function isExist($productNo)
		{
			return isset($this->_product[$productNo]);
		}
		public function removeItem($productNo)
		{
			unset($this->_product[$productNo]);
		}
		
		public function qtyPlusPlus($productNo)
		{
			$this->_product[$productNo][qty]++;
		}
		public function qtySubSub($productNo)
		{
			$this->_product[$productNo][qty]--;
		}
		
		public function getTotalAmount($productNo = null)
		{
			$totalAmount = 0;
			if(!isset($productNo))
				foreach($this->_product as $product)
					$totalAmount += $product[actualPrice] * $product[qty];
			else
				$totalAmount = $this->_product[$productNo][actualPrice] * $this->_product[$productNo][qty];
			$totalAmount = round($totalAmount,2);
			return $totalAmount;
		}
		
		public function clear()
		{
			unset($this->_product);
		}
		
		public function checkOut($deliveryDate, $orderDiscount,$deliAddr, $custNo, $distNo)
		{
			include_once "Order.php";

			if(addOrder(date("Y-m-d"), $deliveryDate, $orderDiscount, $deliAddr, $custNo, $distNo, $this->_product))
			{
				$this->clear();
				return true;
		
			}
			return false;
		}
		
		
		public function __destruct() {
			if(!isset($this->_product))
				$_SESSION["SCart"] = null;
			else
       			$_SESSION["SCart"] = $this->_product;
   		}
		  
		public static function genCartMenuHtml($cartProds) {
			$retStr = "";
			foreach ($cartProds as $cartProd) {
				$prod = getProduct($cartProd[prodNo]);
				$retStr .= '
					<li>
						<label>' . $prod[prodName] . '</label>
						<span>' . $cartProd[actualPrice] . '</span>
					</li>';
			}
			return $retStr;
		}
	}
?>