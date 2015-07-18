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
	
	$newCat.find("#catParent").val(catParent)
		.attr("name", "newCatParent[" + newCatSeq + "]");
	$newCat.find("#catName").attr("name", "newCatName[" + newCatSeq + "]");
	$newCat.find("#catNo").attr("name", "newCatNo[" + newCatSeq + "]").val(newCatSeq);
	
	$(btn).parents("li").first().children("ul").prepend($newCat);
	
	var $newCatBox = $newCat.find(".rowRecord").first();
	var orgHeight = $newCatBox.height();
	$newCatBox
		.css("opacity", "0")
		.css("height", "0px");
	$newCatBox.animate({
		"opacity": "1",
		"height" : orgHeight
	}, 300);
	
	newCatSeq++;
}

function removeNewCat(btnRemove) {
	$liRemove = $(btnRemove).parents("li").first();
	$liRemove.animate({
		opacity: "0",
		height: "0px"
	}, 300, function(){
		$liRemove.remove();
	});
}

function removeCat(liRemove) {
	if (!$(liRemove).is("li"))
		liRemove = $(liRemove).parents("li").first();
	if ($(liRemove).attr("deleted") == "true")
		restoreCat(liRemove);
	else {
		setRemoveCat(liRemove);
		$(liRemove).find("li").each(function() {
			setRemoveCat(this);
		})
	}
	$(liRemove).find(".newCat").remove();
	checkDisableRestore();
}

function setRemoveCat(liRemove) {
	$liRemove = $(liRemove);
	$liRemove.children(".rowRecord").addClass("rowDeleted");
	$liRemove.find(".btnRemove").first().removeClass("btnRemove").addClass("btnRestore").addClass("fa").addClass("fa-undo");
	$liRemove.find(".btnAdd").hide();
	$dels = $liRemove.find("#dels").first();
	$dels.val($dels.attr("v"));
	$liRemove.attr("deleted", "true");
}

function restoreCat(liRestore) {
	if (!$(liRestore).is("li"))
		liRestore = $(liRestore).parents("li").first();
	$(liRestore).children(".rowRecord").removeClass("rowDeleted");
	$(liRestore).find(".btnAdd").first().show();
	$(liRestore).find(".btnRestore").first().removeClass("btnRestore").addClass("btnRemove").removeClass("fa").removeClass("fa-undo");
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