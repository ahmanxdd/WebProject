<?php
	include_once "field_const.php";
	if(isset($_POST[ordNo],$_POST["className"]))
	{
		include_once "Order.php";
		include_once "User.php";
		include_once "Product.php";
		$orderLine = getOrderLinesByOrdNo($_POST[ordNo]);
		if(!isset($orderLine))
		{
			echo "No result found";
			return;
		}
		$retTable = "<table class='". $_POST["className"]. "'>
			<caption>Ordered Products of ".$_POST[ordNo]. "</caption>
				<thead>		
			
					<tr>
					<th>Product No</th>
					<th>Product Name</th>
					<th>Supplier Name</th>
					<th>Qty</th>
					<th>Price</th>
					<th>Total</th></tr>
				</thead><tbody>";
		$format = "<tr><td align='center'>%s</td><td align='center'>%s</td>
		<td align='center'>%s</td><td align='center'>%d</td><td align='center'>$%5.2f</td><td align='center'>$%5.2f</tr>";
		
		
		$total = 0;
		while($row = $orderLine->fetch_assoc())
		{
			$product = getProduct($row[prodNo]);
			$name = $product[prodName];
			$supplier = getSupplier($product[suppNo]);
			$supName = $supplier[suppName];			
			$total += ($row[actualPrice] * $row[qty]);
			$retTable .= sprintf($format,$row[prodNo],$name,$supName,$row[qty],$row[actualPrice],$row[qty] * $row[actualPrice]);
		}
		$retTable .= "</tbody><tfoot><tr><td colspan='4'/><td>Total Amount</td><td align='center'>$$total</td></tfoot></table>";
		echo $retTable;
		return;
	}	
?>