var CART_AJAX_URL = "ajax/cart.php";

function btnAddCartClicked(btnAddToCart) {
	$btnAddToCart = $(btnAddToCart);
	if ($btnAddToCart.attr("rm") == "false") {
		btnAddToCart.innerHTML = "REMOVE FROM CART";
		$btnAddToCart.attr("rm", "true");
	}
	else {
		btnAddToCart.innerHTML = 'ADD <input class="qty" type="text" onclick="event.stopPropagation();"/> TO CART';
		$btnAddToCart.attr("rm", "false");
	}
	
	var prodNo = $btnAddToCart.parents(".prodItem_C").first().attr("id");
	var qty = $btnAddToCart.find("input").val();
	addToCart(prodNo, qty);
}

function addToCart(prodNo, qty) {
	$.get(CART_AJAX_URL,
		{
			"act" : "add",
			"prodNo": prodNo,
			"qty" : qty
		}, function(data) {
			alert(data);
			reloadCartMenu(data);
		});
}

function removeFromCart(prodNo) {
	$.get(CART_AJAX_URL,
		{
			"act": "remove",
			"prodNo": prodNo
		}, function(data) {
			alert(data);
			//reloadCartMenu(data);
		})
}

function reloadCartMenu(html) {
	$(".cartMenu").children("ul").html(html);
}