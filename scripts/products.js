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
		addToCart(prodNo, qty, function() {
			btnAddToCart.innerHTML = "REMOVE FROM CART";
			$btnAddToCart.attr("rm", "true");
		});
		
		
	}
	else {
		removeFromCart(prodNo, function() {
			btnAddToCart.innerHTML = 'ADD <input class="qty" type="text" value="1" onclick="event.stopPropagation();"/> TO CART';
			$btnAddToCart.attr("rm", "false");
		});
		
	}
}

function addToCart(prodNo, qty, successFunct) {
	$.get(CART_AJAX_URL,
		{
			"act" : "add",
			"prodNo": prodNo,
			"qty" : qty
		}, function(data) {
			if (data.indexOf("Error") != -1){
				alert("Please login first");
				showLoginPanel();
				return;
			}
			reloadCartMenu(data);
			successFunct();
		});
}

function removeFromCart(prodNo, successFunct) {
	$.get(CART_AJAX_URL,
		{
			"act": "remove",
			"prodNo": prodNo
		}, function(data) {
			if (data.indexOf("Error") != -1){
				alert("Cannot remove");
				return;
			}
			reloadCartMenu(data);
			successFunct();
		})
}

function reloadCartMenu(html) {
	$(".cartMenu").children("ul").html(html);
}