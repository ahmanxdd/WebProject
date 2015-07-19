var CART_AJAX_URL = "ajax/cart.php";

function btnAddCartClicked(btnAddToCart) {
	$btnAddToCart = $(btnAddToCart);
	var prodNo = $btnAddToCart.parents(".prodItem_C").first().attr("id");
	if ($btnAddToCart.attr("rm") == "false") {
		var qty = $btnAddToCart.find("input").val();
		if (qty == "" || qty == 0 || qty % 1 != 0) {
			$btnAddToCart.find("input").css("background", ERROR_FIELD_COLOR);
			return;
		}
		btnAddToCart.innerHTML = "REMOVE FROM CART";
		$btnAddToCart.attr("rm", "true");
		addToCart(prodNo, qty);
	}
	else {
		btnAddToCart.innerHTML = 'ADD <input class="qty" type="text" onclick="event.stopPropagation();"/> TO CART';
		$btnAddToCart.attr("rm", "false");
	}
}

function addToCart(prodNo, qty) {
	$.get(CART_AJAX_URL,
		{
			"act" : "add",
			"prodNo": prodNo,
			"qty" : qty
		}, function(data) {
			alert(data);
			if (data.indexOf("Error") != -1){
				alert("Please login first");
				showLoginPanel();
				return;
			}
			reloadCartMenu(data);
		});
}

function removeFromCart(prodNo) {
	$.get(CART_AJAX_URL,
		{
			"act": "remove",
			"prodNo": prodNo
		}, function(data) {
			if (data.indexOf("Error") != -1){
				
				return;
			}
			alert(data);
		})
}

function reloadCartMenu(html) {
	$(".cartMenu").children("ul").html(html);
}