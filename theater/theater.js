//image threater animations
var THREATER_TIME = 400;
//////////////////////////////

var isAnimatingThreater = false;
var $openedImgContainer;

$(document).ready(function(){
	$bigContainer = $("#bigContainer");
	$threaterLay = $("#threaterLay");
	$threaterContent = $("#threaterContent");
	$threaterImgContainer = $("#threaterImgContainer");
	
	initTheater();
});

var animateThreater = function(isOpen, $fromContainer, $toContainer) {
	var $fromImg = $fromContainer.children("img");
	var $toImg = $toContainer.children("img");
	var fromOffset = $fromContainer.offset();
	var toOffset = $toContainer.offset();

	var $clone = $fromContainer.clone().appendTo("body");
	var $cloneImg = $clone.children("img");
	
	$img = $threaterImgContainer.children("img");
	if (isOpen) {
		$img.attr("src", $cloneImg.attr("src"));
		$threaterImgContainer.css("visibility", "hidden");
		$threaterImgContainer.css("height", "");
		$threaterImgContainer.css("width", "");
		if (isHorizontal($img)) {
			$img.css("width", "100%")
				.css("height", "auto");
		}
		else {
			$img.css("height", "100%")
				.css("width", "auto");
		}
		$threaterImgContainer.css("height", $img.height()+"px");
		$threaterImgContainer.css("width", $img.width() + "px");
		var minWidth = $threaterImgContainer.innerWidth() + $(".closeThreater").width() * 2 + 40;
		var c = $threaterContent.children(".container");
		var minHeight = $threaterImgContainer.innerHeight() + (c.innerHeight() - c.height());
		$threaterContent.css("min-width", minWidth + "px")
            .css("min-height", minHeight + "px");
		$threaterContent
            .css("overflow", "hidden");
		toOffset = $threaterImgContainer.offset();
	}
	

	$clone
		.css("position", "fixed")
		.css("left", fromOffset.left+"px")
		.css("top", fromOffset.top+"px")
		.css("width", $fromContainer.width()+"px")
		.css("height", $fromContainer.height()+"px")
		.css("margin", "0px")
		.css("z-index", 2000)
		.css("transform", "scale(1,1)");
	$clone.animate({
		width: $toContainer.width() + "px",
		height: $toContainer.height() + "px",
		left: toOffset.left+"px",
		top: toOffset.top+"px"
	}, THREATER_TIME, function(){
		$toContainer.css("visibility", "visible");
		$(this).remove();
		if (isOpen) {
		    $threaterContent.css("overflow", "");
		    unlockTheaterLay();
		}
		isAnimatingThreater = false;
	});
	
	$cloneImg
		.css("height", $cloneImg.height())
		.css("width", $cloneImg.width());
	var fillHeight = isHorizontal($cloneImg) ^ isOpen;
	if (fillHeight) {
		$cloneImg.css("width", "auto");
		$cloneImg.animate({
			height: "100%",
			marginTop: $toImg.css("margin-top"),
			marginLeft: $toImg.css("margin-left")
		}, THREATER_TIME);
	}
	else {
		$cloneImg.css("height", "auto");
		$cloneImg.animate({
			width: "100%",
			marginTop: $toImg.css("margin-top"),
			marginLeft: $toImg.css("margin-left")
		}, THREATER_TIME);
	}
	
	$fromContainer.css("visibility", "hidden");
}

var openThreater = function() {
	if (isAnimatingThreater)
		return;
	isAnimatingThreater = true;
	
	$threaterLay.css("visibility", "visible");
	//var h = screen.availHeight - (window.outerHeight - window.innerHeight) + 20;
	//$threaterContent.css("height", h+"px");
	$threaterContent.hide();
	$threaterContent.fadeIn(THREATER_TIME);
    //$("body").css("overflow", "hidden");
	isTooglingTopBar = true;
	lockScrollbar();
	lockTheaterLay();
	//$(window).scrollTop(0);
	
	var $fromContainer = $(this).parent();
	$openedImgContainer = $fromContainer;
	var $toContainer = $threaterImgContainer;
	animateThreater(true, $fromContainer, $toContainer);
	
};

var clsThreater = function(){
	if (isAnimatingThreater)
		return;
	isAnimatingThreater = true;
	
	lockTheaterLay();
	$threaterContent.fadeOut(THREATER_TIME,
		function(){
			$threaterLay.css("visibility", "");
			unlockScrollbar();
		});
	animateThreater(false, $threaterImgContainer, $openedImgContainer);
	return false;
}

var lockScrollbar = function() {
    window.currentY = $(window).scrollTop();
    window.currentX = $(window).scrollLeft();
	$bigContainer
		.css("position", "fixed")
		.css("top", -currentY+"px")
		.css("left", "0px");
};

var unlockScrollbar = function() {
	$bigContainer.attr("style", "");
	window.scrollTo(window.currentX, window.currentY);
	isTooglingTopBar = false;
}

var lockTheaterLay = function () {
    $threaterLay.css("position", "fixed")
        .css("left", $(window).scrollLeft())
        .css("top", $(window).scrollTop());
}

var unlockTheaterLay = function () {
    $threaterLay.css("position", "")
        .css("left", "")
        .css("top", "");
}

var cropImg = function(img) {	//called when imge onload
	var $img = $(img);
	var $container = $img.parent();
	if ($img.height() > $img.width()) {	//vertical image
		$img.css("width", "100%");
		var topOffset = ($img.height() - $container.height())/2;
		$img.css("margin-top", -topOffset+"px");
	}
	else {
		$img.css("height", "100%");
		var leftOffset = ($img.width() - $container.width())/2;
		$img.css("margin-left", -leftOffset+"px");
	}
}

var isHorizontal = function($img) {
	return $img.width() > $img.height();
}

var isVertical = function($img) {
	return $img.height() > $img.width();
}

var initTheater = function () {
    $threaterLay.click(clsThreater);
    $(".closeThreater").click(clsThreater);
	$(".imgContainer img").click(openThreater);
}