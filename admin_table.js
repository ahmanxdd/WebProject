function addNewRecord() {
	$tr = $(".adminNewRecord").first().clone();
	$tr.css("display", "");
	$("#adminDataTable").append($tr);
}