<?php include("header1.php"); ?>
<link rel="stylesheet" type="text/css" href="css/products.css" />
<link rel="stylesheet" type="text/css" href="css/products-m.css" />
<script src="scripts/products.js"></script>
<?php include("header2.php"); ?>
<?php
	include_once("Brain/field_const.php");
	include_once("Brain/functinos.php");
	include_once("Brain/Product.php");
	include_once("Brain/Category.php");
	error_reporting(0);
	
	regGet('prodName', 'priceMin', 'priceMax', 'catNo');
	$prods = getProducts($prodName, $priceMin, $priceMax, null , null, $catNo, null);
	//$prods = getAllProducts();
?>

	<div class="row prod_C">
		<?php
			if ($prods == null) {
				echo '<div class="noProducts"> No products found. </div>';
			}
			foreach ($prods as $p) {
				$s = getSupplier($p[suppNo]);
				$prodName = $p[prodName];
				$outOfStock = ($p[stockQty] <= 1);
				if (strlen($prodName) > 23) {
					$prodName = substr($prodName, 0, 20) . '...';
				}
				
				echo 
					'<div id="' . $p[prodNo] . '" class="prodItem_C col-32 col-m-100">
						<div class="prodItem_inContent">
							<div class="imgContainer prodImg">
								<img onload="cropImg(this);" src="product_image/' . $p[prodPhoto] . '"/>;
							</div>
							<div class="prodInfo_C">
								<h2 alt="' . $p[prodName] . '">' . $prodName . '</h2>
								<div class="prodInfoTable_C">
									<table>
										<tr>
											<th>Price:</th>
											<td>$' . $p[prodPrice]  . '</td>
										</tr>
										<tr>
											<th>Supplier:</th>
											<td>' . $s[suppName] . '</td>
										</tr> ';
									if (UserControl::getType() == 'a') {
										echo 
										'<tr>
											<th>Stock:</th>
											<td>' . $p[stockQty] . '</td>
										</tr>';
									}
									echo '	
									</table> ';
								if (!$outOfStock
									&& (UserControl::getType() == NULL || UserControl::getType() == 'c')) {
									echo '
									<button class="btnAddToChart" rm="false" onclick="btnAddCartClicked(this)">
										ADD <input class="qty" type="text" value="1" onclick="event.stopPropagation();"/> TO CART
									</button>';
								} 
								if ($outOfStock) {
									echo '
									<div class="outOfStock">OUT OF STOCK!</div>';
								}
							echo '
								</div>
							</div>
						</div>
					</div>';
			}
		?>
	</div>
	
<?php include("footer.php"); ?>