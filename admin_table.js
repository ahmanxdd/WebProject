function addNewRecord() {
	$tr = $(".adminNewRecord").first().clone();
	$tr.css("display", "");
	$("#adminDataTable").append($tr);
}

function addNewCat(btn) {
	if (!window.newCatSeq)
		newCatSeq = 0;
	var catParent = $(btn).siblings("#catNo").val();
	var $newCat = $("#newCat").clone();
	$newCat.attr("id", "");
	$newCat.css("display", "");
	
	$newCat.find("#catParent").val(catParent).attr("name", "newCatParent[" + newCatSeq + "]");
	$newCat.find("#catName").attr("name", "newCatName[" + newCatSeq + "]");
	$newCat.find("#catNo").attr("name", "newCatNo[" + newCatSeq + "]").val(newCatSeq);
	
	$(btn).parents("li").first().children("ul").append($newCat);
	newCatSeq++;
}

function removeNewCat(btnRemove) {
	$(btnRemove).parents("li").first().remove();
}

function removeCat(liRemove) {
	if (!$(liRemove).is("li")) 
		liRemove = $(liRemove).parents("li").first();
	$(liRemove).css("background", "red");
}

function setRemoveCat() {
	
}