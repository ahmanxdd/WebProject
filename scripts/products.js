var CART_AJAX_URL = "ajax/cart.php";

function addToCart(btnAddToCart) {
	var data = new Object();
	$btnAddToCart = $(btnAddToCart);
	if ($btnAddToCart.attr("rm") == "false") {
		btnAddToCart.innerHTML = "REMOVE FROM CART";
		$btnAddToCart.attr("rm", "true");
		data.act = "add";
	}
	else {
		btnAddToCart.innerHTML = 'ADD <input class="qty" type="text" onclick="event.stopPropagation();"/> TO CART';
		$btnAddToCart.attr("rm", "false");
		data.act = "remove";
	}
	
	var prodNo = "123";
	data.prodNo = prodNo;
	
	//$.get(CART_AJAX_URL, data, function(data) {
	//	
	//});
}