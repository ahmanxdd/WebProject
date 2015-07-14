<?php
	//記住唔好hardcode column名
	function getOrder($orderNo) {
		$query = "SELECT * FROM OrderLine "
					."WHERE " .ordNo." = $orderNo";					
		return DB::query($query);
	}
	
	function getAllOrders() {
		//desc, asc
		$query = "SELECT * FROM OrderLine";
		return DB::query($query);
	}
	
	function getOrdresByProductNo($prodNo) {

		//return orders, ONLY all fields in CustOrder.
		$query = "SELECT DISTINCT " . orderNo . " FROM OrderLine "
			. "WHERE " . prodNo . " = $prodNo";
		$orderLines = DB::query($query);
		
		$where = 'WHERE ';
		if ($result->num_rows > 0) {
			$first = true;
			while($row = $result->fetch_assoc()) {
				if (!$first)
					$where .= ' OR ';
				$first = false;
				$where .= orderNo . ' = ' . $row[orderNo];
			}
		} else
			return null;
		
		$query = "SELECT * FROM Order $where";
		return DB::query($query);
	}
	
	function getOrdresByCatNo($catNo) {
		//desc, asc
			//return orders, ONLY all fields in CustOrder.
		$query = "SELECT CustOrder.* "  
					."FROM CustOrder "
					."JOIN OrderLine ON CustOrder.ordNo = OrderLine.ordNo "
					."JOIN Product ON OrderLine.prodNo = Product.prodNo " 
					."JOIN Category ON Product.catNo = Category.catNo "
					."WHERE " . catNo . " = $catNo ";
		$orderLines = DB::query($query);
		
		return DB::query($query);
		//return orders, ONLY all fields in CustOrder.
	}

	function getOrdersByDistNo($distNo) { 
		//desc, asc
		$query = "SELECT * FROM CustOrder "
					."WHERE " . discNo . " = $distNo "
					. DB::genOrderByStr(func_get_args(), func_num_args(), 1);
		//return orders, ONLY all fields in CustOrder.
	}
	
	function addOrder($orderDate, $theDateWhichTheCustomerWantTheOrderToBeDeliveried, $ordDiscount, $deliAddr, $custNo, $distNo, $prods) {
		//$prods is an array contains all the products in the order, 
		//each element is a associated array, eg.
		//$prods[0][prodNo], $prods[0][actualPrice], $prods[0][qty]
		//$prods[1][prodNo], $prods[1][actualPrice], $prods[1][qty]
		$query_format = "SELECT " . prodNo . " FROM Product "
					."WHERE " . stockQty . " >= '%s' "
					."AND " . prodNo . " = '$s'";
		//1. check the stock level of each product, if stockLevel < qty, return 1
		foreach($prods as $product)
		{
			$tmp_query = sprintf($query_format, $product[qty], $product[prodNo]);
			$result = DB::query($tmp_query);
			if($result->num_rows < 1)
				return 1;			
		}	
		
		//2.1 get Last index
		$orderNo = "OR" + DB::getLastIndex("CustOrder");		
		$jobNo = null;
		//2.2 add the the order to CustOrder
		$order_query = "INSERT INTO CustOrder "
						."VALUES($orderNo, $orderDate, $theDateWhichTheCustomerWantTheOrderToBeDeliveried, $ordDiscount, $deliAddr, $custNo, $disno, $jobNo)";
		//3. add all the products to OrderLine
		$orderLine_format = "(%s,%s,%0.2f,%d)";
		$orderLine_query = "INSERT INTO OrderLine VALUES";
		foreach($prods as $product)
			$orderLine_query .= sprintf($orderLine_format, $product[prodNo], $orderNo, $product[actualPrice], $product[qty]) . ",";
		$orderLine_query = str_replace($orderLine_query, "", -1);
		
		//4. return true if success, return false if any other database error occurs.
		if(DB::query($order_query) && DB::query($orderLine_query))
			return true;
		return false;
	}
	
	function getOrderLinesByOrdNo($orderNo) {
		$query = "SELECT * FROM OrderLine "
		."WHERE " . ordNo . " = $orderNo"
		.DB::genOrderByStr(func_get_args(), func_num_args(), 1);		
		return DB::query($query);
	}
	
	function getOrderByTheDateWhichTheCustomerWantTheOrderToBeDeliveried($theDateWhichTheCustomerWantTheOrderToBeDeliveried)
	{
		$query = 
	}
?>