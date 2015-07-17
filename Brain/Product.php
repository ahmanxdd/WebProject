<?php
	//唔好hardcode任何column name! 我知會麻煩啲, 但唔該, 唔好hardcode
	//Table名可以hardcode
	//code 寫法參照User.php
	include_once("field_const.php");
	include_once("Database.php");	
	include_once("Category.php");
	
	//Products
	function addProduct($prodName, $prodPrice, $prodPhoto, $stockQty, $catNo, $suppNo) {
		if (is_array($prodNo)) {	//for JSON associated array
			$prodObj = $prodNo;
			$prodName = $prodObj[prodName];
			$prodPrice = $prodObj[prodPrice];
			$prodPhoto = $prodObj[prodPhoto];
			$stockQty = $prodObj[stockQty];
			$catNo = $prodObj[catNo];
			$suppNo = $prodObj[suppNo];
		}
		
		
		$query = DB::genInsertStr("Product", DB::getLastIndex("Product"),$prodName, $prodPrice, $prodPhoto, $stockQty, $catNo, $suppNo);
		return DB::query($query);
	}
	
	function delProduct($prodNo, $suppNo = null) {
		//a product cannot be deleted if it is found in any customer order.
		$suppQuery = "";
		if(isset($suppNo))
			$suppQuery .= "AND Product." . suppNo . " = '$suppNo'";
			
		$query = "SELECT OrderLine." . ordNo . " "
				."FROM OrderLine, Product "
				."WHERE OrderLine." . prodNo . " = '$prodNo' "
				.$suppQuery;
		
		$result = DB::query($query);
		if($result.num_rows > 0)
			return false;
				
		//Delete product
		$query = "UPDATE Product SET " . isDeleted . " = '1' "
				."WHERE " . prodNo . " = '$prodNo' "
				.$suppQuery;

		//suppNo == null, 一定可以delete
		return DB::query($query);
		//if suppNo != null , ensure suppNo is Product.suppNo, 唔係唔比delete
	}
	
	function getAllProducts() {
		//desc, asc
		$query = "SELECT * FROM Product " 
				.DB::genOrderByStr(func_get_args(), func_num_args(), 1);
		//getAllProducts(prodName, "asc", prodPrice, "desc");
		return DB::query($query);		
	}
	
	function getProduct($prodNo) {
		$query = "SELECT * FROM Product WHERE " . prodNo . " = '$prodNo'";
		return DB::query($query);
	}
	
	//8 arguments for getProducts
	function getProducts($nameWith, $priceMin, $priceMax, $stockQtyMin, $stockQtyMax, $catNo, $suppNo, $isDeleted = false) {
		//desc, asc
		$query = "SELECT * FROM Product WHERE ";
		$condition = array();
		if(isset($nameWith))
			$condition[] = prodName . " LIKE '%$nameWith%'";
		if(isset($priceMin))
  			$condition[] = prodPrice . " >= '$priceMin'";
 		 if(isset($priceMax))
   			$condition[] = prodPrice . " <= '$priceMax'";
		if(isset($stockQtyMax))
			$condition[] = stockQty . " <= '$stockQtyMax'";
		if(isset($stockQtyMin))
			$condition[] = stockQty . " >= '$stockQtyMin'";			
		if(isset($suppNo))
			$condition[] = suppNo . "  = '$suppNo'";	
		if(isset($isDeleted))
			if($isDeleted)
				$condition[] = isDeleted . " = '1'"; 
			else
				$condition[] = isDeleted . " = '0'";
		if(isset($catNo))
		{
			$categoryCondition = "catNo IN(";
			$subCategoryArray = getSubCategories($catNo, true);
			foreach($subCategoryArray as $category)
				$categoryCondition .= "'" . $category[catNo] . "',";
			$categoryCondition = rtrim($categoryCondition, ",");
			$condition[] = $categoryCondition;			
		}
		
		if(count($condition) > 0)
		{
			$query .= $condition[0];
			for($i = 1; $i < count($condition); $i++)
				$query .= " AND " . $condition[$i];
		}
		$query .= " " . DB::genOrderByStr(func_get_args(), func_num_args(), 8);
		//AND logic
		return DB::query($query);
	}
	
	function getProductsByName($nameWith) {
		return getProducts($nameWith, null, null, null, null, null, null);
	}
	
	function getProductsByCategory($catNo) {
		return getProducts(null, null, null, null,null , $catNo, null);
	}
	
	function getProductsBySupplier($suppNo) {
		return getProducts(null, null, null, null, null, $suppNO, null);
	}
	
	function updateProduct($prodNo, $prodName, $prodPrice, $prodPhoto, $stockQty, $catNo, $suppNo) {
		//$xxx === null, stands for do not modify the column
		//$xxx === "null", stands for set the column to null
		
		//RAYMOND: if all variable == null, will occur error
		$query = "UPDATE Product SET ";
			
		if (is_array($prodNo)) {	//for JSON associated array
			$prodObj = $prodNo;
			$prodNo = $prodObj[prodNo];
			$prodName = $prodObj[prodName];
			$prodPrice = $prodObj[prodPrice];
			$prodPhoto = $prodObj[prodPhoto];
			$stockQty = $prodObj[stockQty];
			$catNo = $prodObj[catNo];
			$suppNo = $prodObj[suppNo];
		}
		
		if(isset($prodName))
			$values[] = rodName . " = '$prodName'";
		if(isset($prodPrice))
			$values[] = prodPrice . " = '$prodPrice'";
		if(isset($prodPhoto))
			$values[] = prodPhoto . " = '$prodPhoto'";
		if(isset($stockQty))
			$values[] =  stockQty . " = '$stockQty'";			
		if(isset($catNo))
			$values[] = catNo . "  = '$catNo'";	
		if(isset($suppNo))
			$values[] = suppNo . " = '$suppNo'";
		if(!isset($prodNo))
			return false;
		foreach($values as $value)
			$query .= " " . $value . ",";	
		$query = rtrim($query, ",") . " ";
		
		$query .= "WHERE " . prodNo . " = '$prodNo'";
		
		return DB::query($query);
	}
	
	function updateProductPhoto($prodNo, $prodPhoto) {
		//delete the old photo from the server (do not do this part yet) 
		updateProduct($prodNo, null, null, $prodPhoto, null, null, null);
	}
	
	function updateStockQty($prodNo, $add) {
		// $add == 1 is qty += 1
		if(!isset($prodNo))
			return false;
		$query = "UPDATE Product SET " . stockQty . " = " . stockQty . $add . " WHERE " . prodNo . " = '$prodNo'";
		return DB::query($query);
		// $add == -2 is qty -= 2
	}
	
	function getSalesSummary($suppNo) {
		//do not do this part yet.
	}
?>