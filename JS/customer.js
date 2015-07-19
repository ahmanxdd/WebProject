$(function () {
	$("#CustOrdersTable tr td").click
		(
			function () {
				var orderNo = ($(this).closest("tr").find("[name='orderNo']").html());
				$.post("Brain/TableProcessor.php",
					{
						className: "tableSimpleList",
						ordNo:orderNo
					}
				).done(function(data)
				{
					$("#orderLine_placeHolder").html(data);
				})
			}
		)
});