function addToCart(btnAddToCart) {
	if (btnAddToCart.innerHTML == "ADD TO CART") {
		btnAddToCart.innerHTML = "Remove";
	}
	else
		btnAddToCart.innerHTML = "ADD TO CART";
}