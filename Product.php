<?php
	//唔好hardcode任何column name! 我知會麻煩啲, 但唔該, 唔好hardcode
	//Table名可以hardcode
	//code 寫法參照User.php
	include_once("field_const.php");
	include_once("dbconn.php");	
	
	//Products
	function addProduct($prodName, $prodPrice, $prodPhoto, $stockQty, $catNo, $suppNo) {
		if (isset($prodName) && is_array($prodName)) {
			$prodObj = $prodName;
			$prodName = 
		}
	}
	
	function delProduct($prodNo, $suppNo = null) {
		//a product cannot be deleted if it is found in any customer order.
		$suppQuery = "";
		if(isset($suppNo))
			$suppQuery .= "AND Product." . suppNo . " = $suppNo";
			
		$query = "SELECT OrderLine." . ordNo . " "
				."FROM OrderLine, Product "
				."WHERE OrderLine." . prodNo . " = $prodNo "
				.$suppQuery;
		
		$result = DB::query($query);
		if($result.num_rows > 0)
			return false;
				
		//Delete product
		$query = "UPDATE Product SET " . isDeleted . " = '1' "
				."WHERE " . prodNo . " = $prodNo "
				.$suppQuery;

		//suppNo == null, 一定可以delete
		
		//if suppNo != null , ensure suppNo is Product.suppNo, 唔係唔比delete
	}
	
	function getAllProducts() {
		//desc, asc
		//getAllProducts(prodName, "asc", prodPrice, "desc");
		
	}
	
	function getProduct($prodNo) {
		
	}
	
	function getProducts($nameWith, $priceMin, $priceMax, $stockQty, $catNo, $suppNo, $isDeleted = false) {
		//desc, asc
		//AND logic
	}
	
	function getProductsByName($nameWith) {
		return getProducts($nameWith, null, null, null, null, null);
	}
	
	function getProductsByCategory($catNo) {
		return getProducts(null, null, null, null, $catNo, null);
	}
	
	function getProductsBySupplier($suppNo) {
		return getProducts(null, null, null, null, null, $suppNO);
	}
	
	function updateProduct($prodNo, $prodName, $prodPrice, $prodPhoto, $stockQty, $catNo, $suppNo) {
		//$xxx === null, stands for do not modify the column
		//$xxx === "null", stands for set the column to null
		
		if (is_array($prodNo)) {	//for JSON associated array
			$prodObj = $prodNo;
			//...
		}
		
	}
	
	function updateProductPhoto($prodNo, $prodPhoto) {
		//delete the old photo from the server (do not do this part yet) 
		updateProduct($prodNo, null, null, $prodPhoto, null, null, null);
	}
	
	function updateStockQty($prodNo, $add) {
		// $add == 1 is qty += 1
		// $add == -2 is qty -= 2
	}
	
	function getSalesSummary($suppNo) {
		//do not do this part yet.
	}
?>