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
	if ($(liRemove).attr("deleted") == "true")
		restoreCat(liRemove);
	else
		setRemoveCat(liRemove);
	$(liRemove).find(".newCat").remove();
	checkDisableRestore();
}

function setRemoveCat(liRemove) {
	$(liRemove).children("div").css("background", "red");
	$dels = $(liRemove).children("div").children("#dels");
	$dels.val($dels.attr("v"));
	$(liRemove).attr("deleted", "true");
	$(liRemove).find("li").each(function() {
		setRemoveCat(this);
	})
}

function restoreCat(liRestore) {
	if (!$(liRestore).is("li"))
		liRestore = $(liRestore).parents("li").first();
	$(liRestore).children("div").css("background", "");
	$dels = $(liRestore).children("div").children("#dels");
	$dels.val("");
	$(liRestore).attr("deleted", "false");
}

function checkDisableRestore() {
	$adminCatC = $("#adminCat_C");
	$adminCatC.find("li").each(function() {
		var value = "";
		if ($(this).parents("li").first().attr("deleted") == "true")
			value = "disabled";
		$(this).find("#btnRemove").prop("disabled", value);
	});
}