<?php
	include_once "Brain/ShoppingCart.php";
	$cart = new SCart("C0001");
	if(isset($_POST["removeID"]))
	{
		$cart->removeItem($_POST["removeID"]);
		echo "Removed";
		return;
	}	
?>
<html>
<head>

	<script src="jquery_ui/external/jquery/jquery.js"></script>

	<link rel="stylesheet" type='text/css' href='jquery_ui/dataTable/jquery.dataTables.min.css'/>	
	<script src="jquery_ui/dataTable/jquery.dataTables.min.js"></script>		
	<link rel="stylesheet" href="jquery_ui/jquery-ui.min.css">

	<script src='js/shoppingCart.js'></script>
</head>
<body>
	<div class="title">
		<h1>Shopping Bag</h1>
	</div>
	
	

	<table style="overflow-x: auto" width="100%" id="cart" class="display" cellspacing="0">
	<thead><tr><th>Item</th><th>Name</th><th>Price</th><th>Qty</th><th>Total</th><th>Remove</th></tr></thead><tbody>
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
						<td style="min-width:125px"  class="dt-center">HKD$%5.2f</td>
						<td style="min-width:50px"  class="dt-center">%d</td>
						<td style="min-width:125px" class="dt-center">HKD$%5.2f</td>
						<td class="dt-center"><button onclick="removeItem(\'%s\',this)">Delete</button>

					</tr>
				';
		
		include_once "Brain/Product.php";
		$products = $cart->getProducts();
		
		foreach($products as $p)
		{
			$productInfo = getProduct($p[prodNo]);
			$row = $productInfo->fetch_assoc();
			$supplier = getSupplier()
			printf($format, "product_image/".$row[prodPhoto], $row[prodName], $p[actualPrice], $p[qty], $p[actualPrice] * $p[qty],$p[prodNo]);
		}
?>
	</tbody>
	</table>
	<div class="submit"><input type="button" value="Submit?"></div>
</body>
</html>