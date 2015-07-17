<?php
	include_once "field_const";
	class SCart
	{
		private $_userID, $_product;
		public function __construct($userID)
		{
			$_userID = $userID;
		}
		
		public function addProduct($product, $actaulPrice, $qty)
		{
			$newArray[prodNo] = $productNo;
			$newArray[actualPrice] = $actualPrice;
			$newArray[qty] = $qty;			
			$_product[prodNo] = $newArray;
		}
		
		public function getProducts($product)
		{
			return $_product;
		}
		
		public function removeItem($productNo)
		{
			unset($_product[$productNo]);
		}
		
		public function qtyPlusPlus($productNo)
		{
			$_product[prodNo][qty]++;
		}
		public function qtySubSub($productNo)
		{
			$_product[prodNo][qty]--;
		}
		public function clearCart()
		{
			unset($_product);
		}
		
		public function regCart()
		{
			session_start();
			if(isset($_SESSION[userID."_"]))
		}
	}
?>