function addNewRecord() {
	$tr = $(".adminNewRecord").first().clone();
	$tr.css("display", "");
	$("#adminDataTable").append($tr);
}

function addNewCat(btn) {
	var catParent = $(btn).siblings("[type='hidden']").val();
	var $newCat = $(".newCat").first().clone();
	$newCat.css("display", "");
	var newCatHtml = $newCat.html().replace(/vSeq/g, 0).replace("vParent", catParent);
	$(btn).parent().append(newCatHtml);
}