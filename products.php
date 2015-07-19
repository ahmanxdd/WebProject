<?php include("header1.php"); ?>
<link rel="stylesheet" type="text/css" href="css/products.css" />
<link rel="stylesheet" type="text/css" href="css/products-m.css" />
<script src="scripts/products.js"></script>
<?php include("header2.php"); ?>
<?php
	include_once("Brain/field_const.php");
	include_once("Brain/Product.php");
	include_once("Brain/Category.php");
	include_once("Brain/User.php");
	$prods = getAllProducts();
?>

	<div class="row prod_C">
		<span class="prod_C2">
		<?php
			foreach ($prods as $p) {
				$s = getSupplier($p[suppNo]);
				echo 
					'<div class="prodItem_C col-32 col-m-100">
						<div class="prodItem_inContent">
							<div class="imgContainer"></div>
							<div class="prodInfo_C">
								<h2>' . $p[prodName] . '</h2>
								<table>
									<tr>
										<th>Price</th>
										<td>' . $p[prodPrice]  . '</td>
									</tr>
									<tr>
										<th>Supplier</th>
										<td>' . $s[suppName] . '</td>
									</tr>
									<tr>
										<th>Stock:</th>
										<td>' . $p[stockQty] . '</td>
									</tr>
								</table>
								<button class="btnAddToChart" onclick="addToCart(this)">ADD TO CART</button>
							</div>
						</div>
					</div>';
			}
		?>
		</span>
	</div>
	
<?php include("footer.php"); ?>