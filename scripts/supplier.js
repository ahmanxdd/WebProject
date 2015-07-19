function showSuppDetails(trSupp) {
	$suppDetailsForm = $("#suppDetailsForm");
	$suppDetailsForm.find("[name='suppNo']").val(trSupp.id);
	$suppDetailsForm.submit();
}
