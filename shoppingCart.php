<?php
	include_once "Brain/ShoppingCart.php";
	$cart = new SCart("C0001");
	$cart->clear();
	$cart->addProduct("P0001","100","1");
		$cart->addProduct("P0002","100","1");
			$cart->addProduct("P0005","100","1");
				$cart->addProduct("P0003","100","1");
					$cart->addProduct("P0004","100","1");

	if(isset($_POST["removeID"]))
	{
		$cart->removeItem($_POST["removeID"]);
		echo "Removed";
		return;
	}
	else if(isset($_POST["getTotalAmount"]))
	{
		echo substr(printf("%.02f",$cart->getTotalAmount()),0,-1);
		return;
	}
?>
<html>
<head>
	<script src="jquery_ui/external/jquery/jquery.js"></script>
	<link rel="stylesheet" type='text/css' href='jquery_ui/dataTable/jquery.dataTables.min.css'/>	
	<script src="jquery_ui/dataTable/jquery.dataTables.min.js"></script>		
	<link rel="stylesheet" href="jquery_ui/jquery-ui.min.css">
	<link rel="stylesheet" href="css/shoppingCart.css">
	<script src='js/shoppingCart.js'></script>
</head>
<body>
	
		<div id="header_table">
	<table width="100%" id="cart" class="display" cellspacing="0">
	<caption id="cart_caption">Shopping Cart</caption>
	<thead><tr>
		<th>Item</th>
		<th>Name</th>
		<th>Supplier</th>
		<th>Price</th>
		<th>Qty</th>
		<th>Total</th>
		<th>Remove</th>
		</tr></thead>
		</div>
		<tbody>
<?php
	//1. image 2. productName 3. price 5.qty 6.total
		$format = '
		
					<tr>					
						<td class="dt-center" >		
							<div class="info-img">
								<img class="img" src="%s">
							</div>
						</td>						
						<td style="min-width:250px" class="dt-center">%s</td>
						<td style="min-width:150px" class="dt-center">%s</td>
						<td style="min-width:125px"  class="dt-center">HKD$%.2f</td>
						<td style="min-width:50px"  class="dt-center">%d</td>
						<td style="min-width:125px" class="dt-center">HKD$%.2f</td>
				<td class="dt-center"><input type="image" src="image\cart\ic_clear_black_48dp_1x.png "onclick="removeItem(\'%s\',this)"></input> </td>
					</tr>
				';
		
		include_once "Brain/Product.php";
		include_once "Brain/User.php";
		$products = $cart->getProducts();
		
		foreach($products as $p)
		{
			$productInfo = getProduct($p[prodNo]);
			$row = $productInfo;
			$supplier = getSupplier($row[suppNo]);
			$supplier = $supplier[suppName];
			printf($format, "product_image/".$row[prodPhoto], $row[prodName],$supplier, $p[actualPrice], $p[qty], $cart->getTotalAmount($p[prodNo]) ,$p[prodNo]);
		}
?>
	</tbody>
	<tfoot>
		<tr><td/><td/><td/><td/>
		<td class="dt-right">Total Amount: </td><td style="border-left:none" class="dt-center">HKD$ <span id="totalAmount"><?php printf("%.2f",$cart->getTotalAmount()); ?></span></td>
		<td class="dt-center"><input class="btn_ftyStyle" type="button" value="CHECK OUT"/></td></tr>
	</tfoot>
	</table>
	
</body>
</html>