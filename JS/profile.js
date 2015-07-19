$(function () {
	var navStatesInPixelHeight = [65, 200];
	var TtextSize = [1.4, 3];
	var StextSize = [0.46, 1];
	var changeNavState = function (nav, newStateIndex) {
		nav.data('state', newStateIndex).stop().animate({
			height: navStatesInPixelHeight[newStateIndex] + 'px'
		}, 600);
		$('#p_title').stop().animate({
				fontSize: TtextSize[newStateIndex] + 'em'
			},600);
		$('#p_name').stop().animate({
				fontSize: StextSize[newStateIndex] + 'em'
			},600);
		$('#p_contact').stop().animate({
				fontSize: StextSize[newStateIndex] + 'em'
			},600);
	};

	var boolToStateIndex = function (bool) {
		return bool * 1;
	};

	var maybeChangeNavState = function (nav, condState) {
		var navState = nav.data('state');
		if (navState === condState) {
			changeNavState(nav, boolToStateIndex(!navState));
		}
	};

	$('#profileHeader').data('state', 1);

	$(window).scroll(function () {
		var $nav = $('#profileHeader');
		if ($(document).scrollTop() > 0) {
			maybeChangeNavState($nav, 1);
		} else {
			maybeChangeNavState($nav, 0);
		}
	});
});